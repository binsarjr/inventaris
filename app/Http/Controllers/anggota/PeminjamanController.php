<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\JenisTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')
            ->whereNotIn('kondisi', ['Rusak'])
            ->where('stok', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->view('pages.peminjaman.index', compact('barang'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->view('pages.peminjaman.show', compact('barang'));
    }
    public function create()
    {

        $jenis_transaksis = JenisTransaksi::all();
        $barang = Barang::with('kategori')
            ->whereNotIn('kondisi', ['Rusak'])
            ->where('stok', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        return response()->view('pages.peminjaman.create', compact('jenis_transaksis', 'barang'));
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


            if ($request->hasFile('lampiran')) {
                // Lakukan penyimpanan file, misalnya menggunakan storeAs
                $file = $request->file('lampiran');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move('lampiran/', $fileName); // Gantilah 'lampiran' dengan nama folder penyimpanan yang sesuai
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
                        return redirect()->route('peminjaman')->with('error', 'Stok barang tidak mencukupi!');
                    }
                }
                // Attach ke tabel pivot
                $transaksi->barang()->attach($barangId, ['jumlah_transaksi' => $jumlah]);
            }


            DB::commit();

            return redirect()->route('anggota.riwayat')->with('success', 'Data baru berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('anggota.riwayat')->with('error', 'Terjadi kesalahan saat menyimpan data!');
        }
    }

    public function detailTransaksi(Transaksi $transaksi, $id)
    {
        $user = Auth::user();
        $transaksi = Transaksi::with('barang', 'penanggungJawab')
            ->where('id_user', $user->id)
            ->findOrFail($id);
        return view('pages.peminjaman.detail-transaksi', compact('user', 'transaksi'));
    }
}
