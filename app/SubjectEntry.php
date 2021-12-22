<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectEntry extends Model
{
   protected $table='t_subjects';
   protected $fillable=['SubjectId','SubjectCode','SubjectName','Credits'];
}
