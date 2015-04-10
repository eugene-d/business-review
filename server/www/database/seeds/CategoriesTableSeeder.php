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
            'name_us' => 'Food',
            'name_ua' => 'Їжа',
            'name_ru' => 'Еда'
        ]);
    }
}