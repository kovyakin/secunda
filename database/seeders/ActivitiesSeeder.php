<?php

namespace Database\Seeders;

use App\Models\Activities;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parentRoot = Activities::factory()->count(20)->create();

        $parentLevel1 = collect();

        $parentRoot->each(function ($parent) use ($parentLevel1) {

            for ($i = 0; $i <= rand(0, 4); $i++) {
                $parentLevel1->push(Activities::factory()->withParent($parent)->create());
            }

        });

        $parentLevel1->each(function ($parentChild) {
            for ($i = 0; $i <= rand(0, 4); $i++) {
                Activities::factory()->withParent($parentChild)->create();
            }
        });


//        $parentLevel1 =  Activities::factory()->withParent($parentRoot)->create();
//        $parentLevel2 =  Activities::factory()->withParent($parentLevel1)->create();
//        $parentLevel3=  Activities::factory()->withParent($parentLevel2)->create();
    }
}
