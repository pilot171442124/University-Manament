<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsEntry extends Model
{
   protected $table='t_students';
   protected $fillable=['ProgramId','RegNo','StudentCode','StudentName','Session','Batch','AdmissionDate','BirthDate','Phone','GenderId','Email','Address','NID'];
}