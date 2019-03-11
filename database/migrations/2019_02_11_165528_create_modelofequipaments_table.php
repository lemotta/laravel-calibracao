<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelofequipamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelofequipaments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacturer_id')->unsigned();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('no action');
            $table->integer('typeofequipament_id')->unsigned();
            $table->foreign('typeofequipament_id')->references('id')->on('typeofequipaments')->onDelete('no action');
            $table->string('model')->notNull();
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
        Schema::dropIfExists('modelofequipaments');
    }
}
