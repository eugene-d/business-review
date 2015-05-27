<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {
    private $tName = 'categories';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->string('category_us', 100)->index()->nullable()->default(null);
            $table->string('category_ua', 100)->index()->nullable()->default(null);
            $table->string('category_ru', 100)->index()->nullable()->default(null);
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