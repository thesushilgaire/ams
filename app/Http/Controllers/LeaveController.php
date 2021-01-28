<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leave;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves_data=Leave::all();
        $users=User::select('id','name')->get();
        return view('Backend.pages.leave.index',compact('users','leaves_data'));
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
        $data=$request->all();
        try{
            $leave=new Leave;
            $leave->user_id=$data['user_id'];
            $leave->remarks=$data['remarks'];
            $leave->start_date_ad=$data['start_date_bs'];
            $leave->end_date_ad=$data['end_date_bs'];
            $leave->start_date_bs=$data['start_date_bs'];
            $leave->end_date_bs=$data['end_date_bs'];
            $leave->status=$data['status'];
            $leave->save();

            return redirect('leave');


        }
        catch(\Exception $e)
        {
             return redirect('leave')->with('error','Data Not Inserted');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $data=$request->all();
        try{
            $leave=Leave::find($id);
            $leave->user_id=$data['user_id'];
            $leave->remarks=$data['remarks'];
            $leave->start_date_ad=$data['start_date_bs'];
            $leave->end_date_ad=$data['end_date_bs'];
            $leave->start_date_bs=$data['start_date_bs'];
            $leave->end_date_bs=$data['end_date_bs'];
            $leave->status=$data['status'];
            $leave->save();

            return redirect('leave')->with('success','Data Inserted');


        }
        catch(\Exception $e)
        {
             return redirect('leave')->with('error','Data Not Inserted');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
