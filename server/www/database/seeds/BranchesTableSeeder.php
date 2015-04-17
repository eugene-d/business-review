<?php

use Illuminate\Database\Seeder;
use App\Models\Branches as Branches;
use Carbon\Carbon;

class BranchesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        Branches::truncate();
        Branches::create([
            'photo' => 'pau-wau.jpg',
            'request' => 'pau-wau',
            'user_id' => 1,
            'published' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'name_ru' => 'Пау-Вау',
            'name_ua' => 'Пау-Вау',
            'name_us' => 'Pau-Wau'
        ]);
    }
}