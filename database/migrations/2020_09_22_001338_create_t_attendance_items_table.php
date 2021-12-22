<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAttendanceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_attendance_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('AttItemId');
            $table->integer('AttId')->length(10)->unsigned();
            $table->integer('StudentsId')->length(10)->unsigned();
            $table->tinyInteger('IsPresent')->default(0);

            $table->timestamps(); 

            $table->foreign('AttId')->references('AttId')->on('t_attendance');
            $table->foreign('StudentsId')->references('StudentsId')->on('t_students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_attendance_items');
    }
}
