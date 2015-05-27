<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\Phones as BranchesPhones;

class BranchesPhonesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesPhones::truncate();
        BranchesPhones::create([
            'branch_id' => 1,
            'phone' => '(061) 220-04-76'
        ]);
    }
}