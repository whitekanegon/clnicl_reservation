<?php

namespace App\Http\Controllers;

use App\ReserveTime;
use Illuminate\Http\Request;

class ReserveTimeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

 public function index(Request $request)
 {
  $items = ReserveTime::orderBy('order','asc')->get();
  return view('admin.reserve_time.index',['items' => $items]);
 }

 public function regist(Request $request)
 {
  //$this->validate($request, ClinicalItem::$rules);
  $forms = $request->all();
  //unset($forms['_token']);
  foreach($forms['id'] as $key => $id){
   $reserve_item = ReserveTime::find($id);
   $reserve_item->name = $forms['name'][$key];
   $reserve_item->order = $forms['order'][$key];
   $reserve_item->save();
  }
  $request->session()->regenerateToken();
  return redirect('/admin/reserve_time?status=update');
 }

 public function patch(Request $request)
 {
  $patch = $request->patch;
  $check_id = $request->check_id;
  if($patch === 'del' && $check_id){
   foreach($check_id as $id){
    ReserveTime::find($id)->delete();
   }
   $patchStatus = 'delete';
  }
  return redirect('/admin/reserve_time?status='.$patchStatus);

 }


 public function add(Request $request)
 {
  return view('admin.reserve_time.add');
 }

 public function create(Request $request)
 {
  $this->validate($request, ReserveTime::$rules);
  $forms = $request->all();
  foreach($forms['name'] as $name){
   $reservetime = new ReserveTime;
   //$reservetime->name = $name;
   $latestOne = ReserveTime::orderBy('order','DESC')->first();
   //$reservetime->order = $latestOne->order + 1;
   $form = array(
    'name' => $name,
    'order' => $latestOne->order + 1,
   );
   $reservetime->fill($form)->save();
  }
  //$request->session()->regenerateToken();
  return redirect('/admin/reserve_time?status=create');
 }


}
