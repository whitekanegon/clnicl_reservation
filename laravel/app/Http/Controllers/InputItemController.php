<?php

namespace App\Http\Controllers;

use App\InputItem;
use App\InputType;
use App\InputSelection;
use Illuminate\Http\Request;

class InputItemController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

 public function index(Request $request)
 {
  $items = InputItem::orderBy('order','asc')->get();
  return view('admin.input_item.index',compact('items'));
 }

 public function regist(Request $request)
 {
  //$this->validate($request, ReserveStatus::$rules);
  $forms = $request->all();
  //unset($forms['_token']);
  foreach($forms['id'] as $key => $id){
   $input_item = InputItem::find($id);
   $input_item->order = $forms['order'][$key];
   $input_item->status = $forms['status'][$key];
   if(!isset($forms['required'][$key])){
    $input_item->required = 0;
   }else{
    $input_item->required = $forms['required'][$key];
   }
   $input_item->save();
  }
  return redirect('/admin/input_item?status=update');
 }

 public function patch(Request $request)
 {
  $patch = $request->patch;
  $check_id = $request->check_id;
  if($patch === 'del' && $check_id){
   foreach($check_id as $id){
    InputItem::find($id)->delete();
    InputSelection::where('input_item_id',$id)->delete();
   }
   $patchStatus = 'delete';
  }elseif($patch === 'enabled' && $check_id){
   foreach($check_id as $id){
    $input_item = InputItem::find($id);
    $input_item->status = 1;
    $input_item->save();
   }
   $patchStatus = 'enabled';
  }elseif($patch === 'disabled' && $check_id){
   foreach($check_id as $id){
    $input_item = InputItem::find($id);
    $input_item->status = 0;
    $input_item->save();
   }
   $patchStatus = 'disabled';
  }
  return redirect('/admin/input_item?status='.$patchStatus);
 }

 public function add(Request $request)
 {
  $input_types = InputType::get();
  return view('admin.input_item.add',compact('input_types'));
 }

 public function create(Request $request)
 {
  $this->validate($request, InputItem::$rules);
  $form = $request->all();
  if(isset($form['input_selections'])){
   $input_selections = $form['input_selections'];
  }
  unset($form['input_selections']);
  unset($form['_token']);
  $orderLatestOne = InputItem::orderBy('order','DESC')->first();
  $input_item = new InputItem;
  $form['order'] = $orderLatestOne->order + 1;
  if(!isset($form['required'])){
   $form['required'] = 0;
  }
  if(!isset($form['explain'])){
   $form['explain'] = '';
  }
  if(!isset($form['identify_name'])){
    $form['identify_name'] = '';
   }
   $input_item->fill($form)->save();
  if(isset($input_selections)){
   $id = InputItem::latest()->first()->id;
   //$id = InputItem::max('id') + 1;
   $cnt = 1;
   foreach($input_selections as $selection){
    if($selection){
     $input_selection = new InputSelection;
     $input_selection->input_item_id = $id;
     $input_selection->name = $selection;
     $input_selection->order = $cnt;
     try {
      $input_selection->save();
      $cnt++;
     } catch ( \Exception $e ) {
      /** Do nothing */
     }
    }
   }

  }
  return redirect('/admin/input_item?status=create');
 }

 public function edit(Request $request)
 {
  $input_item = InputItem::find( $request->id );
  $input_types = InputType::get();
  $input_selections = $input_item->input_selections;
  return view('admin.input_item.edit',compact('input_item','input_types','input_selections'));
 }

 public function update(Request $request)
 {
  $this->validate($request, InputItem::$rules);
  $forms = $request->all();
  $input_item = InputItem::find($forms['input_item_id']);
  $input_item->name = $forms['name'];
  $input_item->input_type_id = $forms['input_type_id'];
  if(isset($forms['required'])){
   $input_item->required = $forms['required'];
  }else{
    $input_item->required = 0;
  }
  if(isset($forms['explain'])){
   $input_item->explain = $forms['explain'];
  }else{
    $input_item->explain = '';
  }
  $input_item->save();
  if(isset($forms['input_selection_del'])){
   foreach($forms['input_selection_del'] as $id_del){
    InputSelection::find($id_del)->delete();
   }
  }
  $cnt = 1;
  if(isset($forms['input_selection_order'])){
   foreach($forms['input_selection_order'] as $key => $order){
    if(isset($forms['input_selection_name'][$key])){
     if(isset($forms['input_selection_id'][$key])){
      $input_selection = InputSelection::find($forms['input_selection_id'][$key]);
     }else{
      $input_selection = new InputSelection;
      $input_selection->input_item_id = $forms['input_item_id'];
     }
     $input_selection->name = $forms['input_selection_name'][$key];
     $input_selection->order = $cnt;
     try {
      $input_selection->save();
      $cnt++;
     } catch ( \Exception $e ) {
      /** Do nothing */
     }
    }
   }
  }

  return redirect( '/admin/input_item/edit?id=' . $forms[ 'input_item_id' ] . '&status=update' ); }

}
