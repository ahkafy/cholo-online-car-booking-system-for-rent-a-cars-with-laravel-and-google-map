<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Rides extends Model
{
    //
    protected $fillable = [
      'type',
      'owner',
      'rider',
      'registration',
      'registration_expiry_date',
      'registration_file',
      'tax_token',
      'tax_token_expiry_date',
      'tax_token_file',
      'insurance',
      'insurance_expiry_date',
      'insurance_file',
      'fitness',
      'fitness_expiry_date',
      'fitness_file',
      'is_active',
      'photo',
    ];
}
