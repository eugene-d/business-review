<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\Sites as BranchesSites;

class BranchesSitesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesSites::truncate();
        BranchesSites::create([
            'branch_id' => 1,
            'priority' => 1,
            'url' => 'http://pau-wau.com.ua/'
        ]);
    }
}