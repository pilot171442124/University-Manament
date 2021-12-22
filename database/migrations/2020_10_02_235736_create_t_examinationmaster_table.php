<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTExaminationmasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_examinationmaster', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('EMId');
            $table->integer('YearId')->length(10)->unsigned();
            $table->integer('SemesterId')->length(10)->unsigned();
            $table->integer('SubjectId')->length(10)->unsigned();
            $table->date('AttDate');
            $table->integer('ExamId')->length(10)->unsigned();
            $table->smallInteger('ExamMarks');
            $table->smallInteger('MarkConsider')->default(100);

            $table->timestamps(); 
            
            $table->unique(['YearId','SemesterId','SubjectId','AttDate','ExamId'],'uk_t_examinationmaster');

            $table->foreign('YearId')->references('YearId')->on('t_year');
            $table->foreign('SemesterId')->references('SemesterId')->on('t_semester');
            $table->foreign('SubjectId')->references('SubjectId')->on('t_subjects');
            $table->foreign('ExamId')->references('ExamId')->on('t_examination');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_examinationmaster');
    }
}
