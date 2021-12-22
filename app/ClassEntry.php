<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassEntry extends Model
{
   protected $table='t_class';
   protected $fillable=['ClassId','YearId','SemesterId','SubjectId','ClassTitle','ClassDate','ClassURL'];
}
