<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holiday=Holiday::orderBy('start_date_bs','desc')->get();
        return view('backend.pages.holiday.index',compact('holiday'));
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
            $leave=new Holiday;
            $leave->leave_name=$data['name'];
            $leave->start_date_ad = bsToad($data['start_date_bs']);
            $leave->end_date_ad = bsToad($data['end_date_bs']);
            $leave->start_date_bs = $data['start_date_bs'];
            $leave->end_date_bs = $data['end_date_bs'];
            $leave->status = $data['status'];
            $leave->save();

            return redirect('holiday')->with('success','Data Inserted');


        }
        catch(\Exception $e)
        {
             return redirect('holiday')->with('error','Data Not Inserted');
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
            $leave=Holiday::find($id);
            $leave->leave_name=$data['name'];
            $leave->start_date_ad=bsToad($data['start_date_bs']);
            $leave->end_date_ad=bsToad($data['end_date_bs']);
            $leave->start_date_bs=$data['start_date_bs'];
            $leave->end_date_bs=$data['end_date_bs'];
            $leave->status=$data['status'];
            $leave->save();

            return redirect('holiday')->with('success','Data Inserted');


        }
        catch(\Exception $e)
        {
             return redirect('holiday')->with('error','Data Not Inserted');
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
