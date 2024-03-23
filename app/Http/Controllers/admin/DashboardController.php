<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Barang;
use App\Models\PenanggungJawab;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $transaksi = Transaksi::all();

        $data = [
            'countUsers' => User::count(),
            'countBarangs' => Barang::count(),
            'countTransaksis' => Transaksi::count(),
            'countPenanggungJawabs' => PenanggungJawab::count(),
            'kategori' => Kategori::all(),
            'barang' => Barang::all(),
            'transaksi' => Transaksi::all(),

            'pemasukan' => $transaksi->where('id_jenis_transaksi', '1'),
            'pengeluaran' => $transaksi->where('id_jenis_transaksi', '2'),
            'peminjaman' => $transaksi->where('id_jenis_transaksi', '3'),
            'pengembalian' => $transaksi->where('id_jenis_transaksi', '4'),


        ];

        return view('pages.dashboard', $data);
    }

    public function manajemen()
    {
        dd("masuk manajemen");
    }

    public function anggota(Transaksi $transaksi)
    {
        $user = Auth::user();
        $barang = Barang::with('kategori')
            ->whereNotIn('kondisi', ['Rusak'])
            ->where('stok', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        $transaksi = Transaksi::with('barang')
            ->whereIn('id_jenis_transaksi', [3, 4])
            ->where('id_user', $user->id)->get();
        $kategori = Kategori::all();
        $peminjaman = $transaksi->where('id_jenis_transaksi', '3');
        $pengembalian = $transaksi->where('id_jenis_transaksi', '4');

        return view('pages.anggota.index', compact('user', 'transaksi', 'barang', 'peminjaman', 'pengembalian', 'kategori'));
    }
}
