<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSemesterStudentSubMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_semester_student_sub_map', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('MapItemId');
            $table->integer('MapId')->length(10)->unsigned();
            $table->integer('SubjectId')->length(10)->unsigned();
            $table->timestamps(); 

            $table->foreign('MapId')->references('MapId')->on('t_semester_student_map');
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
        Schema::dropIfExists('t_semester_student_sub_map');
    }
}
