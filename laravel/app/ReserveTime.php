<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReserveTime extends Model
{
 protected $guarded = array('id');
 
 public static $rules = array(
  'name.0' => 'required',
 );
}
