<?php

namespace App\Http\Controllers;

use App\ClinicalItem;
use App\RegularHoliday;
use App\RegularWeek;
use App\Week;
use App\ReserveTimesSet;
use App\ReserveTime;
use App\ReserveStatus;
use App\ReserveCalendar;
use Illuminate\ Http\ Request;

class ClinicalItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

      public function index(Request $request)
    {
        $items = ClinicalItem::orderBy('order', 'asc')->get();
        return view('admin.clinical_item.index', [ 'items' => $items ]);
    }

    public function regist(Request $request)
    {
        //$this->validate($request, ClinicalItem::$rules);
        $forms = $request->all();
        //unset($forms['_token']);
        foreach ($forms[ 'id' ] as $key => $id) {
            $clinical_item = ClinicalItem::find($id);
            $clinical_item->name = $forms[ 'name' ][ $key ];
            $clinical_item->order = $forms[ 'order' ][ $key ];
            $clinical_item->status = $forms[ 'status' ][ $key ];
            $clinical_item->save();
        }
        $items = ClinicalItem::orderBy('order', 'asc')->get();
        $orders = ClinicalItem::get([ 'order' ]);
        $request->session()->regenerateToken();
        //return view('admin.clinical_item.index',['items' => $items, 'orders' => $orders, 'regist' => 1]);
        return redirect('/admin/clinical_item?status=update');
    }

    public function patch(Request $request)
    {
        $patch = $request->patch;
        $check_id = $request->check_id;
        if ($patch === 'del' && $check_id) {
            foreach ($check_id as $id) {
                ClinicalItem::find($id)->delete();
                RegularHoliday::where('clinical_item_id', $id)->delete();
                RegularWeek::where('clinical_item_id', $id)->delete();
                ReserveCalendar::where('clinical_item_id', $id)->delete();
            }
            $patchStatus = 'delete';
        } elseif ($patch === 'enabled' && $check_id) {
            foreach ($check_id as $id) {
                $clinical_item = ClinicalItem::find($id);
                $clinical_item->status = 1;
                $clinical_item->save();
            }
            $patchStatus = 'enabled';
        } elseif ($patch === 'disabled' && $check_id) {
            foreach ($check_id as $id) {
                $clinical_item = ClinicalItem::find($id);
                $clinical_item->status = 0;
                $clinical_item->save();
            }
            $patchStatus = 'disabled';
        }
        return redirect('/admin/clinical_item?status='.$patchStatus);
    }


    public function add(Request $request)
    {
        return view('admin.clinical_item.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, ClinicalItem::$rules);
        $clinical_item = new ClinicalItem;
        $form = $request->all();
        unset($form[ '_token' ]);
        $latestOne = ClinicalItem::orderBy('order', 'DESC')->first();
        $form[ 'order' ] = $latestOne->order + 1;
        $clinical_item->fill($form)->save();
        $request->session()->regenerateToken();
        return redirect('/admin/clinical_item?status=create');
    }

    public function add_holiday(Request $request)
    {
        $clinical_item = ClinicalItem::find($request->id);
        $weeks = Week::get();
        return view('admin.clinical_item.add_holiday', compact('clinical_item', 'weeks'));
    }

    public function create_holiday(Request $request)
    {
        $forms = $request->all();
        foreach ($forms[ 'day' ] as $day) {
            $regular_holiday = new RegularHoliday;
            $regular_holiday->clinical_item_id = $forms[ 'clinical_item_id' ];
            $regular_holiday->day = $day;
            try {
                $regular_holiday->save();
            } catch (\Exception $e) {
                /** Do nothing */
            }
        }
        return redirect('/admin/clinical_item/edit_holiday?id=' . $forms[ 'clinical_item_id' ] . '&status=create');
    }
    public function edit_holiday(Request $request)
    {
        $clinical_item = ClinicalItem::find($request->id);
        $regular_holidays = $clinical_item->regular_holidays;
        $weeks = Week::get();
        return view('admin.clinical_item.edit_holiday', compact('clinical_item', 'regular_holidays', 'weeks'));
    }

    public function update_holiday(Request $request)
    {
        $forms = $request->all();
        if (isset($forms[ 'del' ])) {
            foreach ($forms[ 'del' ] as $id) {
                RegularHoliday::find($id)->delete();
            }
        }
        if (isset($forms[ 'day' ])) {
            foreach ($forms[ 'day' ] as $key => $day) {
                if (isset($forms[ 'regular_holiday_id' ][ $key ])) {
                    $regular_holiday = RegularHoliday::find($forms[ 'regular_holiday_id' ][ $key ]);
                } else {
                    $regular_holiday = new RegularHoliday;
                    $regular_holiday->clinical_item_id = $forms[ 'clinical_item_id' ];
                }
                $regular_holiday->day = $day;
                try {
                    $regular_holiday->save();
                } catch (\Exception $e) {
                    /** Do nothing */
                }
            }
        }
        $clinical_item = ClinicalItem::find($forms[ 'clinical_item_id' ]);
        $regular_holidays_count = $clinical_item->regular_holidays->count();
        if ($regular_holidays_count > 0) {
            return redirect('/admin/clinical_item/edit_holiday?id=' . $forms[ 'clinical_item_id' ].'&status=update');
        } else {
            return redirect('/admin/clinical_item/add_holiday?id=' . $forms[ 'clinical_item_id' ].'&status=update');
        }
    }

    public function add_week(Request $request)
    {
        $clinical_item = ClinicalItem::find($request->id);
        $weeks = Week::get();
        $times_sets = ReserveTimesSet::orderBy('order', 'asc')->get();
        $reseve_times = ReserveTime::orderBy('order', 'asc')->get();
        $reserve_statuses = ReserveStatus::orderBy('order', 'asc')->get();
        return view('admin.clinical_item.add_week', compact('clinical_item', 'weeks', 'times_sets', 'reseve_times', 'reserve_statuses'));
    }

    public function create_week(Request $request)
    {
        $forms = $request->all();
        foreach ($forms[ 'week_id' ] as $key => $week_id) {
            $regular_week = new RegularWeek;
            $regular_week->clinical_item_id = $forms[ 'clinical_item_id' ];
            $regular_week->week_id = $week_id;
            $regular_week->reserve_times_set_id = $forms[ 'reserve_times_set_id' ][$key];
            $regular_week->reserve_status_id = $forms[ 'reserve_status_id' ][$key];

            try {
                $regular_week->save();
            } catch (\Exception $e) {
                /** Do nothing */
            }
            $clinical_item = ClinicalItem::find($forms[ 'clinical_item_id' ]);
            $clinical_item->reserve_timing = $forms[ 'reserve_timing' ];
            $clinical_item->reserve_include_holiday = $forms[ 'reserve_include_holiday' ];
            $clinical_item->calendar_length = $forms[ 'calendar_length' ];
            $clinical_item->save();
        }
        return redirect('/admin/clinical_item/edit_week?id=' . $forms[ 'clinical_item_id' ] . '&status=create');
    }

    public function edit_week(Request $request)
    {
        $clinical_item = ClinicalItem::find($request->id);
        $regular_weeks = $clinical_item->regular_weeks;
        $weeks = Week::get();
        $times_sets = ReserveTimesSet::orderBy('order', 'asc')->get();
        $reseve_times = ReserveTime::orderBy('order', 'asc')->get();
        $reserve_statuses = ReserveStatus::orderBy('order', 'asc')->get();
        return view('admin.clinical_item.edit_week', compact('clinical_item', 'regular_weeks', 'weeks', 'times_sets', 'reseve_times', 'reserve_statuses'));
    }

    public function update_week(Request $request)
    {
        $forms = $request->all();
        foreach ($forms[ 'regular_week_id' ] as $key => $regular_week_id) {
            $regular_week = RegularWeek::find($regular_week_id);
            $regular_week->clinical_item_id = $forms[ 'clinical_item_id' ];
            $regular_week->week_id = $forms[ 'week_id' ][$key];
            $regular_week->reserve_times_set_id = $forms[ 'reserve_times_set_id' ][$key];
            $regular_week->reserve_status_id = $forms[ 'reserve_status_id' ][$key];


            try {
                $regular_week->save();
            } catch (\Exception $e) {
                /** Do nothing */
            }
        }
        $clinical_item = ClinicalItem::find($forms[ 'clinical_item_id' ]);
        $clinical_item->reserve_timing = $forms[ 'reserve_timing' ];
        $clinical_item->reserve_include_holiday = $forms[ 'reserve_include_holiday' ];
        $clinical_item->calendar_length = $forms[ 'calendar_length' ];
        $clinical_item->save();
        return redirect('/admin/clinical_item/edit_week?id=' . $forms[ 'clinical_item_id' ] . '&status=update');
    }


}
