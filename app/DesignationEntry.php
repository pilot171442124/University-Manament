<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignationEntry extends Model
{
   protected $table='t_designation';
   protected $fillable=['DesignationId','Designation'];
}
