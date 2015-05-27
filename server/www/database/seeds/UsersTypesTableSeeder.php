<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Types as UsersTypes;

class UsersTypesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        UsersTypes::truncate();
        UsersTypes::insert([
            ['name' => 'admin'],
            ['name' => 'owner'],
            ['name' => 'guest']
        ]);
    }
}