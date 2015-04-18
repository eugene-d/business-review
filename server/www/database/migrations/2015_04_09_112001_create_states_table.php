<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration {
    private $tName = 'states';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->index()->unsigned()->nullable()->default(null);
            $table->string('state_us', 100)->index()->nullable()->default(null);
            $table->string('state_ua', 100)->index()->nullable()->default(null);
            $table->string('state_ru', 100)->index()->nullable()->default(null);
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