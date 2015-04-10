<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTertiaryTable extends Migration {
    private $tName = 'categories_tertiary';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('categories_secondary_id')->index()->unsigned()->nullable()->default(null);
            $table->string('name_us', 100)->index()->nullable()->default(null);
            $table->string('name_ua', 100)->index()->nullable()->default(null);
            $table->string('name_ru', 100)->index()->nullable()->default(null);
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