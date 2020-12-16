<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function create(){
        $settings = Setting::first();
        
        return view('backend.pages.settings.create',compact('settings'));
    }

    public function update(Request $request){
    
        $setting = Setting::updateOrCreate([
            'ip'=>$request->ip,
            'check_in'=>$request->check_in,
            'check_out'=>$request->check_out,
            'check_in_threshold'=>$request->check_in_threshold,
            'check_out_threshold'=>$request->check_out_threshold
        ]);

        return redirect()->route('dashboard');
    }
}
