<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClinicalItem;
use App\RegularHoliday;
use App\RegularWeek;
use App\Week;
use App\ReserveTimesSet;
use App\ReserveTime;
use App\ReserveStatus;
use App\ReserveCalendar;
use App\ReserveIcon;
use App\MailSetting;
use Response;

class ReserveCalendarController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

public function adminTop( Request $request ) {
  $clinical_items = ClinicalItem::orderBy('order','asc')->get();
  $regular_weeks = array();
  $regular_weeks_zero_flag = 0;
  foreach($clinical_items as $clinical_item){
    array_push($regular_weeks, $clinical_item->regular_weeks);
    if(count($clinical_item->regular_weeks) == 0 && $clinical_item->status > 0){
      $regular_weeks_zero_flag = 1;
    }
  }
  $mail_items = MailSetting::get();
  foreach($mail_items as $item){
   $mail_item[$item->name] = $item->content;
  }
  $times_sets = ReserveTimesSet::orderBy('order', 'asc')->get();
  return view( 'admin.index',compact('clinical_items','regular_weeks','regular_weeks_zero_flag','times_sets','mail_item'));
 }

 public function index( Request $request ) {
  if($request->id){
   $requestId = $request->id;
  }else{
   $requestId = ClinicalItem::orderBy('order','asc')->first()->id;
  }
  $clinical_item = ClinicalItem::find( $requestId );
		$regular_weeks = $clinical_item->regular_weeks;
  $reserve_times = ReserveTime::orderBy('order','asc')->get();
  $reserve_times_sets = ReserveTimesSet::orderBy('order','asc')->get();
  $reserve_icons = ReserveIcon::orderBy('order','asc')->get();
  $reserve_statuses = ReserveStatus::orderBy('order','asc')->get();
  $clinical_items_select = ClinicalItem::orderBy('order','asc')->get();
  return view( 'admin.reserve_calendar.index', compact('clinical_item','regular_weeks','reserve_times','reserve_times_sets','reserve_icons','reserve_statuses','clinical_items_select'));
 }

 public function getCalendarData(Request $request){
  if($request->id){
   $requestId = $request->id;
  }else{
   $requestId = 1;
  }
  $clinical_item = ClinicalItem::find( $requestId );
  $jsonData = array(
   'success' => true,
   'clinical_item' => $clinical_item,
   'regular_holidays' => $clinical_item->regular_holidays,
   'regular_weeks' => $clinical_item->regular_weeks,
   'reserve_timing' => $clinical_item->reserve_timing,
   'reserve_times' => ReserveTime::orderBy('order','asc')->get(),
   'reserve_icons' => ReserveIcon::orderBy('order','asc')->get(),
   'reserve_statuses' => ReserveStatus::orderBy('order','asc')->get(),
   'reserve_times_sets' => ReserveTimesSet::orderBy('order','asc')->get(),
   'reserve_calendars' => $clinical_item->reserve_calendars,
  );
  return response()->json($jsonData);
 }

 public function getConstantData(Request $request){
  $jsonData = array(
   'success' => true,
   'reserve_times' => ReserveTime::orderBy('order','asc')->get(),
   'reserve_icons' => ReserveIcon::orderBy('order','asc')->get(),
   'reserve_statuses' => ReserveStatus::orderBy('order','asc')->get(),
   'reserve_times_sets' => ReserveTimesSet::orderBy('order','asc')->get(),
  );
  return response()->json($jsonData);
 }

 public function add_ajax(Request $request){
  $form = $request->all();
  $reserve_calendar = new ReserveCalendar;
  $reserve_calendar->date = $form['date'];
  $reserve_calendar->clinical_item_id = $form['clinical_item_id'];
  $reserve_calendar->reserve_status_id = $form['reserve_status_id'];
  $reserve_calendar->reserve_timing = $form['reserve_timing'];
  $reserve_calendar->reserve_times_set_id = $form['reserve_times_set_id'];
  $reserve_calendar->save();
  $added_id = ReserveCalendar::where('date',$form['date'])->get()->first()->id;
  return response()->json(['success'=>'Data is successfully added','addedID'=>$added_id]);
  //return redirect('/admin/reserve_time');
 }

 public function update_ajax(Request $request){
  $form = $request->all();
  $reserve_calendar = ReserveCalendar::find($form['reserve_calendar_id']);
  $reserve_calendar->date = $form['date'];
  $reserve_calendar->clinical_item_id = $form['clinical_item_id'];
  $reserve_calendar->reserve_status_id = $form['reserve_status_id'];
  $reserve_calendar->reserve_timing = $form['reserve_timing'];
  $reserve_calendar->reserve_times_set_id = $form['reserve_times_set_id'];
  $reserve_calendar->save();
  return response()->json(['success'=>'Data is successfully updated']);
  //return redirect('/admin/reserve_time');
 }
}
