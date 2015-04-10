<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    private $tName = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->index()->unsigned()->nullable()->default(null);
            $table->integer('email_notifications')->unsigned()->default(1);
            $table->integer('is_active')->unsigned()->default(1);
            $table->string('email', 50)->nullable()->default(null);
            $table->string('password', 60)->nullable()->default(null);
            $table->string('code', 60)->nullable()->default(null);
            $table->string('first_name', 50)->nullable()->default(null);
            $table->string('last_name', 50)->nullable()->default(null);
            $table->string('photo', 36)->nullable()->default(null);
            $table->string('phone', 20)->nullable()->default(null);
            $table->string('website', 200)->nullable()->default(null);
            $table->dateTime('registered_at')->nullable()->default(null);
            $table->dateTime('last_login_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop($this->tName);
    }
}