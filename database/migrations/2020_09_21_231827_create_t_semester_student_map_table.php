<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSemesterStudentMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_semester_student_map', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('MapId');
            $table->integer('YearId')->length(10)->unsigned();
            $table->integer('SemesterId')->length(10)->unsigned();
            $table->integer('StudentsId')->length(10)->unsigned();
            $table->date('RegDate');
            $table->string('Remarks',200)->nullable();
            $table->timestamps(); 
            
            $table->unique(['YearId','SemesterId','StudentsId']);

            $table->foreign('YearId')->references('YearId')->on('t_year');
            $table->foreign('SemesterId')->references('SemesterId')->on('t_semester');
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
        Schema::dropIfExists('t_semester_student_map');
    }
}
