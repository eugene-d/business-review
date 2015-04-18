<?php

use Illuminate\Database\Seeder;
use App\Models\Countries as Countries;

class CountriesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        Countries::truncate();
        Countries::create([
            'country_us' => 'Ukraine',
            'country_ua' => 'Україна',
            'country_ru' => 'Украина',
            'code' => 'UA'
        ]);
    }
}