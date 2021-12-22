<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_year', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('YearId');
            $table->string('Year',10)->unique();
            $table->timestamps(); 
        });

        /*Default value insert*/
        DB::table('t_year')->insert([
            ['YearId' => 1,'Year'=>'2019'],
            ['YearId' => 2,'Year'=>'2020'],
            ['YearId' => 3,'Year'=>'2021']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_year');
    }
}
