<?php

use Illuminate\Database\Seeder;
use App\Models\Categories as Categories;

class CategoriesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        Categories::truncate();
        Categories::create([
            'category_us' => 'Food',
            'category_ua' => 'Їжа',
            'category_ru' => 'Еда'
        ]);
    }
}