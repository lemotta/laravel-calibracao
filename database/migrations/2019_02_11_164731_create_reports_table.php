<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unique();
            $table->string('route')->nullable();
            $table->integer('pattern1')->unsigned()->nullable();
            $table->foreign('pattern1')->references('id')->on('typeofequipaments')->onDelete('no action');
            $table->integer('pattern2')->unsigned()->nullable();
            $table->foreign('pattern2')->references('id')->on('typeofequipaments')->onDelete('no action');
            $table->integer('pattern3')->unsigned()->nullable();
            $table->foreign('pattern3')->references('id')->on('typeofequipaments')->onDelete('no action');
            $table->integer('pattern4')->unsigned()->nullable();
            $table->foreign('pattern4')->references('id')->on('typeofequipaments')->onDelete('no action');
            $table->integer('pattern5')->unsigned()->nullable();
            $table->foreign('pattern5')->references('id')->on('typeofequipaments')->onDelete('no action');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reports');
    }

}
