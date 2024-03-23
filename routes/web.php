<?php

use App\Http\Controllers\admin\BarangController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JenisTransaksiController;
use App\Http\Controllers\admin\TransaksiController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\anggota\AnggotaController;
use App\Http\Controllers\anggota\PeminjamanController;
use App\Http\Controllers\anggota\PengembalianController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenanggungJawabController;
use GuzzleHttp\Middleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

route::get('/login', [AuthenticationController::class, 'index'])->name('login');
route::post('/login-process', [AuthenticationController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/register-process', [AuthenticationController::class, 'postRegister'])->name('postRegister');

Route::group(['middleware' => ['auth']], function () {

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboardAdmin');
        Route::resource('/dashboard/user', UserController::class);
        Route::resource('/dashboard/penanggung-jawab', PenanggungJawabController::class);
    });

    Route::middleware('manajemen')->group(function () {
        Route::get('/dashboard/manajemen', [DashboardController::class, 'index'])->name('dashboardManajemen');
    });


    Route::resource('/dashboard/kategori', KategoriController::class);
    Route::resource('/dashboard/jenis-transaksi', JenisTransaksiController::class);
    Route::resource('/dashboard/barang', BarangController::class);
    Route::get('/dashboard/transaksi/tampilkan/', [TransaksiController::class, 'tampilkanLaporan'])->name('transaksi.tampilkan');
    Route::get('/dashboard/transaksi/cetak_pdf_detail/{id}', [TransaksiController::class, 'cetak_pdf_detail'])->name('transaksi.cetak_pdf_detail');
    Route::get('/dashboard/transaksi/cetak_excel/{id}', [TransaksiController::class, 'cetak_excel'])->name('transaksi.cetak_excel');
    Route::get('/dashboard/transaksi/persetujuan', [TransaksiController::class, 'persetujuan'])->name('transaksi.persetujuan');
    Route::post('/dashboard/transaksi/tolak-transaksi/{id}', [TransaksiController::class, 'tolakTransaksi'])->name('transaksi.tolakTransaksi');
    Route::resource('/dashboard/transaksi', TransaksiController::class);



    Route::middleware('anggota')->group(function () {
        Route::get('/dashboard/anggota', [DashboardController::class, 'anggota'])
            ->name('dashboardAnggota');
        Route::get('dashboard/anggota/barang', [AnggotaController::class, 'barang'])->name('anggota.barang');
        Route::get('dashboard/anggota/riwayat', [AnggotaController::class, 'riwayat'])->name('anggota.riwayat');
        Route::get('dashboard/anggota/peminjaman', [PeminjamanController::class, 'create'])->name('peminjaman');
        Route::post('dashboard/anggota/peminjaman', [PeminjamanController::class, 'store'])->name('anggota.store');
        Route::get('dashboard/anggota/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian');
        Route::get('dashboard/anggota/pengembalian/{id}', [PengembalianController::class, 'create'])->name('pengembalian.create');
        Route::post('dashboard/anggota/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::put('dashboard/anggota/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
        Route::get('dashboard/anggota/detail/{id}', [PeminjamanController::class, 'show'])
            ->name('detailBarang');
        // Route::post('dashboard/anggota/pengajuan', [PeminjamanController::class, 'store'])
        //     ->name('pengajuanPeminjaman');
        Route::put('dashboard/anggota/update-profil/{id}', [AnggotaController::class, 'update'])->name('anggotaUpdate');
        Route::get('dashboard/anggota/transaksi-detail/{id}', [PeminjamanController::class, 'detailTransaksi'])
            ->name('transaksiDetailUser');
    });
});
