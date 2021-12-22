<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeEntry extends Model
{
   protected $table='t_notice';
   protected $fillable=['NoticeId','NoticeDate','NoticeTitle','NoticeURL'];
}
