<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_payment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('PaymentId');
            $table->integer('YearId')->length(10)->unsigned();
            $table->integer('SemesterId')->length(10)->unsigned();            
            $table->integer('StudentsId')->length(10)->unsigned();
            $table->date('PaymentDate');
            $table->integer('Amount')->length(10)->unsigned();

            $table->timestamps();

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
        Schema::dropIfExists('t_payment');
    }
}
