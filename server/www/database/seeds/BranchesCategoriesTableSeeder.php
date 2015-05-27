<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\Categories as BranchesCategories;

class BranchesCategoriesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesCategories::truncate();
        BranchesCategories::create([
            'branch_id' => 1,
            'category_id' => 1,
            'category_secondary_id' => 1
        ]);
    }
}