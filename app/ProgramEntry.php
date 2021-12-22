<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramEntry extends Model
{
   protected $table='t_program';
   protected $fillable=['ProgramId','Program'];
}
