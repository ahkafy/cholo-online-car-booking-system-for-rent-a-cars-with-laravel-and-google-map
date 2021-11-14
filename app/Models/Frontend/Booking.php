<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  protected $fillable = [
      'user_id','ride_type','from','to','pickup_date','pickup_time','payment_method','distance','fair_amount','waiting','remarks','status', 'ride_id'      
  ];
}
