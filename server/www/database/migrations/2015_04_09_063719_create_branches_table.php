<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration {
    private $tName = 'branches';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo', 500)->nullable()->default(null);
            $table->string('request', 255)->unique()->nullable()->default(null);
            $table->float('rating', 10, 8)->index()->nullable()->default(null);
            $table->integer('user_id')->index()->unsigned()->nullable()->default(null);
            $table->integer('published')->index()->unsigned()->default(0);
            $table->integer('deleted')->index()->unsigned()->default(0);
            $table->integer('viewed')->unsigned()->default(0);
            $table->dateTime('deleted_at')->nullable()->default(null);
            $table->dateTime('created_at')->nullable()->default(null);
            $table->dateTime('updated_at')->nullable()->default(null);
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
