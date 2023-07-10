<?php

namespace App\Http\Controllers;

use App\MailSetting;
use Illuminate\Http\Request;

class MailSettingController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

 public function index(Request $request)
 {
  $mail_items = MailSetting::get();
  foreach($mail_items as $item){
   $mail_item[$item->name] = $item->content;
  }
  return view('admin.mail_setting.index',compact('mail_item'));
 }

 public function regist(Request $request)
 {
  $forms = $request->all();
  unset($forms['_token']);
  foreach($forms as $key => $val){
  $mail_item = MailSetting::where('name',$key)->get()->first();
   if($val){

    $mail_item->content = $val;

   }else{
    $mail_item->content = '';
   }
   $mail_item->save();
  }
  return redirect( '/admin/mail_setting?status=update' );
 }
}
