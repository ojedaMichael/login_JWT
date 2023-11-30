<?php

namespace Database\Seeders;

use App\Models\enlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        enlace::factory(10)->create();
    }
}
