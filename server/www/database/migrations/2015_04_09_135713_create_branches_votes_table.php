<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesVotesTable extends Migration {
    private $tName = 'branches_votes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function(Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->index()->unsigned()->nullable()->default(null);
            $table->integer('user_id')->index()->unsigned()->nullable()->default(null);
            $table->integer('positive')->unsigned()->default(0);
            $table->integer('negative')->unsigned()->default(0);
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