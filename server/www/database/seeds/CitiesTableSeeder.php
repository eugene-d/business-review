<?php

use Illuminate\Database\Seeder;
use App\Models\Cities as Cities;

class CitiesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        Cities::truncate();
        Cities::create([
            'state_id' => 1,
            'city_us' => 'Zaporozhye',
            'city_ua' => 'Запоріжжя',
            'city_ru' => 'Запорожье',
            'latitude' => 47.8388000,
            'longitude' => 35.1395670
        ]);
    }
}