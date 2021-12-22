<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_notice', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('NoticeId');
            $table->date('NoticeDate');
            $table->string('TypeId',100);
            $table->string('NoticeTitle',100);
            $table->text('NoticeURL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_notice');
    }
}
