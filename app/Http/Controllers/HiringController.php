<?php

namespace App\Http\Controllers;

use App\Models\country_phone_code;
use Illuminate\Http\Request;

class HiringController extends Controller
{
    //
    //
    public function AddCandidate(Request $request)
    {
        // return $request;
        // $plan = Plan::where('status', '1')->get();
        $country = country_phone_code::select('name')->get();
        // $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New Candidate Form"]
        ];
        // $type = 'Vocus';
        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.add-new-candidate', compact('country', 'breadcrumbs'));
    }
}
