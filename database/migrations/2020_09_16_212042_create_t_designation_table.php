<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDesignationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_designation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('DesignationId');
            $table->string('Designation',50)->unique();
            $table->timestamps();        
        });

         /*Default value insert*/
        DB::table('t_designation')->insert([
            ['DesignationId' => 1,'Designation'=>'Professor and Dean'],
            ['DesignationId' => 2,'Designation'=>'Associate Professor and Head'],
            ['DesignationId' => 3,'Designation'=>'Assistant Professor and Coordinator (Day)'],
            ['DesignationId' => 4,'Designation'=>'Senior Lecturer'],
            ['DesignationId' => 5,'Designation'=>'Senior Lecturer and Coordinator (Day)'],
            ['DesignationId' => 6,'Designation'=>'Lecturer'],
            ['DesignationId' => 7,'Designation'=>'Lecturer and Coordinator (Day)'],
            ['DesignationId' => 8,'Designation'=>'Lecturer and Coordinator(Evening)']
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_designation');
    }
}
