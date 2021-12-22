<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAdmissionformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_admissionform', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('FormId');
            $table->integer('YearId')->length(10)->unsigned();
            $table->integer('SemesterId')->length(10)->unsigned();
            $table->integer('ProgramId')->length(10)->unsigned();
            $table->date('AddmisionDate');
            $table->string('StudentName',50);
            $table->integer('GenderId')->length(10)->unsigned();
            $table->string('Phone',30);
            $table->string('Email',30);

            $table->float('SSCGPA');
            $table->string('SSCBoard',50);
            $table->float('HSCGPA');
            $table->string('HSCCollege',80);

            $table->timestamps();

            $table->foreign('YearId')->references('YearId')->on('t_year');
            $table->foreign('SemesterId')->references('SemesterId')->on('t_semester');
            $table->foreign('ProgramId')->references('ProgramId')->on('t_program');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_admissionform');
    }
}
