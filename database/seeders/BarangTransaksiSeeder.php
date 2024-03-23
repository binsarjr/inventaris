<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class BarangTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangs = Barang::all()->random(5);
        $transaksis = Transaksi::all()->random(5);

        for ($i = 0; $i < 5; $i++) {
            $barang = $barangs[$i];
            $transaksi = $transaksis[$i];

            DB::table('barang_transaksi')->insert([
                'id_barang' => $barang->id,
                'id_transaksi' => $transaksi->id,
                'jumlah_transaksi' => rand(1, 100),
            ]);
        }
    }
}
