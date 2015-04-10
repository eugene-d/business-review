<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\Emails as BranchesEmails;

class BranchesEmailsTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesEmails::truncate();
        BranchesEmails::create([
            'branch_id' => 1,
            'priority' => 1,
            'email' => 'pauwau@ukr.net'
        ]);
    }
}