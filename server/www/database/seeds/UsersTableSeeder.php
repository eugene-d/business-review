<?php

use Illuminate\Database\Seeder;
use App\Models\Users as Users;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder {
    /**
     * Run table seeder.
     *
     * @return void
     */
    public function run() {
        Users::truncate();
        Users::create([
            'type_id' => 1,
            'email_notifications' => 1,
            'is_active' => 1,
            'email' => 'admin@mail.ru',
            'password' => Hash::make('123'),
            'code' => Hash::make('321'),
            'first_name' => 'Administrator',
            'last_name' => 'Admin',
            'photo' => 'user.jpg',
            'phone' => '123456789',
            'site' => 'http://br.dev/',
            'registered_at' => Carbon::now()->toDateTimeString(),
            'last_login_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}