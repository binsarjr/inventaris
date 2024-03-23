<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisTransaksi;

class JenisTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis = ['Pemasukan', 'Pengeluaran', 'Peminjaman', 'Pengembalian'];
        foreach ($jenis as $j) {
            JenisTransaksi::create([
                'jenis' => $j
            ]);
        }
    }
}
