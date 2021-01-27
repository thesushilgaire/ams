<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use ZKLibrary; // Important
use DB;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Models\Setting;

class AttendanceController extends Controller
{

    public function dashboard(){
        return view('dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::first();

        try{
            $zk = new ZKLibrary('192.168.0.155', 4370, 'TCP');
            // echo 'Requesting for connection</br>';
            $zk->connect(); 
            // echo 'Connected</br>';
    
            $zk->disableDevice();
            // echo 'disabling device</br>';
            
            // start working here
            $attendances = $zk->getAttendance(); 
           
            // $collection = collect($attendances);
      
            // $grouped = $collection->groupBy(1,substr(3,0,10))->map(function ($row) {
            //             return response([
            //                 'count' => $row->count(),
            //                 'data' => $row
            //             ]);
            //         });
            // dd($grouped);
            // echo 'Getting attendances</br>';
            if(count($attendances) > 0 ){
                foreach($attendances as $key=>$a){
                    $startTime = \Carbon\Carbon::createFromFormat('H:i', $settings->check_in);
                    $endTime = \Carbon\Carbon::createFromFormat('H:i', $settings->check_out);
                    $checkInThreshold = $settings->check_in_threshold;
                    $checkOutThreshold = $settings->check_out_threshold;
                    $currentTime =  \Carbon\Carbon::parse(substr($a[3],11,19));
                    $status = '';
                    // dd(\Carbon\Carbon::parse(date('Y-m-d')));
                    if($currentTime->lt($startTime) || $currentTime->diffInMinutes($startTime) < $checkInThreshold){
                        $status = 'Check In';
                    }
                    if($currentTime->gt($endTime) || $currentTime->diffInMinutes($endTime) < $checkOutThreshold){
                        $status = 'Check Out';
                    }
                    if($currentTime->between($startTime->addMinutes($checkInThreshold),$endTime->subMinute($checkOutThreshold),true)){
                        $currentDate = substr($a[3],0,10);
                        $attends = Attendance::where('time_ad','like', "%{$currentDate}%")
                                            ->where('user_id',$a[1])->get();
                        // if(count($attends) >= 1){
                        //     $status = 'Early Check Out';
                        // }
                        if(count($attends) < 1){
                            $status = 'Late Check In';
                        }else{
                            $status = 'Early Check Out';
                        }
                    }
                    
                    // dd($attends);
                    //create attendances
                    $data[] = [
                        'uid'=>$a[0],
                        'user_id'=>$a[1],
                        'state'=>$a[2],
                        'time_ad'=>$a[3],
                        'time_bs'=>adToBs(substr($a[3],0,10)) .' '. substr($a[3],11,19),
                        'status'=>$status,
                        'created_at'=>$a[3],
                        'updated_at'=>$a[3]
                    ];

                }
                $att = Attendance::insert($data); 

                //clear attendances
                $zk->clearAttendance();
            }
                // end working here
                $zk->enableDevice();
                // echo 'enabling device</br>';
                $zk->disconnect();
                // echo 'disconnected';

        } catch(\Exception $e){
            
            $zk->enableDevice();
            // echo 'enabling device</br>';
            $zk->disconnect();
            // echo 'disconnected';
            // dd($e);
            // return false;
        }
        
            $allAttendances = Attendance::orderBy('time_bs','desc')->paginate(32);
            return view('backend.pages.attendance.index',compact('allAttendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
    // attendance report
    public function fetchAttendance(Request $request){
        $users = User::all();
        $username = User::where('id',$request->user)->pluck('name')->first();
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;
    
        $attendances = Attendance::where('attendances.user_id',$request->user)->whereBetween('attendances.time_bs',[$request->date_from,$request->date_to])->orderBy('attendances.time_bs','desc')->get()->groupBy(function($a){
            return (\Carbon\Carbon::parse($a->time_bs))->format('Y-m-d');
        });
        // dd($attendances);
        return view('backend.pages.reports.attendance_report',compact('attendances','users','username','dateFrom','dateTo'));
    }
}
