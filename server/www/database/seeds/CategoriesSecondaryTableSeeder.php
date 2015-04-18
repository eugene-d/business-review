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
            'category_secondary_us' => 'Pizzeria',
            'category_secondary_ua' => 'Піцерії',
            'category_secondary_ru' => 'Пиццерии'
        ]);
    }
}