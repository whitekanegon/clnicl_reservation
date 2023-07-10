<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReserveTimesSet extends Model
{
 protected $guarded = array('id');
 
 public static $rules = array(
  'time_id.0' => 'required',
  'name' => 'required',
 );
 

}
