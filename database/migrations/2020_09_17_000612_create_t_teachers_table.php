<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_teachers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('TeachersId');
            $table->integer('DesignationId')->length(10)->unsigned();
            $table->string('TeacherCode',30)->unique();
            $table->string('TeacherName',50);
            $table->string('Phone',30)->unique();
            $table->string('Email',30)->unique();
            $table->string('Address',300)->nullable();
            $table->string('NID',30)->nullable();
            $table->timestamps();
            $table->foreign('DesignationId')->references('DesignationId')->on('t_designation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_teachers');
    }
}
