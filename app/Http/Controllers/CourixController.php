<?php

namespace App\Http\Controllers;

use App\Models\courix_data;
use Illuminate\Http\Request;

class CourixController extends Controller
{
    //
    public function TodayDataCourix(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Delivery Attempt | Daily"]
        ];
        $data = courix_data::select('courix_datas.description')->whereNull('remarks')->groupBy('description')->get();
        // $cc = call_center::where('status', 1)->get();
        // $numberOfAgent = \App\Models\User::where('role', 'TeamLeader')->get();
        return view('admin.courix.attempt-view', compact('breadcrumbs','data'));
    }
}
