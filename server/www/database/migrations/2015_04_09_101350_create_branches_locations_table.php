<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesLocationsTable extends Migration {
    private $tName = 'branches_locations';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tName, function (Blueprint $table) {
            $table->integer('branch_id')->primary()->unsigned();
            $table->integer('city_id')->unsigned()->nullable()->default(null);
            $table->integer('zip_id')->unsigned()->nullable()->default(null);
            $table->string('address_us', 100)->index()->nullable()->default(null);
            $table->string('address_ua', 100)->index()->nullable()->default(null);
            $table->string('address_ru', 100)->index()->nullable()->default(null);
            $table->float('latitude', 10, 6)->nullable()->default(null);
            $table->float('longitude', 10, 6)->nullable()->default(null);
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
