<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('no action');
            $table->integer('number')->notNull();
            $table->string('serialnumber')->notNull();
            $table->integer('modelofequipament_id')->unsigned();
            $table->foreign('modelofequipament_id')->references('id')->on('modelofequipaments')->onDelete('no action');
            $table->boolean('require_calibration')->default(false);
            $table->boolean('is_pattern')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('period_id')->unsigned()->nullable();
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('no action');
            $table->integer('report_id')->unsigned()->nullable();
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('no action');
            $table->integer('instruction_id')->unsigned();
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('no action');
            $table->string('contact')->default(null);
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
        Schema::dropIfExists('registers');
    }
}
