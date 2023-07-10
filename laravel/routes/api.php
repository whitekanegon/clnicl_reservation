<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('clinical_items', 'FrontendController@clinicalItems');
Route::get('weeks', 'FrontendController@weeks');
Route::get('reserve_times', 'FrontendController@ReserveTimes');
Route::get('reserve_statuses', 'FrontendController@ReserveStatuses');
Route::get('reserve_times_sets', 'FrontendController@ReserveTimesSets');
Route::get('reserve_icons', 'FrontendController@ReserveIcons');
Route::get('input_items', 'FrontendController@InputItems');
Route::get('input_selections', 'FrontendController@InputSelections');
Route::get('input_types', 'FrontendController@InputTypes');
Route::get('mail_settings', 'FrontendController@MailSettings');
Route::get('get_holidays', 'FrontendController@getGoogleHolidays');
