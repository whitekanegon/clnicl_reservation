<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegularHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regular_holidays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinical_item_id');
            $table->integer('day');
            $table->timestamps();
            $table->unique(['clinical_item_id','day']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regular_holidays');
    }
}
