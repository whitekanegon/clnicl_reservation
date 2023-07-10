<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReserveStatus extends Model
{
 protected $guarded = array('id');
 
 public static $rules = array(
  'name' => 'required',
 );
 public function reserveIcons()
 {
  return $this->belongsTo('App\ReserveIcon','reserve_icon_id');
 }

}
