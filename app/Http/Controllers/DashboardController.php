<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Holiday;
use Auth;
use App\Models\Leave;

class DashboardController extends Controller
{
    public function login(){
        if(Auth::check() && auth()->user()->role_id === 1){
            $totalHolidays = Holiday::where('status',1)->where('start_date_bs','LIKE','%'.adTobs(date('Y-m-d')).'%')->get();
            $users = User::where('status',1)->get();
            $totalPeriod =  [];
            $todayLeaves = [];
            foreach($leaves as $leave){
                $period = \Carbon\CarbonPeriod::create($leave->start_date_bs,$leave->end_date_bs);
                foreach($period as $date){
                        array_push($totalPeriod,$date->format('Y-m-d'));
                }
                if(in_array(date('Y-m-d'),$totalPeriod)){
                    array_push($todayLeaves,$leave);
                }
            }
            $attendances = Attendance::where('time_bs','LIKE','%'.adTobs(date('Y-m-d')).'%')->get();
            $totalUsersToday = [];
            foreach($attendances as $att){
                array_push($totalUsersToday,$att->user_id);
            }
            $presentUsers = [];
            $absentUsers = [];
            foreach($users as $u){
                if(in_array($u,$totalUsersToday)){
                    array_push($presentUsers,$u);
                }else{
                    array_push($absentUsers,$u);
                }
            }
            return view('dashboard',compact('todayLeaves','totalHolidays','users','presentUsers','absentUsers'));
        }else{
            return view('auth.login');
        }
    }

    public function dashboard(){
        if(Auth::check() && auth()->user()->role_id === 1){
            $users = User::where('status',1)->get();
            $leaves = Leave::where('status',1)->get();
            $totalPeriod =  [];
            $todayLeaves = [];
            foreach($leaves as $leave){
                $period = \Carbon\CarbonPeriod::create($leave->start_date_bs,$leave->end_date_bs);
                foreach($period as $date){
                        array_push($totalPeriod,$date->format('Y-m-d'));
                }
                if(in_array(adTobs(date('Y-m-d')),$totalPeriod)){
                    array_push($todayLeaves,$leave);
                }
            }

            $totalHolidays = Holiday::where('status',1)->where('start_date_bs','LIKE','%'.adTobs(date('Y-m-d')) .'%')->get();
            $attendances = Attendance::where('time_bs','LIKE','%'.adTobs(date('Y-m-d')).'%')->get();
            $totalUsersToday = [];
            foreach($attendances as $att){
                array_push($totalUsersToday,$att->user_id);
            }
            $presentUsers = [];
            $absentUsers = [];
            foreach($users as $u){
                if(in_array($u->id,$totalUsersToday)){
                    array_push($presentUsers,$u);
                }else{
                    array_push($absentUsers,$u);
                }
            }
            return view('dashboard',compact('todayLeaves','totalHolidays','users','presentUsers','absentUsers'));
        }else{
            return view('auth.login');
        }
    }
}
