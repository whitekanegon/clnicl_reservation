<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('clinical_item_id');
            $table->integer('reserve_status_id');
            $table->integer('reserve_timing');
            $table->integer('reserve_times_set_id');
            $table->timestamps();
            $table->unique(['clinical_item_id','date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserve_calendars');
    }
}
