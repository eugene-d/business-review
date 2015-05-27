<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesUsersTable extends Migration {
    private $tName = 'branches_users';

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
            $table->string('role', 255)->nullable()->default(null);
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