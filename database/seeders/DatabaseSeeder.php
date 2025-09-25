<?php

namespace Database\Seeders;

use App\Models\Activities;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BuildingsSeeder::class,
            ActivitiesSeeder::class,
            OrganizationsSeeder::class,
            OrganizationPhonesSeeder::class
        ]);

    }
}
