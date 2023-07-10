<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_selections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('input_item_id');
            $table->string('name');
            $table->integer('order');
            $table->timestamps();
            $table->unique(['input_item_id','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_selections');
    }
}
