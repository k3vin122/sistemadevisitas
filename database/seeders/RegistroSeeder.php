<?php

namespace Database\Seeders;

use App\Models\Registro;
use Illuminate\Database\Seeder;

class RegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registro::factory()
            ->count(5)
            ->create();
    }
}
