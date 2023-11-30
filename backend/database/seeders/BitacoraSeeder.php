<?php

namespace Database\Seeders;

use App\Models\bitacora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BitacoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        bitacora::factory(10)->create();
    }
}
