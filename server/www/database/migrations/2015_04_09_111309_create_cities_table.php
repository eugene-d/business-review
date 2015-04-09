<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {
    private $tName = 'cities';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->index()->unsigned()->nullable()->default(null);
            $table->string('name_us', 100)->index()->nullable()->default(null);
            $table->string('name_ua', 100)->index()->nullable()->default(null);
            $table->string('name_ru', 100)->index()->nullable()->default(null);
            $table->float('latitude', 10, 6)->nullable()->default(null);
            $table->float('longitude', 10, 6)->nullable()->default(null);
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