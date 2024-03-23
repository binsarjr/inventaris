<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PenanggungJawab;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PenanggungJawabSeeder::class);
        $this->call(JenisTransaksiSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(TransaksiSeeder::class);
        $this->call(BarangTransaksiSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
