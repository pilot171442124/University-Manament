<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_semester', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('SemesterId');
            $table->string('Semester',20)->unique();
            $table->timestamps(); 
        });

         /*Default value insert*/
        DB::table('t_semester')->insert([
            ['SemesterId' => 1,'Semester'=>'Spring'],
            ['SemesterId' => 2,'Semester'=>'Summer'],
            ['SemesterId' => 3,'Semester'=>'Fall']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_semester');
    }
}
