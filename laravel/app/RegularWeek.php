<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegularWeek extends Model
{
 public function reserveTimesSet()
 {
  return $this->belongsTo('App\ReserveTimesSet','reserve_times_set_id');
 }

}
