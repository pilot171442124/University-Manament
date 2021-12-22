<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachersEntry extends Model
{
    protected $table='t_teachers';
   	protected $fillable=['TeachersId','DesignationId','TeacherCode','TeacherName','Phone','Email','Address','NID'];
}