<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegularWeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regular_weeks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinical_item_id');
            $table->integer('week_id');
            $table->integer('reserve_times_set_id');
            $table->integer('reserve_status_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regular_weeks');
    }
}
