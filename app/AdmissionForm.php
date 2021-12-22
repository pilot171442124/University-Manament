<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionForm extends Model
{
   protected $table='t_admissionform';
   protected $fillable=['FormId','YearId','SemesterId','ProgramId','AddmisionDate','StudentName','GenderId','Phone','Email','SSCGPA','SSCBoard','HSCGPA','HSCCollege'];
}
