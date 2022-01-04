<?php

namespace Database\Seeders;

use App\Models\RegionCode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class RegionCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = RegionCode::factory();

        $state = $factory->getCodes();
        $count = count($state);

        $factory->count($count)->state(new Sequence(...$state))->create();
    }
}
