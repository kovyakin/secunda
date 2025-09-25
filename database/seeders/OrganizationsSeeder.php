<?php

namespace Database\Seeders;

use App\Models\Activities;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = Organization::factory()->count(50)->create();

        $organizations->each(function (Organization $organization) {
            for ($i = 0; $i <= rand(1, 5); $i++) {
                $organization->activities()->attach(rand(1, 5));
                ([
                    'organization_id' => $organization->id,
                    'activity_id' => Activities::query()->inRandomOrder()->first()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        });
    }
}
