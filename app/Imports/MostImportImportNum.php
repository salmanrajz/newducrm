<?php

namespace App\Imports;

use App\Models\number_matcher;
use \App\Http\Controllers\ImportExcelController as mj;
use App\Models\TestNumberEmirti;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
// use romanzipp\QueueMonitor\Traits\IsMonitored; // <---




class MostImportImportNum implements ToCollection
    ,
    WithStartRow
    ,WithChunkReading,
    ShouldQueue


{
    // use IsMonitored;
    // use IsMonitoredlando;// <---
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 2;
    }
    // public function mj::clean($string)
    //         {
    //             $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    //             return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    //         }
    public function collection(Collection $collection)
    {
        //


        // dd($collection);
        ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
        ini_set('max_file_uploads','300');
        foreach ($collection as $row) {
            // dd($row);
            // if($row['9'] == 'number')
            // dd(mj::clean($row[4]));
            // dd($row[4]);
            if(is_numeric(mj::clean($row['4'])) && strlen(mj::clean($row['4'])) > 7){
                // dd(mj::clean($row[4]));
                // dd("number");
                if(isset($row[6])){

                    if ($row['6'] == 'TRUE' || $row['6'] == true) {
                        $prepaid = 'prepaid';
                    } else {
                        $prepaid = 'postpaid';
                    }
                }
                else{
                    $prepaid = 'not valid';
                }
                if (isset($row[5])) {

                    if ($row['5'] == '' || $row['5'] == null) {
                        $customerType = 'blank';
                    } else {
                        $customerType = $row[5];
                    }
                } else {
                    $customerType = 'Blank';
                }
                if (isset($row[10])) {
                    if ($row['10'] == '' || $row['10'] == null) {
                        $plan = 'blank';
                    } else {
                        $plan = $row[10];
                    }
                }
                else{
                    $plan = 'blank';
                }
                // dd("s");
                if (!number_matcher::where('number', '=', mj::clean($row[4]))->exists()) {
                    // $num = number_matcher::where('number',$`)
                    // if($numbe)
                    dd("ss");
                    number_matcher::create(

                        [
                            'number' => mj::clean($row['4']),
                            // 'customerType' => $row['0'],
                            'plan' => $plan,
                            // 'number' => $row['4'],
                            'post_or_pre' => $prepaid,
                            'customerType' => $customerType,
                            'prefix' => 52
                        ]
                    );
                    // dd("Ss");
                    $zp = substr(mj::clean($row[4]), 5);
                    // dd($zp);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    if (!$pp) {
                        // dd($row[4] . "ZZ");
                    }
                    $pp->fiver_four = 1;
                    $pp->save();
                }else{

                    // dd("ssss");
//
// dd($row[4]);
                    $n = number_matcher::where('number', mj::clean($row[4]))->first();
                    $n->plan = $plan;
                    $n->post_or_pre = $prepaid;
                    $n->customerType = $customerType;
                    $n->prefix = 52;
                    $n->save();
                    $zp = substr(mj::clean($row[4]), 5);
                    // dd($zp);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    if (!$pp) {
                        // dd($row[4] . "ZZ");
                    }
                    $pp->fiver_four = 1;
                    $pp->save();
                    // dd($row[4]);
                }
            }
            else if(is_numeric($row['9']) && strlen($row['9']) > 7){
                dd($row);
                if ($row['4'] == 'TRUE' || $row['4'] == true) {
                    $prepaid = 'prepaid';
                } else {
                    $prepaid = 'postpaid';
                }
                if ($row['1'] == '' || $row['1'] == null) {
                    $customerType = 'blank';
                } else {
                    $customerType = $row[0];
                }
                if ($row['8'] == '' || $row['8'] == null) {
                    $plan = 'blank';
                } else {
                    $plan = $row[8];
                }
                // dd($plan);
                if (!number_matcher::where('number', '=', $row[9])->exists()) {
                    // $num = number_matcher::where('number',$`)
                    // if($numbe)
                    // dd($row[9]);
                   $d =  number_matcher::create(

                        [
                            // 'number' => $row['9'],
                            // 'customerType' => $row['0'],
                            'plan' => $plan,
                            'number' => $row['9'],
                            'post_or_pre' => $prepaid,
                            'customerType' => $customerType,
                            'prefix' => 52
                        ]
                    );
                    // dd($d);
                    $zp = substr($row[9], 5);
                    // dd($zp);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    // if (!$pp) {
                    //     dd($row[9] . "ZZ");
                    // }
                    $pp->fiver_four = 1;
                    $pp->save();
                    // dd($zp);
                } else {
                    $n = number_matcher::where('number', $row[9])->first();
                    $n->plan = $plan;
                    $n->post_or_pre = $prepaid;
                    $n->customerType = $customerType;
                    $n->prefix = 52;
                    $n->save();
                    $zp = substr($row[9], 5);
                    // dd($zp);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    if (!$pp) {
                        // dd($row[4] . "ZZ");
                    }
                    $pp->fiver_four = 1;
                    $pp->save();
                }
            }
            else if(is_numeric($row['7']) && strlen($row['7']) > 7){
                // dd($row);
                if ($row['2'] == 'TRUE' || $row['2'] == true) {
                    $prepaid = 'prepaid';
                } else {
                    $prepaid = 'postpaid';
                }
                if ($row['1'] == '' || $row['1'] == null) {
                    $customerType = 'blank';
                } else {
                    $customerType = $row[1];
                }
                if ($row['6'] == '' || $row['6'] == null) {
                    $plan = 'blank';
                } else {
                    $plan = $row[6];
                }
                if (!number_matcher::where('number', '=', $row[7])->exists()) {
                    // $num = number_matcher::where('number',$`)
                    // if($numbe)
                    number_matcher::create(

                        [
                            // 'customerType' => $row['0'],
                            'plan' => $plan,
                            'number' => $row['7'],
                            'post_or_pre' => $prepaid,
                            'customerType' => $customerType,
                            'prefix' => 52
                        ]
                    );
                    $zp = substr($row[7], 5);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    // if (!$pp) {
                    //     dd($row[7] . "ppp");
                    // }
                    // dd($pp);
                    $pp->fiver_four = 1;
                    $pp->save();
                } else {
                    $n = number_matcher::where('number', $row[7])->first();
                    $n->plan = $plan;
                    $n->post_or_pre = $prepaid;
                    $n->customerType = $customerType;
                    $n->prefix = 52;
                    $n->save();
                    $zp = substr($row[7], 5);
                    // dd($zp);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    if (!$pp) {
                        // dd($row[4] . "ZZ");
                    }
                    $pp->fiver_four = 1;
                    $pp->save();
                }
            }
            // else if(!$row['10']){
            //     dd("ok");
            // }
            else if(is_numeric($row['10']) && strlen($row['10']) > 7){
                dd($row);
                if ($row['4'] == 'TRUE' || $row['4'] == true) {
                    $prepaid = 'prepaid';
                } else {
                    $prepaid = 'postpaid';
                }
                if ($row['0'] == '' || $row['0'] == null) {
                    $customerType = 'blank';
                } else {
                    $customerType = $row[0];
                }
                if ($row['8'] == '' || $row['8'] == null) {
                    $plan = 'blank';
                } else {
                    $plan = $row[8];
                }
                if (!number_matcher::where('number', '=', $row[10])->exists()) {
                    // $num = number_matcher::where('number',$`)
                    // if($numbe)
                    number_matcher::create(
                        [
                            // 'customerType' => $row['0'],
                            'plan' => $plan,
                            'number' => $row['10'],
                            'post_or_pre' => $prepaid,
                            'customerType' => $customerType,
                            'prefix' => 52
                        ]
                    );
                    $zp = substr($row[10], 5);
                    // dd($zp);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    // if (!$pp) {
                    //     dd($row[10] . "ZZ");
                    // }
                    $pp->fiver_four = 1;
                    $pp->save();
                } else {
                    $n = number_matcher::where('number', $row[10])->first();
                    $n->plan = $plan;
                    $n->post_or_pre = $prepaid;
                    $n->customerType = $customerType;
                    $n->prefix = 52;
                    $n->save();
                    $zp = substr($row[10], 5);
                    // dd($zp);
                    $pp = TestNumberEmirti::where('number', $zp)->first();
                    if (!$pp) {
                        // dd($row[4] . "ZZ");
                    }
                    $pp->fiver_four = 1;
                    $pp->save();
                }
            }
            else{
                // dd($row[7]);




            }

        }
    }
    public function batchSize(): int
    {
        return 5000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
