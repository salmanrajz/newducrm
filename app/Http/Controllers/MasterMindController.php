<?php

namespace App\Http\Controllers;

use App\Models\number_matcher;
use App\Models\TestNumberEmirti;
use Illuminate\Http\Request;

class MasterMindController extends Controller
{
    //
    public function MyPrefix(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "DU | ETI PREFIX"]
        ];

        return view('master-mind.my-prefix-card', compact('breadcrumbs'));
    }
    //
    public function DuQuickPay(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "DU | ETI PREFIX"]
        ];

        return view('master-mind.du-quick-pay', compact('breadcrumbs'));
    }
    //
    public function CheckPrefix(Request $request){
        // return "CheckPrefix";
             $data = TestNumberEmirti::where('five_five',1)->where('count_digit',3)->where('assigned',0)->limit(1000)->get();
            foreach($data as $d){
                // return $d;
                    $b = 97155 . $d->number;
                    $p = number_matcher::where('number',$b)->where('plan','Pay as you Go 2')->whereNull('count_digit')->first();
                    if($p){
                        $p->count_digit = $d->count_digit;
                        $p->save();
                    }
                    $pp = TestNumberEmirti::where('id',$d->id)->first();
                    if($pp){
                        $pp->assigned = 1;
                        $pp->save();
                    }
            }
            return "done" . time();

        // $data = number_matcher::whereIn('plan',['Pay as you go 2','Pay as you go'])->where('prefix','55')->whereNull('count_digit')->limit(5000)->get();
        // foreach($data as $d){
        //     // return $d->number;
        //      $z = substr($d->number,5,11);
        //      $k = TestNumberEmirti::where('number',$z)->where('five_five',1)->where('count_digit',3)->first();
        //      if($k){
        //          $b = 97155 . $k->number;
        //          $p = number_matcher::where('number',$b)->first();
        //          $p->count_digit = $k->count_digit;
        //          $p->save();
        //         //  return "done" . $b;
        //      }
        // }
        // return "done";
    }
    //
    public function TotalPrefix(Request $request){
        ini_set('memory_limit', '-1'); //300 seconds = 5 minutes

        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        // $cc = call_center::where('status', 1)->get();
        // $numberOfAgent = \App\Models\User::where('role', 'TeamLeader')->get();
        // return $counter = \App\Models\number_matcher::select()
         $counter = \DB::table('number_matchers')
        ->selectRaw('plan, count(plan) as count')
        ->where('prefix',$request->myprefix)
        // ->groupBy('day')
        ->groupBy('plan')
        ->get();
        // ->get();
        return view('master-mind.prefix-card', compact('breadcrumbs', 'counter'));
    }
    //
    public function TotalPrefixSlug(Request $request){
        // return $request->slug;
        $slug = $request->slug;
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];

        $data = number_matcher::where('plan',$slug)->get();
        return view('master-mind.master-mind-data', compact('breadcrumbs', 'data'));

    }
}
