<?php

use Illuminate\Database\Seeder;
use App\Models\States as States;

class StatesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        States::truncate();
        States::create([
            'country_id' => 1,
            'name_us' => 'Zaporozhye',
            'name_ua' => 'Запорізька',
            'name_ru' => 'Запорожская',
            'code' => 'ZP'
        ]);
    }
}