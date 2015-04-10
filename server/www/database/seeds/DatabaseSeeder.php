<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();
        $this->call('CountriesTableSeeder');
        $this->call('StatesTableSeeder');
        $this->call('CitiesTableSeeder');
        $this->call('UsersTypesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('CategoriesSecondaryTableSeeder');
        $this->call('BranchesTableSeeder');
        $this->call('BranchesLangUsTableSeeder');
        $this->call('BranchesLangUaTableSeeder');
        $this->call('BranchesLangRuTableSeeder');
        $this->call('BranchesEmailsTableSeeder');
        $this->call('BranchesPhonesTableSeeder');
        $this->call('BranchesSitesTableSeeder');
        $this->call('BranchesCategoriesTableSeeder');
        $this->call('BranchesLocationsTableSeeder');
    }
}