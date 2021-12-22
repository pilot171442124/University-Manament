<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentEntry extends Model
{
   protected $table='t_payment';
   protected $fillable=['PaymentId','YearId','SemesterId','StudentsId','PaymentDate','Amount'];
}
