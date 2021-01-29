<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use DB;
use Yajra\DataTables\DataTables;
use App\Models\User;

class ReportsController extends Controller
{
    public function index(){
        $users = User::where('status',1)->get();
        return view('backend.pages.reports.attendance_report',compact(['users']));
    }
}
