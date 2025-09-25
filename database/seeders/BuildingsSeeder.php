<?php

namespace Database\Seeders;

use App\Models\Buildings;
use Illuminate\Database\Seeder;

class BuildingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Buildings::factory()->count(50)->create();
    }
}
