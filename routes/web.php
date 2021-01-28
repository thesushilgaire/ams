<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/dashboard', 'AttendanceController@dashboard')->name('dashboard');
    Route::resource('user', 'UsersController');
    Route::post('attendance/fetch-attendance','AttendanceController@fetchAttendance')->name('attendance.fetch');
    Route::resource('attendance','AttendanceController');
    Route::get('reports','ReportsController@index')->name('reports.index');
    Route::get('settings/create', 'SettingController@create')->name('settings.create');
    Route::post('settings/update', 'SettingController@update')->name('settings.update');
});

Auth::routes(['register' => false]);
