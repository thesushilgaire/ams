<?php

use Illuminate\Support\Facades\Route;
use App\Models\Setting;

Route::get('/', 'AttendanceController@dashboard')->name('dashboard');
Route::resource('user', 'UsersController');
Route::post('attendance/fetch-attendance','AttendanceController@fetchAttendance')->name('attendance.fetch');
Route::resource('attendance','AttendanceController');
Route::get('reports','ReportsController@index')->name('reports.index');
Route::get('settings/create', 'SettingController@create')->name('settings.create');
Route::post('settings/update', 'SettingController@update')->name('settings.update');
//Leave
Route::resource('leave', 'LeaveController');
//Holiday
Route::resource('holiday', 'HolidayController');
//Office details
Route::resource('office_details','OfficeController');

