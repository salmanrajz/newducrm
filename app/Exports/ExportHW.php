<?php

namespace App\Exports;

use App\Models\number_matcher;
use App\Models\TestNumberEmirti;
use App\Models\User;
use App\Models\WhatsAppMnpBank;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportHW implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //

        ini_set('memory_limit', '-1'); //300 seconds = 5 minutes
        ini_set('max_execution_time', '30000'); //300 seconds = 5 minutes
        // return $user = User::all();
        // return $data = TestNumberEmirti::select('number')->whereIn('count_digit', ['3', '2', '1', 'random'])
        // ->where('fiver_four',0)
        // ->offset(400000)
        // ->limit(100000)
        // ->get();
        // upr wala du neechy wala etisalat
        // return $data = TestNumberEmirti::select('number')->whereIn('count_digit', ['4'])
        // ->where('five_four',0)
        // ->offset(200000)
        // ->limit(100000)
        // ->get();
        // ->get();

        // return $data = WhatsAppScan::select('wapnumber')->whereIn('count_digit', ['3', '2', '1', 'random'])->offset(200000)->limit(100000)->get();
        // return $data = number_matcher::whereIn('plan', ['Easy Prepaid','Easy Prepaid','Extra Social'])->whereIn('prefix',['058','055','55','58'])->offset(46000)->limit(10000)->get();
        // return $data = number_matcher::whereIn('plan', ['Blank'])->whereIn('prefix',['058','055','55','58'])
        // ->offset(521000)
        // ->limit(20000)->get();
        // return $data = number_matcher::whereIn('plan', ['Flexi Prepaid'])->whereIn('prefix',['058','055','55','58'])
        // ->offset(160000)
        // ->limit(20000)->get();
        return $data = number_matcher::whereIn('plan', ['Easy Prepaid','Easy Prepaid','Extra Social', 'Pay as you go 2'])->whereIn('prefix',['058','055','55','58'])
        ->offset(10000)
        ->limit(10000)->get();
        // return $data = number_matcher::whereIn('plan', ['Flexi Prepaid'])->whereIn('prefix',['058','055','55','58'])->offset(21000)->limit(3000)->get();
        // return $data = number_matcher::whereIn('prefix',['058','055','55','58'])->limit(100000)->get();
        // return $data = number_matcher::whereIn('plan', ['Flexi Prepaid'])->whereIn('prefix',['058','055','55','58'])->offset(18000)->limit(5000)->get();
        // return $data = number_matcher::whereIn('plan', ['Power Plan 350 Flexi 12M'])->whereIn('prefix',['058','055','55','58'])->offset('5000')->limit(5000)->get();
        // return $data = number_matcher::whereIn('plan', ['Power Plan 350 Flexi 12M'])->whereIn('prefix',['058','055','55','58'])->offset(43000)->limit(10000)->get();
        // return $data = number_matcher::whereIn('plan', ['Power 225 Plan National 12M', 'Power Plan 300 - Flexi 12M'])->offset(10000)->limit(5000)->get();
        // return $data = WhatsAppMnpBank::Where('soft_dnd', 'like', '%REPLACE%')->get();

        // where('data_valid_from','April202K')->get();

        // return
    }
}
