<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalItem extends Model
{
 protected $guarded = array('id');
 
 public static $rules = array(
  'name' => 'required',
  'status' => 'required',
 );
 
 public function regular_holidays()
 {
  return $this->hasMany('App\RegularHoliday','clinical_item_id')->orderBy('id');
 }
 
 public function regular_weeks()
 {
  return $this->hasMany('App\RegularWeek','clinical_item_id')->orderBy('week_id');
 }
 
 public function reserve_calendars()
 {
  return $this->hasMany('App\ReserveCalendar','clinical_item_id')->orderBy('date');
 }
 
}
