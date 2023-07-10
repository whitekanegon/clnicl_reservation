<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* ------------------------------------------
front
------------------------------------------ */
/*
Route::get('/{any}', function () {
    return view('front.index');
})->where('any', '^(?!admin).*$');
*/

Route::get('/', 'FrontendController@index');
Route::post('sendmail', 'FrontendController@sendmailPost');


/* ------------------------------------------
admin
------------------------------------------ */

Route::get('admin', 'ReserveCalendarController@adminTop');

/* ------------------------------------------
reserve_calendar
------------------------------------------ */

Route::get('admin/reserve_calendar', 'ReserveCalendarController@index');
Route::post('admin/reserve_calendar/add', 'ReserveCalendarController@add_ajax');
Route::post('admin/reserve_calendar/update', 'ReserveCalendarController@update_ajax');
Route::post('admin/reserve_calendar/getCalendarData', 'ReserveCalendarController@getCalendarData');
Route::post('admin/reserve_calendar/getConstantData', 'ReserveCalendarController@getConstantData');

/* ------------------------------------------
clinical_item
------------------------------------------ */

Route::get('admin/clinical_item', 'ClinicalItemController@index');
Route::post('admin/clinical_item', 'ClinicalItemController@regist');
Route::patch('admin/clinical_item', 'ClinicalItemController@patch');

Route::get('admin/clinical_item/add', 'ClinicalItemController@add');
Route::post('admin/clinical_item/add', 'ClinicalItemController@create');

Route::get('admin/clinical_item/add_holiday', 'ClinicalItemController@add_holiday');
Route::post('admin/clinical_item/add_holiday', 'ClinicalItemController@create_holiday');

Route::get('admin/clinical_item/edit_holiday', 'ClinicalItemController@edit_holiday');
Route::post('admin/clinical_item/edit_holiday', 'ClinicalItemController@update_holiday');

Route::get('admin/clinical_item/add_week', 'ClinicalItemController@add_week');
Route::post('admin/clinical_item/add_week', 'ClinicalItemController@create_week');

Route::get('admin/clinical_item/edit_week', 'ClinicalItemController@edit_week');
Route::post('admin/clinical_item/edit_week', 'ClinicalItemController@update_week');

/* ------------------------------------------
reserve_status
------------------------------------------ */

Route::get('admin/reserve_status', 'ReserveStatusController@index');
Route::post('admin/reserve_status', 'ReserveStatusController@regist');
Route::patch('admin/reserve_status', 'ReserveStatusController@patch');

Route::get('admin/reserve_status/add', 'ReserveStatusController@add');
Route::post('admin/reserve_status/add', 'ReserveStatusController@create');

/* ------------------------------------------
reserve_time
------------------------------------------ */

Route::get('admin/reserve_time', 'ReserveTimeController@index');
Route::post('admin/reserve_time', 'ReserveTimeController@regist');
Route::patch('admin/reserve_time', 'ReserveTimeController@patch');

Route::get('admin/reserve_time/add', 'ReserveTimeController@add');
Route::post('admin/reserve_time/add', 'ReserveTimeController@create');

/* ------------------------------------------
reserve_times_set
------------------------------------------ */

Route::get('admin/reserve_times_set', 'ReserveTimesSetController@index');
Route::post('admin/reserve_times_set', 'ReserveTimesSetController@regist');
Route::patch('admin/reserve_times_set', 'ReserveTimesSetController@patch');
Route::get('admin/reserve_times_set/add', 'ReserveTimesSetController@add');
Route::post('admin/reserve_times_set/add', 'ReserveTimesSetController@create');
Route::get('admin/reserve_times_set/edit', 'ReserveTimesSetController@edit');
Route::post('admin/reserve_times_set/edit', 'ReserveTimesSetController@update');

/* ------------------------------------------
input_item
------------------------------------------ */

Route::get('admin/input_item', 'InputItemController@index');
Route::post('admin/input_item', 'InputItemController@regist');
Route::patch('admin/input_item', 'InputItemController@patch');
Route::get('admin/input_item/add', 'InputItemController@add');
Route::post('admin/input_item/add', 'InputItemController@create');
Route::get('admin/input_item/edit', 'InputItemController@edit');
Route::post('admin/input_item/edit', 'InputItemController@update');

/* ------------------------------------------
mail_setting
------------------------------------------ */

Route::get('admin/mail_setting', 'MailSettingController@index');
Route::post('admin/mail_setting', 'MailSettingController@regist');

//Auth::routes();

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('admin/register', 'Auth\RegisterController@register');

Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');
