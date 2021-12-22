<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTExaminationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_examination_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('EMItemId');
            $table->integer('EMId')->length(10)->unsigned();
            $table->integer('StudentsId')->length(10)->unsigned();
            $table->float('Marks',12,2)->default(0);

            $table->timestamps(); 

            $table->foreign('EMId')->references('EMId')->on('t_examinationmaster');
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
        Schema::dropIfExists('t_examination_items');
    }
}
