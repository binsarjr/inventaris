<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = ['Makanan', 'Minuman', 'Mebel', 'Elektronik', 'Pakaian', 'Kesehatan', 'Alat Tulis', 'Alat Rumah Tangga', 'Lainnya'];
        foreach ($kategori as $k) {
            Kategori::create([
                'nama' => $k
            ]);
        }
    }
}
