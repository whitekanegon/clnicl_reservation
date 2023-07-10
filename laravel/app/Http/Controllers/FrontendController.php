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
use App\InputItem;
use App\InputSelection;
use App\InputType;
use App\MailSetting;
use App\Http\Resources\ClinicalItem as ClinicalItemResource;
use App\Http\Resources\ReserveCalendar as ReserveCalendarResource;
use App\Http\Resources\RegularHoliday as RegularHolidayResource;
use App\Http\Resources\RegularWeek as RegularWeekResource;
use App\Http\Resources\Week as WeekResource;
use App\Http\Resources\ReserveTime as ReserveTimeResource;
use App\Http\Resources\ReserveStatus as ReserveStatusResource;
use App\Http\Resources\ReserveTimesSet as ReserveTimesSetResource;
use App\Http\Resources\ReserveIcon as ReserveIconResource;
use App\Http\Resources\InputItem as InputItemResource;
use App\Http\Resources\InputSelection as InputSelectionResource;
use App\Http\Resources\InputType as InputTypeResource;
use App\Http\Resources\MailSetting as MailSettingResource;
use Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\Yoyaku;

class FrontendController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function getGoogleHolidays(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        // 月初日
  $first_day = mktime(0, 0, 0, intval($month), 1, intval($year));

  // 月末日
  $last_day = strtotime('-1 day', mktime(0, 0, 0, intval($month) + 1, 1, intval($year)));

  $api_key = '';
  //$holidays_id = 'outid3el0qkcrsuf89fltf7a4qbacgt9@import.calendar.google.com';  // mozilla.org版
  $holidays_id = 'japanese__ja@holiday.calendar.google.com';  // Google 公式版日本語
  //$holidays_id = 'japanese@holiday.calendar.google.com';  // Google 公式版英語
  $holidays_url = sprintf(
    'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
    'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
    $holidays_id,
    $api_key,
    date('Y-m-d', $first_day).'T00:00:00Z' ,  // 取得開始日
    date('Y-m-d', $last_day).'T00:00:00Z' ,   // 取得終了日
    31            // 最大取得数
    );
  if ( $results = file_get_contents($holidays_url) ) {
    $results = json_decode($results);
    $holidays = array();
    foreach ($results->items as $item ) {
      $date  = strtotime((string) $item->start->date);
      $title = (string) $item->summary;
      $holidays[date('Y-m-d', $date)] = $title;
    }
    ksort($holidays);
  }
  return response()->json($holidays);

    }

    public function sendmailPost(Request $request)
    {

        $params = $request->all();
        $mailsettings = MailSetting::get();
        foreach($mailsettings as $item){
            $mailsetting[$item->name] = str_replace('{{name}}',$params['nameofUser'],$item->content);
         }

        $to = $mailsetting['admin_email'];
        Mail::to($to)->send(new Yoyaku($params,$mailsetting,$to));

        $toUser = $params['emailtoUser'];
        Mail::to($toUser)->send(new Yoyaku($params,$mailsetting,$toUser));
    }

    public function clinicalItems(Request $request)
    {
        if($request->id){
            return ClinicalItemResource::make(ClinicalItem::find($request->id));
        }else{
            return ClinicalItemResource::collection(ClinicalItem::orderBy('order', 'asc')->get());
        }
    }

    public function weeks()
    {
        return WeekResource::collection(Week::all());
    }

    public function ReserveTimes()
    {
        return ReserveTimeResource::collection(ReserveTime::orderBy('order', 'asc')->get());
    }

    public function ReserveStatuses()
    {
        return ReserveStatusResource::collection(ReserveStatus::orderBy('order', 'asc')->get());
    }

    public function ReserveTimesSets(Request $request)
    {
        if($request->id){
            return ReserveTimesSetResource::make(ReserveTimesSet::find($request->id));
        }else{
            return ReserveTimesSetResource::collection(ReserveTimesSet::orderBy('order', 'asc')->get());
        }
    }

    public function ReserveIcons()
    {
        return ReserveIconResource::collection(ReserveIcon::all());
    }

    public function InputItems()
    {
        return InputItemResource::collection(InputItem::orderBy('order', 'asc')->get());
    }

    public function InputSelections()
    {
        return InputSelectionResource::collection(InputSelection::all());
    }

    public function InputTypes()
    {
        return InputTypeResource::collection(InputType::all());
    }

    public function MailSettings()
    {
        return MailSettingResource::collection(MailSetting::all());
    }
}
