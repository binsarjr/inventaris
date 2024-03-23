<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory(5)->create();
        // custom admin admin
        User::factory(1)->create([
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::factory(1)->create([
            'username' => 'manajemen',
            'role' => 'manajemen',
            'password' => bcrypt('manajemen'),
        ]);

        User::factory(1)->create([
            'username' => 'anggota',
            'role' => 'anggota',
            'password' => bcrypt('anggota'),
        ]);
    }
}
