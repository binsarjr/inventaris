<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transaksi = Transaksi::where('id_user', $user->id)->where('id_jenis_transaksi', 3)
            ->where('status', '=', 'diterima')
            ->orderBy('updated_at', 'desc')->get();

        return response()->view('pages.pengembalian.index', compact('transaksi'));
    }

    public function create($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barangs = $transaksi->barang()->get();
        return response()->view('pages.pengembalian.create', compact('transaksi', 'barangs'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'tanggal_transaksi' => 'required|date',
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
            $transaksi->penerima = Auth()->user()->nama_lengkap;
            $transaksi->tujuan = $request->input('tujuan');
            $transaksi->id_user = $request->input('id_user');
            $transaksi->lampiran = $request->input('lampiran');


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
                        return redirect()->route('peminjaman')->with('error', 'Stok barang tidak mencukupi!');
                    }
                }
                // Attach ke tabel pivot
                $transaksi->barang()->attach($barangId, ['jumlah_transaksi' => $jumlah]);
            }


            DB::commit();
            $id_peminjaman[] = $request->input('id_peminjaman');
            return redirect()->route('anggota.riwayat')->with('success', 'Data baru berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('anggota.riwayat')->with('error', 'Terjadi kesalahan saat menyimpan data!');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal_transaksi' => 'required',
        ], [
            'tanggal_transaksi.required' => 'Tanggal wajib diisi.',
        ]);

        try {
            DB::beginTransaction();
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->tanggal_transaksi = $request->input('tanggal_transaksi');
            $transaksi->id_jenis_transaksi = 4;
            $transaksi->status = 'direview';
            $transaksi->id_penanggung_jawab = null;
            $transaksi->keterangan = null;

            $transaksi->barang()->get();

            $transaksi->save();
            DB::commit();
            return redirect()->route('anggota.riwayat')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->route('anggota.riwayat')->with('error', 'Terjadi kesalahan saat memperbarui data!');
        }
    }
}
