<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('input_type_id');
            $table->boolean('required');
            $table->integer('order');
            $table->boolean('status');
            $table->string('explain');
            $table->string('identify_name');
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
        Schema::dropIfExists('input_items');
    }
}
