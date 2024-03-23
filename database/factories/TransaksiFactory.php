<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_user' => fake()->numberBetween(1, 4),
            'tanggal_transaksi' => fake()->dateTimeBetween('-1 years', 'now'),
            'id_jenis_transaksi' => fake()->numberBetween(1, 4),
            'penerima' => fake()->name(),
            'tujuan' => fake()->company(),
            'status' => fake()->randomElement(['direview'])
        ];
    }
}
