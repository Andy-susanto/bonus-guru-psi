<?php

namespace Database\Seeders;

use App\Models\guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        guru::factory()
            ->count(50)
            ->create();
    }
}
