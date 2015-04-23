<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesCategoriesTable extends Migration {
    private $tName = 'branches_categories';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->integer('branch_id')->primary()->unsigned();
            $table->integer('category_id')->index()->unsigned()->nullable()->default(null);
            $table->integer('category_secondary_id')->unsigned()->nullable()->default(null);
            $table->integer('category_tertiary_id')->unsigned()->nullable()->default(null);
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