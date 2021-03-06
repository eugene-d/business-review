<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {
    private $tName = 'reviews';

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
            $table->integer('published')->index()->unsigned()->default(0);
            $table->integer('deleted')->index()->unsigned()->default(0);
            $table->dateTime('deleted_at')->nullable()->default(null);
            $table->dateTime('created_at')->nullable()->default(null);
            $table->dateTime('updated_at')->nullable()->default(null);
            $table->string('text_us', 4096)->nullable()->default(null);
            $table->string('text_ua', 4096)->nullable()->default(null);
            $table->string('text_ru', 4096)->nullable()->default(null);
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