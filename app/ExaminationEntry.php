<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationEntry extends Model
{
   protected $table='t_examination';
   protected $fillable=['ExamId','ExamName'];
}
