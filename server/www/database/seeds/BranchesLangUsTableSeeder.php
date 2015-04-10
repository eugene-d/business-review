<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\LangUs as BranchesLangUs;

class BranchesLangUsTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesLangUs::truncate();
        BranchesLangUs::create([
            'branch_id' => 1,
            'name' => 'Pau-Wau',
            'description'  => 'Pizzeria "Pau-Wau" opened 12 years ago in a great historical date - 9 May.',
            'about'  => 'Cafe-Pizzeria'
        ]);
    }
}