<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalibrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('register_id')->unsigned();
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('no action');
            $table->integer('laboratory_id')->unsigned();
            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('no action');
            $table->string('certificate_calibration', 50)->default(null);
            $table->text('results')->default(null);
            $table->date('next_calibration');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');            
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
        Schema::dropIfExists('calibrations');
    }
}
