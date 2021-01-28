<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use Image;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=Office::all();
        return view('backend.pages.office_details.index',compact('details'));
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
       //dd($request->all());
        $data=$request->all();
        try{
            $details=new Office;
            $details->office_name=$data['name'];
            $details->address=$data['address'];
            $details->phone_no=$data['phone_no'];
            $details->email=$data['email'];
              
            if($request->hasFile('image')){
                $imageName = time().'.'.$data['image']->extension();  
       
                $data['image']->move(public_path('Images/Logo/'), $imageName);
                $details->logo=$imageName;
                }
            
        
  
            $details->save();

            return redirect('office_details')->with('success','Data Inserted');


        }
        catch(\Exception $e)
        {
             return redirect('office_details')->with('error','Data Not Inserted');
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

        //dd($request->all());
        $data=$request->all();
        try{
            $details=Office::find($id);
            $details->office_name=$data['name'];
            $details->address=$data['address'];
            $details->phone_no=$data['phone_no'];
            $details->email=$data['email'];
              
            if($request->hasFile('image')){
                $imageName = time().'.'.$data['image']->extension();  
       
                $data['image']->move(public_path('Images/Logo/'), $imageName);
                $details->logo=$imageName;
                }
            
      
            $details->save();

            return redirect('office_details')->with('success','Data Inserted');


        }
        catch(\Exception $e)
        {
            dd($e);
            return redirect()->back();
           //  return redirect('office_details')->with('error','Data Not Inserted');
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
