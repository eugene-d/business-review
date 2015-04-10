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
            'name_us' => 'Zaporozhye',
            'name_ua' => 'Запоріжжя',
            'name_ru' => 'Запорожье',
            'latitude' => 47.8388000,
            'longitude' => 35.1395670
        ]);
    }
}