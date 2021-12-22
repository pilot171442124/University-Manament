<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTExaminationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_examination', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ExamId');
            $table->string('ExamName',30)->unique();
            $table->timestamps();      
        });

         /*Default value insert*/
        DB::table('t_examination')->insert([
            ['ExamId' => 1,'ExamName'=>'Class Test 1'],
            ['ExamId' => 2,'ExamName'=>'Midterm'],
            ['ExamId' => 3,'ExamName'=>'Class Test 2'],
            ['ExamId' => 4,'ExamName'=>'Final']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_examination');
    }
}
