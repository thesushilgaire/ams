<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use ZKLibrary; // Important
use DB;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Models\Setting;
use Auth;
use App\Models\Holiday;
use App\Models\Leave;
use Illuminate\Support\Arr;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::where('status',1)->first();
        try{
            $zk = new ZKLibrary($settings->ip, 4370, 'TCP');
            // echo 'Requesting for connection</br>';
            $zk->connect(); 
            // echo 'Connected</br>';
    
            $zk->disableDevice();
            // echo 'disabling device</br>';
            
            // start working here
            $attendances = $zk->getAttendance(); 
        
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
                    if($currentTime->between($startTime->addMinutes($checkInThreshold),$endTime->subMinutes($checkOutThreshold),true)){
                        $currentDate = substr($a[3],0,10);
                        $attends = Attendance::where('time_ad','like', "%{$currentDate}%")
                                            ->where('user_id',$a[1])
                                            ->whereBetween('time_ad',[$startTime->addMinutes($checkInThreshold),$endTime->subMinutes($checkOutThreshold)])
                                            ->get();
                        if(count($attends) >= 1){
                            $status = 'Early Check Out';
                        }
                        if(count($attends) < 1){
                            $status = 'Late Check In';
                        }
                    }
                    
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

    // attendance report
    public function fetchAttendance(Request $request){

        $username = User::where('id',$request->user)->pluck('name')->first();
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;
        $users = User::where('status',1)->get();

        // get holidays
        $holidays = $this->fetchHolidaysBetweenDates($dateFrom,$dateTo);

        // get leaves
        $leaves = $this->fetchLeavesOfUserBetweenDates($request->user,$dateFrom,$dateTo);
        
        // get dates between two days 
        $datesBetweenDays = [];
        $period = \Carbon\CarbonPeriod::create($dateFrom,$dateTo);
        foreach($period as $date){
                array_push($datesBetweenDays,$date->format('Y-m-d'));
        }
        $attendanceReport = [];

       // attendances and present days
       $attendances = Attendance::where('attendances.user_id',$request->user)->whereBetween('attendances.time_bs',[$request->date_from,\Carbon\Carbon::parse($request->date_to)->addDay()])->get();
       $totalAttendanceDates = [];
       foreach($attendances as $attendance){
            array_push($totalAttendanceDates,substr($attendance->time_bs,0,10));

            if(in_array(substr($attendance->time_bs,0,10),$datesBetweenDays)){
                array_push($attendanceReport,['date'=>substr($attendance->time_bs,0,10),'time'=>substr($attendance->time_bs,10),'status'=>$attendance->status,'remark'=>'Present']);
            }
        }

        // absent days 
        $absentDays = [];
        $leavesDays = [];
        $holidaysDays = [];
        // finding weekend,holiday,leave and absent dates
        foreach($datesBetweenDays as $date){
            if(\Carbon\Carbon::parse(bsToAd($date))->format('l') === 'Saturday'){
                array_push($attendanceReport,['date'=>$date,'time'=>'00:00','status'=>'','remark'=>'Weekend']);
            }
            if(in_array($date,$holidays)){
                array_push($attendanceReport,['date'=>$date,'time'=>'00:00','status'=>'','remark'=>'Holiday']);
                array_push($holidaysDays,$date);
            }
            if(in_array($date,$leaves)){
                array_push($attendanceReport,['date'=>$date,'time'=>'00:00','status'=>'','remark'=>'Leave']);
                array_push($leavesDays,$date);
            }  
            if(in_array($date,$totalAttendanceDates) == false && in_array($date,$leaves) == false && in_array($date,$holidays) == false && \Carbon\Carbon::parse(bsToAd($date))->format('l') != 'Saturday'){
                array_push($attendanceReport,['date'=>$date,'time'=>'00:00','status'=>'','remark'=>'Absent']);
                array_push($absentDays,$date);
            }
        }

        // grouping by date
        foreach($attendanceReport as $report){
            $finalReport[$report['date']][] = ['date'=>$report['date'],'time'=>$report['time'],'status'=>$report['status'],'remark'=>$report['remark']];
        }
        
        // sorting by date
        usort($finalReport, function($a, $b) {
            return new \DateTime($a[0]['date']) <=> new \DateTime($b[0]['date']);
          });

        $atts = Attendance::where('attendances.user_id',$request->user)->whereBetween('attendances.time_bs',[$request->date_from,\Carbon\Carbon::parse($request->date_to)->addDay()])->orderBy('attendances.time_bs','desc')->get()->groupBy(function($a){
            return (\Carbon\Carbon::parse($a->time_bs))->format('Y-m-d');
        });
        $countAttendance = count($atts);
        $countAbsent = count($absentDays);
        $countLeaves = count($leavesDays);
        $countHolidays = count($holidaysDays);
        // dd($finalReport);
            return view('backend.pages.reports.attendance_report',compact('countLeaves','countHolidays','countAbsent','countAttendance','finalReport','users','username','dateFrom','dateTo'));
        }

    // total holidays between two given dates 
    public function fetchHolidaysBetweenDates($from,$to){
        $totalHolidays = [];
        $holidays = Holiday::where('status',1)->select('start_date_bs','end_date_bs')->get();
        if(count($holidays) > 0){
            foreach($holidays as $holiday){
                $period = \Carbon\CarbonPeriod::create($holiday->start_date_bs,$holiday->end_date_bs);
                foreach($period as $date){
                    if(\Carbon\Carbon::parse($date)->between(\Carbon\Carbon::parse($from),\Carbon\Carbon::parse($to))){
                        array_push($totalHolidays,$date->format('Y-m-d'));
                    }
                }
            }
        }
        return $totalHolidays;
    }

    // total leaves of user between two dates
    public function fetchLeavesOfUserBetweenDates($userId,$from,$to){
        $totalLeaves = [];
        $leaves = Leave::where('user_id',$userId)->where('status',1)->select('start_date_bs','end_date_bs')->get();
        if(count($leaves) > 0){
            foreach($leaves as $leave){
                $period = \Carbon\CarbonPeriod::create($leave->start_date_bs,$leave->end_date_bs);
                foreach($period as $date){
                    if(\Carbon\Carbon::parse($date)->between(\Carbon\Carbon::parse($from),\Carbon\Carbon::parse($to))){
                        array_push($totalLeaves,$date->format('Y-m-d'));
                    }
                }
            }
        }
        return $totalLeaves;
    }

}

