<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearEntry extends Model
{
   protected $table='t_year';
   protected $fillable=['YearId','Year'];
}
