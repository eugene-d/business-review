<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\Locations as BranchesLocations;

class BranchesLocationsTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesLocations::truncate();
        BranchesLocations::create([
            'branch_id' => 1,
            'city_id' => 1,
            'address_us' => 'bul. Central 4',
            'address_ua' => 'бул. центральний 4',
            'address_ru' => 'бул. Центральный 4',
            'latitude' => 47.837988,
            'longitude'  => 35.135295
        ]);
    }
}