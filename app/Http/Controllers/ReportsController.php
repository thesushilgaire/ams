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
        $users = User::all();
        return view('backend.pages.reports.attendance_report',compact(['users']));
    }
    
    public function fetchAttendanceReport(Request $request){
        $attendances = Attendance::join('users', 'users.id', 'attendances.user_id')
        ->select('attendances.id as id','attendances.time_bs as date','attendances.status as status','users.name as user')
        ->orderBy('attendances.created_at', 'desc')
        ->take(32);

    return Datatables::of($attendances)
        ->filter(function ($query) use ($request) {
            if ($request->has('date')) {
                $query->where('attendances.time_bs', 'like', "%{$request->get('date')}%");
            }
            if ($request->has('user')) {
                $query->where('users.name', 'like', "%{$request->get('user')}%");
            }
            if ($request->has('status')) {
                $query->where('attendances.status', 'like', "%{$request->get('status')}%");
            }
        })
        
        ->addIndexColumn()
        ->make(true);
}
}
