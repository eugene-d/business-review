<?php

use Illuminate\Database\Seeder;
use App\Models\Branches\Emails as BranchesEmails;

class BranchesDescriptionsTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        BranchesEmails::truncate();
        BranchesEmails::create([
            'branch_id' => 1,
            'description_ru'  => 'Пиццерия «ПАУ-ВАУ» открылась 12 лет назад в знаменательную историческую дату – 9 мая.',
            'about_ru'  => 'Кафе-пиццерия',
            'description_ua'  => 'Піцерія «ПАУ-ВАУ» відкрилася 12 років тому в знаменну історичну дату - 9 травня.',
            'about_ua'  => 'Кафе-піцерія',
            'description_us'  => 'Pizzeria "Pau-Wau" opened 12 years ago in a great historical date - 9 May.',
            'about_us'  => 'Cafe-Pizzeria'
        ]);
    }
}