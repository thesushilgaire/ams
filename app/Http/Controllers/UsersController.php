<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZKLibrary;
use App\Models\User;
use App\Models\UserTemplate;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        // try{
        //     $zk = new ZKLibrary('192.168.0.155', 4370, 'TCP');
        //     // echo 'Requesting for connection</br>';
    
        //     $zk->connect();
        //     // echo 'Connected</br>';
    
        //     $zk->disableDevice();
        //     // echo 'disabling device</br>';
    
        //     // start working here

        //     $users = $zk->getUser();
            
        //     // dd($users);
        //     // echo 'Getting users</br>';
        //     if(count($users) > 0 ){
        //         foreach($users as $key=>$u){

        //             //create users
        //             $user = User::firstOrCreate([
        //                 'id'=>$u[0],
        //                 'name'=>$u[1],
        //                 'role_id'=>$u[2],
        //                 'password'=>$u[3],
        //             ]); 

        //             // $f = $zk->getUserTemplate($user->id,6); //user id and finger print no(by defaut 6)
        //             // // create user templates
        //             // UserTemplate::firstOrCreate([
        //             //     'fp_length'=> $f[0],
        //             //     'user_id'=>$u[0],
        //             //     'fno'=> 6,
        //             //     'valid'=> $f[3],
        //             //     'template'=> $f[4]
        //             // ]);
        //         }
        //     }

        //     // end working here
        //     $zk->enableDevice();
        //     // echo 'enabling device</br>';

        //     $zk->disconnect();
        //     // echo 'disconnected';
            
        // }catch(\Exception $e){
        //         // dd($e);
        //         // return false;
        // }

        $allUsers = User::orderBy('created_at','desc')->get();

        return view('backend.pages.user.index',compact(['allUsers']));
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
        try{
            $zk = new ZKLibrary('192.168.0.155', 4370, 'TCP');
            // echo 'Requesting for connection</br>';

            $zk->connect();
            // echo 'Connected</br>';

            $zk->disableDevice();
            // echo 'disabling device</br>';
            // start working here
            
            $user = User::create([
                'name'=>$request->name,
                'password'=>$request->password,
                'role_id'=>$request->role,
                'email'=>$request->email
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
       //
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
