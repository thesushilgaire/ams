<?php

use Illuminate\Support\Facades\Route;
use App\Models\Setting;

Route::get('/', function () {

    // $zk = new ZKLibrary('192.168.0.155', 4370, 'TCP');
    // // echo 'Requesting for connection</br>';

    // $zk->connect();
    // // echo 'Connected</br>';

    // $zk->disableDevice();
    // // echo 'disabling device</br>';

    // // start working here
    // $users = $zk->getAttendance();
    // // echo 'Getting users</br>';
    // // end working here

    // $zk->enableDevice();
    // // echo 'enabling device</br>';

    // $zk->disconnect();
    // // echo 'disconnected';
    
    return view('dashboard');
})->name('dashboard');

Route::resource('user', 'UsersController');
Route::resource('attendance','AttendanceController');
Route::get('reports','ReportsController@index')->name('reports.index');
Route::post('reports/fetch-attendance-report','ReportsController@fetchAttendanceReport')->name('fetch.attendance.report');
Route::get('settings/create', 'SettingController@create')->name('settings.create');
Route::post('settings/update', 'SettingController@update')->name('settings.update');
