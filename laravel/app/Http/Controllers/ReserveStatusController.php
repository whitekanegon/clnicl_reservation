<?php

namespace App\Http\Controllers;

use App\ReserveStatus;
use App\ReserveIcon;
use App\RegularWeek;
use App\ReserveCalendar;
use Illuminate\Http\Request;

class ReserveStatusController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

 public function index(Request $request)
 {
  $items = ReserveStatus::orderBy('order','asc')->get();
  $icons = ReserveIcon::orderBy('order','asc')->get();
  return view('admin.reserve_status.index',['items' => $items,'icons' => $icons]);
 }

 public function regist(Request $request)
 {
  //$this->validate($request, ReserveStatus::$rules);
  $forms = $request->all();
  //unset($forms['_token']);
  foreach($forms['id'] as $key => $id){
   $reserve_status = ReserveStatus::find($id);
   $reserve_status->name = $forms['name'][$key];
   $reserve_status->allow = $forms['allow'][$key];
   $reserve_status->reserve_icon_id = $forms['reserve_icon_id'][$key];
   $reserve_status->order = $forms['order'][$key];
   $reserve_status->status = $forms['status'][$key];
   $reserve_status->save();
  }
  return redirect('/admin/reserve_status?status=update');
 }

 public function patch(Request $request)
 {
  $patch = $request->patch;
  $check_id = $request->check_id;
  if($patch === 'del' && $check_id){
   foreach($check_id as $id){
    $allow = ReserveStatus::find($id)->allow;
    $regular_weeks = RegularWeek::where('reserve_status_id',$id)->get();
    foreach($regular_weeks as $regular_week){
     if($allow){
      $regular_week->reserve_status_id = 1;
     }else{
      $regular_week->reserve_status_id = 2;
     }
     $regular_week->save();
    }
    $reserve_calendars = ReserveCalendar::where('reserve_status_id',$id)->get();
    foreach($reserve_calendars as $reserve_calendar){
     if($allow){
      $reserve_calendar->reserve_status_id = 1;
     }else{
      $reserve_calendar->reserve_status_id = 2;
     }
     $reserve_calendar->save();
    }
    ReserveStatus::find($id)->delete();
   }
   $patchStatus = 'delete';
  }elseif($patch === 'enabled' && $check_id){
   foreach($check_id as $id){
    $reserve_status = ReserveStatus::find($id);
    $reserve_status->status = 1;
    $reserve_status->save();
   }
   $patchStatus = 'enabled';
  }elseif($patch === 'disabled' && $check_id){
   foreach($check_id as $id){
    $reserve_status = ReserveStatus::find($id);
    $reserve_status->status = 0;
    $reserve_status->save();
   }
   $patchStatus = 'disabled';
  }
  return redirect('/admin/reserve_status?status='.$patchStatus);
 }


 public function add(Request $request)
 {
  $icons = ReserveIcon::orderBy('order','asc')->get();
  return view('admin.reserve_status.add',['icons' => $icons]);
 }

 public function create(Request $request)
 {
  $this->validate($request, ReserveStatus::$rules);
  $reserve_status = new ReserveStatus;
  $form = $request->all();
  unset($form['_token']);
  $latestOne = ReserveStatus::orderBy('order','DESC')->first();
  $form['order'] = $latestOne->order + 1;
  $reserve_status->fill($form)->save();
  return redirect('/admin/reserve_status?status=create');
 }
}
