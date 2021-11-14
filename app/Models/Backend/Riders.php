<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Riders extends Model
{
    //
    protected $fillable=[
      'name',
      'phone',
      'present_address',
      'permanent_address',
      'nid',
      'nid_file',
      'driving_license',
      'license_expiry_date',
      'license_file',
      'is_active',
      'photo',
    ];
}
