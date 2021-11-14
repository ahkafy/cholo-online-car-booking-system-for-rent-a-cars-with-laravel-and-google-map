<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    //

    protected $fillable=[
      'name',
      'phone',
      'present_address',
      'permanent_address',
      'nid',
      'nid_file',
      'is_active',
      'photo',

    ];
}
