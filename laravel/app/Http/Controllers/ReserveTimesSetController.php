<?php

namespace App\Http\Controllers;

use App\ReserveTimesSet;
use App\ReserveTime;
use App\RegularWeek;
use App\ReserveCalendar;
use Illuminate\Http\Request;

class ReserveTimesSetController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

 public function index(Request $request)
 {
  $items = ReserveTimesSet::orderBy('order','asc')->get();
  $relationtimes = ReserveTime::orderBy('order','asc')->get();
  return view('admin.reserve_times_set.index',['items' => $items,'relationtimes' => $relationtimes]);
 }

 public function add(Request $request)
 {
  $times = ReserveTime::orderBy('order','asc')->get();
  return view('admin.reserve_times_set.add',['times' => $times]);
 }

 public function create(Request $request)
 {
  $this->validate($request, ReserveTimesSet::$rules);
  $form = $request->all();
  $reserveTimesSet = new ReserveTimesSet;
  $latestOne = ReserveTimesSet::orderBy('order','DESC')->first();
  if($latestOne) {
   $order = $latestOne->order + 1;
  }else{
   $order = 1;
  }
  $formSet = array(
   'name' => $form['name'],
   'times' => serialize($form['time_id']),
   'order' => $order,
  );
  $reserveTimesSet->fill($formSet)->save();
  return redirect('/admin/reserve_times_set?status=create');
 }

public function edit(Request $request)
 {
  $times_set = ReserveTimesSet::find($request->id);
  $times = ReserveTime::orderBy('order','asc')->get();
  return view('admin.reserve_times_set.edit', ['times_set' => $times_set,'times' => $times]);
 }

 public function regist( Request $request ) {
  $forms = $request->all();
  foreach ( $forms[ 'id' ] as $key => $id ) {
   $times_set = ReserveTimesSet::find( $id );
   $times_set->order = $forms[ 'order' ][ $key ];
   $times_set->save();
  }
  return redirect('/admin/reserve_times_set?status=update');
}

 public function patch(Request $request)
 {
  $patch = $request->patch;
  $check_id = $request->check_id;
  if($patch === 'del' && $check_id){
   foreach($check_id as $id){
    $regular_weeks = RegularWeek::where('reserve_times_set_id',$id)->get();
    foreach($regular_weeks as $regular_week){
     $regular_week->reserve_times_set_id = 1;
     $regular_week->save();
    }
    $reserve_calendars = ReserveCalendar::where('reserve_times_set_id',$id)->get();
    foreach($reserve_calendars as $reserve_calendar){
     $reserve_calendar->reserve_times_set_id = 1;
     $reserve_calendar->save();
    }
    ReserveTimesSet::find($id)->delete();
   }
   $patchStatus = 'delete';
  }
  return redirect('/admin/reserve_times_set?status='.$patchStatus);

 }

 public function update(Request $request)
 {
  $this->validate($request, ReserveTimesSet::$rules);
  $times_set = ReserveTimesSet::find($request->id);
  $form = $request->all();
  $formSet = array(
   'name' => $form['name'],
   'times' => serialize($form['time_id']),
   'order' => $form['order'],
  );
  $times_set->fill($formSet)->save();
  return redirect('/admin/reserve_times_set?status=update');
 }


}
