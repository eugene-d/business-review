<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesDescriptionsTable extends Migration {
    private $tName = 'branches_descriptions';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function (Blueprint $table) {
            $table->integer('branch_id')->primary()->unsigned();
            $table->string('description_us', 1024)->nullable()->default(null);
            $table->string('about_us', 1024)->nullable()->default(null);
            $table->string('description_ua', 1024)->nullable()->default(null);
            $table->string('about_ua', 1024)->nullable()->default(null);
            $table->string('description_ru', 1024)->nullable()->default(null);
            $table->string('about_ru', 1024)->nullable()->default(null);
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
