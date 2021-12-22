<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTGenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_gender', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('GenderId');
            $table->string('Gender',20)->unique();
            $table->timestamps();        
        });


        /*Default value insert*/
        DB::table('t_gender')->insert([
            ['GenderId' => 1,'Gender'=>'Male'],
            ['GenderId' => 2,'Gender'=>'Female']
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_gender');
    }
}
