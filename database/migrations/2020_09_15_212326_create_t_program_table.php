<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_program', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ProgramId');
            $table->string('Program',50)->unique();
            $table->timestamps();            
        });

         /*Default value insert*/
        DB::table('t_program')->insert([
            ['ProgramId' => 1,'Program'=>'CSE'],
            ['ProgramId' => 2,'Program'=>'EEE'],
            ['ProgramId' => 3,'Program'=>'BBA']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_program');
    }
}
