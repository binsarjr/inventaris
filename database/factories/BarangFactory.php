<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_kategori' => fake()->numberBetween(1, 9),
            'kode_barang' => fake()->unique()->bothify('?????#####'),
            'nama_barang' => fake()->sentence(3),
            'deskripsi' => fake()->sentence(10),
            'stok' => fake()->numberBetween(1, 100),
            'kondisi' => fake()->randomElement(['Baik', 'Rusak']),
        ];
    }
}
