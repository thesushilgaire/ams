<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZKLibrary;
use App\Models\User;
use App\Models\UserTemplate;
use DB;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = User::orderBy('created_at','desc')->get();
        $shifts = Setting::all();
        return view('backend.pages.user.index',compact(['allUsers','shifts']));
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
        $settings = Setting::where('status',1)->first();

        try{
            $zk = new ZKLibrary($settings->ip, 4370, 'TCP');
            // echo 'Requesting for connection</br>';

            $zk->connect();
            // echo 'Connected</br>';

            $zk->disableDevice();
            // echo 'disabling device</br>';
            // start working here
            $status = 0;
            if($request->status){
                $status = $request->status;
            } else{
                $status = 0;
            }
            $user = User::create([
                'name'=>$request->name,
                'number'=>$request->number,
                'password'=>Hash::make($request->password),
                'role_id'=>$request->role,
                'email'=>$request->email,
                'address'=>$request->address,
                'dob'=>$request->dob,
                'id_card_number'=>$request->id_card_number,
                'degination'=>$request->degination,
                'joining_date'=>$request->joining_date,
                'shift_id'=>$request->shift,
                'status'=>$status,
                'bank_account'=>$request->bank_account,
                'pan_number'=>$request->parent_number,
                'blood_group'=>$request->blood_group
            ]);

            $zk->setUser($user->id,$user->id,$request->name,0,0);
            // echo 'Setting user with new data</br>';
            // end working here

            $zk->enableDevice();
            // echo 'enabling device</br>';

            $zk->disconnect();
            // echo 'disconnected';
        }catch(\Exception $e){
        }
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        return "Hello";
         // $user = User::find($id);
        // return view('backend.pages.user.edit',compact(['user']));
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
        $status = 0;
            if($request->status){
                $status = $request->status;
            } else{
                $status = 0;
            }
            $user = User::where('id',$id)->update([
                'name'=>$request->name,
                'number'=>$request->number,
                'password'=>Hash::make($request->password),
                'role_id'=>$request->role,
                'email'=>$request->email,
                'address'=>$request->address,
                'dob'=>$request->dob,
                'id_card_number'=>$request->id_card_number,
                'degination'=>$request->degination,
                'joining_date'=>$request->joining_date,
                'shift_id'=>$request->shift,
                'status'=>$status,
                'bank_account'=>$request->bank_account,
                'pan_number'=>$request->parent_number,
                'blood_group'=>$request->blood_group
            ]);

       return redirect()->back();
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
