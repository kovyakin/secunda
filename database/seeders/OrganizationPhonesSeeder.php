<?php

namespace Database\Seeders;

use App\Models\OrganizationPhones;
use Illuminate\Database\Seeder;

class OrganizationPhonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       OrganizationPhones::factory()->count(100)->create();
    }
}
