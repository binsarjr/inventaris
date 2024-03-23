<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\JenisTransaksi;
use App\Models\PenanggungJawab;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $transaksi = Transaksi::orderBy('updated_at', 'desc')->get();

        return response()->view('pages.transaksi.index', compact('transaksi'));
    }
    // public function persetujuan()
    // {
    //     // Lakukan logika untuk halaman persetujuan
    //     return response()->view('pages.transaksi.persetujuan');
    // }
    public function persetujuan()
    {
        $transaksi = Transaksi::where('status', 'direview')
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->view('pages.transaksi.persetujuan', compact('transaksi'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $jenis_transaksis = JenisTransaksi::whereIn('jenis', ['Pemasukan', 'Pengeluaran'])->get();
        $barang = Barang::all();
        return response()->view('pages.transaksi.create', compact('jenis_transaksis', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'tanggal_transaksi' => 'required',
            'jenis_transaksi' => 'required',
            'penerima' => 'nullable|max:100',
            'tujuan' => 'nullable|max:100',
            'lampiran' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'id_barang' => 'required|array',
            'id_user' => 'required',
        ], [
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'jenis_transaksi.required' => 'Jenis transaksi wajib diisi.',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi.',
            'penerima.max' => 'Nama penerima tidak boleh lebih dari 100 karakter.',
            'tujuan.max' => 'Tujuan tidak boleh lebih dari 100 karakter.',
            'lampiran.mimes' => 'Format lampiran harus berupa PDF, DOC, atau DOCX.',
            'lampiran.max' => 'Ukuran lampiran tidak boleh lebih dari 2048 KB.',
            'id_barang.required' => 'Barang wajib diisi.',
            'id_barang.array' => 'Barang wajib diisi.',
            'id_user.required' => 'User wajib diisi.',
        ]);

        try {
            DB::beginTransaction();
            $transaksi = new Transaksi;
            $transaksi->tanggal_transaksi = $request->input('tanggal_transaksi');
            $transaksi->id_jenis_transaksi = $request->input('jenis_transaksi');
            $transaksi->penerima = $request->input('penerima');
            $transaksi->tujuan = $request->input('tujuan');
            $transaksi->id_user = $request->input('id_user');


            if ($request->hasFile('lampiran')) {
                // Lakukan penyimpanan file, misalnya menggunakan storeAs
                $file = $request->file('lampiran');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('lampiran/'), $fileName);
                $transaksi->lampiran = $fileName;
            }

            $transaksi->save();

            $barangData = $request->input('id_barang');
            $jumlahTransaksi = $request->input('jumlah_transaksi');


            // Bentuk array untuk menyimpan hubungan many-to-many dan jumlah transaksi
            foreach ($barangData as $index => $barangId) {
                $jumlah = $jumlahTransaksi[$index]; // Ambil jumlah transaksi sesuai index

                // Ambil barang
                $barang = Barang::findOrFail($barangId);

                // Pengecekan stok untuk jenis transaksi 'Pengeluaran' atau 'Peminjaman'
                if ($transaksi->jenisTransaksi->jenis == 'Pengeluaran' || $transaksi->jenisTransaksi->jenis == 'Peminjaman') {
                    if ($barang->stok < $jumlah) {
                        return redirect()->route('transaksi.create')->with('error', 'Stok barang tidak mencukupi!');
                    }
                }
                // Attach ke tabel pivot
                $transaksi->barang()->attach($barangId, ['jumlah_transaksi' => $jumlah]);
            }


            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Data baru berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('transaksi.index')->with('error', 'Terjadi kesalahan saat menyimpan data!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {

        $transaksi = Transaksi::findOrFail($transaksi->id);
        $barangs = $transaksi->barang()->get();

        return response()->view('pages.transaksi.show', compact('transaksi', 'barangs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $transaksi = Transaksi::findOrFail($transaksi->id);
        $barangs = $transaksi->barang()->get();
        $penanggung_jawabs = PenanggungJawab::all();

        return response()->view('pages.transaksi.edit', compact('transaksi', 'barangs', 'penanggung_jawabs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi): RedirectResponse
    {
        $this->validate($request, [
            'penanggung_jawab' => 'required',
            'keterangan' => 'required',
        ], [
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 50 karakter.',
        ]);

        try {
            DB::beginTransaction();
            $transaksi->id_penanggung_jawab = $request->input('penanggung_jawab');
            $transaksi->keterangan = $request->input('keterangan');
            $transaksi->status = 'diterima';


            $barangs = $transaksi->barang()->get();
            // Update jumlah stok barang
            foreach ($barangs as $barang) {
                if ($transaksi->jenisTransaksi->jenis == 'Peminjaman' || $transaksi->jenisTransaksi->jenis == 'Pengeluaran') {
                    if ($barang->stok < $barang->pivot->jumlah_transaksi) {
                        return redirect()->route('transaksi.edit', $transaksi->id)->with('error', 'Stok barang tidak mencukupi!');
                    }
                    $barang->stok -= $barang->pivot->jumlah_transaksi;
                } elseif ($transaksi->jenisTransaksi->jenis == 'Pengembalian' || $transaksi->jenisTransaksi->jenis == 'Pemasukan') {
                    $barang->stok += $barang->pivot->jumlah_transaksi;
                } else {
                    return redirect()->route('transaksi.index')->with('error', 'Terjadi kesalahan saat memperbarui data!');
                }
                $barang->save();
            }

            $transaksi->save();
            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('transaksi.index')->with('error', 'Terjadi kesalahan saat memperbarui data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi): RedirectResponse
    {
        // Hapus relasi many-to-many pada tabel pivot
        $transaksi->barang()->detach();

        // Hapus instance model Transaksi
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus');
    }

    public function tolakTransaksi(Request $request, $id)
    {
        // Lakukan validasi dan logika lainnya jika diperlukan

        // Ubah status transaksi menjadi "ditolak"
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => 'ditolak']);

        // Berikan respons ke client (Anda dapat menyesuaikan respons sesuai kebutuhan)
        return redirect()->route('transaksi.persetujuan')->with('success', 'Transaksi berhasil ditolak');
    }

    public function tampilkanLaporan(Request $request)
    {
        $request->validate(
            [
                'tanggal_awal' => 'required|date',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            ],
            [
                'tanggal_awal.required' => 'Tanggal awal wajib diisi.',
                'tanggal_awal.date' => 'Tanggal awal harus berupa tanggal.',
                'tanggal_akhir.required' => 'Tanggal akhir wajib diisi.',
                'tanggal_akhir.date' => 'Tanggal akhir harus berupa tanggal.',
                'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal awal.',
            ]
        );
        $proses = $request->input('proses');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $type_button = $request->input('type_button');
        // Misalnya, ambil data transaksi dari tanggal_awal hingga tanggal_akhir
        $transaksi = Transaksi::whereBetween('tanggal_transaksi', [$tanggal_awal, $tanggal_akhir])->get();

        if ($proses == 'pdf') {
            $pdf = PDF::loadview('pages.transaksi.cetak_pdf', compact('transaksi', 'tanggal_awal', 'tanggal_akhir'))->setPaper('a4', 'landscape');
            return $pdf->stream('laporan-transaksi-pdf');
            // return response()->view('pages.transaksi.cetak_pdf', compact('transaksi', 'tanggal_awal', 'tanggal_akhir'));
        } elseif ($proses == 'tampilkan') {
            return response()->view('pages.transaksi.index', compact('transaksi', 'tanggal_awal', 'tanggal_akhir'));
        } elseif ($proses == 'excel') {
            return Excel::download(new TransaksiExport, 'transaksi.xlsx');
        }
    }



    public function cetak_pdf_detail($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barangs = $transaksi->barang()->get();

        $pdf = PDF::loadview('pages.transaksi.cetak_pdf_detail', compact('transaksi', 'barangs'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-transaksi-detail-pdf');
        // return response()->view('pages.transaksi.cetak_pdf_detail', compact('transaksi', 'barangs'));
    }

    public function cetak_excel($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barangs = $transaksi->barang()->get();

        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}
