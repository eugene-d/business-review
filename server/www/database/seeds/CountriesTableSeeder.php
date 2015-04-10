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
            'name_us' => 'Ukraine',
            'name_ua' => 'Україна',
            'name_ru' => 'Украина',
            'code' => 'UA'
        ]);
    }
}