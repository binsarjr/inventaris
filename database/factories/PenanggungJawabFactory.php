<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenanggungJawab>
 */
class PenanggungJawabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_lengkap' => fake()->name(),
            'no_hp' => '08' . fake()->randomNumber(8, true),
            'alamat' => fake()->address(),
        ];
    }
}
