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
            $table->string('country_us', 100)->nullable()->default(null);
            $table->string('country_ua', 100)->nullable()->default(null);
            $table->string('country_ru', 100)->nullable()->default(null);
            $table->string('code', 2)->index()->unique()->nullable()->default(null);
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