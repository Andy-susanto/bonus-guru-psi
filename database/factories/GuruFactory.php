<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['laki-laki','perempuan']);
        return [
            'nama_lengkap' => fake()->name($gender),
            'jk' => $gender,
            'alamat' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'gaji_pokok' => fake()->randomElement([2000000,500000,1000000]),
        ];
    }
}
