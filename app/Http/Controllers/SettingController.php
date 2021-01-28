<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{


    public function index()
    {
        $setting=Setting::all();
        return view('backend.pages.settings.create',compact('setting'));
    }
    public function store(Request $request){


        $setting = new Setting;
        $setting->ip = $request->ip;
        $setting->shift_name = $request->shift_name;
        $setting->start_from_bs = $request->start_from_bs;
        $setting->start_from_ad = bsToad($request->start_from_bs);
        $setting->end_date_bs = $request->end_date_bs;
        $setting->end_date_ad = bsToad($request->end_date_bs);
        if($request->status){
            $setting->status = $request->status;
        } else{
            $setting->status = '0';
        }
        $setting->check_in = $request->check_in;
        $setting->check_out = $request->check_out;
        $setting->check_in_threshold = $request->check_in_threshold;
        $setting->check_out_threshold = $request->check_out_threshold;
        $setting->save();

        return redirect()->route('settings.index');
    }

    public function update(Request $request,$id){
        // dd($request->all());
        $setting = Setting::find($id);
        $setting->ip = $request->ip;
        $setting->shift_name = $request->shift_name;
        $setting->start_from_bs = $request->start_from_bs;
        $setting->start_from_ad = bsToad($request->start_from_bs);
        $setting->end_date_bs = $request->end_date_bs;
        $setting->end_date_ad = bsToad($request->end_date_bs);
        if($request->status){
            $setting->status = $request->status;
        } else{
            $setting->status = '';
        }
        $setting->check_in = $request->check_in;
        $setting->check_out = $request->check_out;
        $setting->check_in_threshold = $request->check_in_threshold;
        $setting->check_out_threshold = $request->check_out_threshold;
        $setting->save();

        return redirect()->route('settings.index');
    }
}
