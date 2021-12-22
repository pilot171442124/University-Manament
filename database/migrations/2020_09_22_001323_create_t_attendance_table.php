<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_attendance', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('AttId');
            $table->integer('YearId')->length(10)->unsigned();
            $table->integer('SemesterId')->length(10)->unsigned();
            $table->integer('SubjectId')->length(10)->unsigned();
            $table->date('AttDate');
            $table->timestamps(); 

            $table->foreign('YearId')->references('YearId')->on('t_year');
            $table->foreign('SemesterId')->references('SemesterId')->on('t_semester');
            $table->foreign('SubjectId')->references('SubjectId')->on('t_subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_attendance');
    }
}
