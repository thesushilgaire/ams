<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'AttendanceController@dashboard')->name('dashboard');
    Route::resource('user', 'UsersController');
    Route::post('attendance/fetch-attendance','AttendanceController@fetchAttendance')->name('attendance.fetch');
    Route::resource('attendance','AttendanceController');
    Route::get('reports','ReportsController@index')->name('reports.index');
    Route::get('settings/index', 'SettingController@index')->name('settings.index');
    Route::post('settings/store','SettingController@store')->name('settings.store');
    Route::post('settings/update/{id}', 'SettingController@update')->name('settings.update');
    //Leave
    Route::resource('leave', 'LeaveController');
    //Holiday
    Route::resource('holiday', 'HolidayController');
    //Office details
    Route::resource('office_details','OfficeController');
    });

    Auth::routes(['register' => false]);

