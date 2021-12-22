<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('t_students', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('StudentsId');
            $table->integer('ProgramId')->length(10)->unsigned();
            $table->string('RegNo',20)->unique();
            $table->string('StudentCode',30)->unique();
            $table->string('StudentName',50);
            $table->string('Session',15);
            $table->string('Batch',15);
            $table->date('AdmissionDate');
            $table->date('BirthDate');
            $table->string('Phone',30)->unique();
            $table->integer('GenderId')->length(10)->unsigned();
            $table->string('Email',30)->unique();
            $table->string('Address',300)->nullable();
            $table->string('NID',30)->nullable();
            $table->timestamps();
            $table->foreign('ProgramId')->references('ProgramId')->on('t_program');
           // $table->foreign('GenderId')->references('GenderId')->on('t_gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_students');
    }
}
