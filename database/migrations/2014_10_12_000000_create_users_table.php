<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('teacherstudentid')->length(10)->unsigned()->nullable();
            $table->string('userrole',20);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        /*Default value insert*/
        $lastPostViewDate = date ( 'Y-m-d H:i:s' );
        $defaultPassword = Hash::make('admin');
        DB::table('users')->insert([
            ['name'=>'Administrator','email' => 'admin@ums.com','userrole' => 'Admin','password' => $defaultPassword]
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
