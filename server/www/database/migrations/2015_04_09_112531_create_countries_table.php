<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration {
    private $tName = 'countries';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->string('name_us', 100)->index()->nullable()->default(null);
            $table->string('name_ua', 100)->index()->nullable()->default(null);
            $table->string('name_ru', 100)->index()->nullable()->default(null);
            $table->string('code', 2)->nullable()->default(null);
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