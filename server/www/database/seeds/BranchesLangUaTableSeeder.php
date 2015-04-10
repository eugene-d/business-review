<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\LangUa as BranchesLangUa;

class BranchesLangUaTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesLangUa::truncate();
        BranchesLangUa::create([
            'branch_id' => 1,
            'name' => 'Пау-Вау',
            'description'  => 'Піцерія «ПАУ-ВАУ» відкрилася 12 років тому в знаменну історичну дату - 9 травня.',
            'about'  => 'Кафе-піцерія'
        ]);
    }
}