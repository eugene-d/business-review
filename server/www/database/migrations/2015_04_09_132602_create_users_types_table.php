<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTypesTable extends Migration {
    private $tName = 'users_types';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable()->default(null);
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