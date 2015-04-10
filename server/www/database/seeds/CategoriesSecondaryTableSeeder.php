<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\Secondary as CategoriesSecondary;

class  CategoriesSecondaryTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        CategoriesSecondary::truncate();
        CategoriesSecondary::create([
            'category_id' => 1,
            'name_us' => 'Pizzeria',
            'name_ua' => 'Піцерії',
            'name_ru' => 'Пиццерии'
        ]);
    }
}