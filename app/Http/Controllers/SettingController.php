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
    
        $setting = Setting::find($request->id);
        $setting->ip = $request->ip;
        $setting->check_in = $request->check_in;
        $setting->check_out = $request->check_out;
        $setting->check_in_threshold = $request->check_in_threshold;
        $setting->check_out_threshold = $request->check_out_threshold;
        $setting->save();

        return redirect()->route('dashboard');
    }
}
