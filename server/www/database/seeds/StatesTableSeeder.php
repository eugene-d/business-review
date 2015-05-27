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
            'state_us' => 'Zaporozhye',
            'state_ua' => 'Запорізька',
            'state_ru' => 'Запорожская',
            'code' => 'ZP'
        ]);
    }
}