<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_class', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ClassId');
            $table->integer('YearId')->length(10)->unsigned();
            $table->integer('SemesterId')->length(10)->unsigned();
            $table->integer('SubjectId')->length(10)->unsigned();
            $table->string('ClassTitle',100);
            $table->datetime('ClassDate');
            $table->text('ClassURL');
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
        Schema::dropIfExists('t_class');
    }
}
