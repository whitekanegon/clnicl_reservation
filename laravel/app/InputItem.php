<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputItem extends Model
{
 protected $guarded = array('id');
 
 public static $rules = array(
  'name' => 'required',
 );
 public function input_selections()
 {
  return $this->hasMany('App\InputSelection','input_item_id')->orderBy('order');
 }
 
 public function input_types()
 {
  return $this->belongsTo('App\InputType','input_type_id','input_type_id');
 }
}
