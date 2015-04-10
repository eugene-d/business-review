<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\LangRu as BranchesLangRu;

class BranchesLangRuTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesLangRu::truncate();
        BranchesLangRu::create([
            'branch_id' => 1,
            'name' => 'Пау-Вау',
            'description'  => 'Пиццерия «ПАУ-ВАУ» открылась 12 лет назад в знаменательную историческую дату – 9 мая.',
            'about'  => 'Кафе-пиццерия'
        ]);
    }
}