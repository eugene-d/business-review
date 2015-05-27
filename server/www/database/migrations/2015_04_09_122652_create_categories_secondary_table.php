<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesSecondaryTable extends Migration {
    private $tName = 'categories_secondary';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index()->unsigned()->nullable()->default(null);
            $table->string('category_secondary_us', 100)->index()->nullable()->default(null);
            $table->string('category_secondary_ua', 100)->index()->nullable()->default(null);
            $table->string('category_secondary_ru', 100)->index()->nullable()->default(null);
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