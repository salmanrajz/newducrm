<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Valorin\Random\Random;

class TestController extends Controller
{
    //
    public function Test(Request $request){
            $data = '0522193518,0508164381,0552422089,0551040066,0586795650,0555870426,0502095122,0502108744,0544261646,0507399801,0508067101,0508971242,0529817005,0506437044,0503513469,0559066676,0555805232,0504700055';

        foreach (explode(',', $data) as $d) {

            // foreach($data as $d){
            $code = date('Y') . date('m') . date('d') . '77' . substr(time(), 6, 10);
            // if($d)
                $d = \App\Models\WhatsAppMnpBank::where('number',$d)->first();
                $d->delete();

                // echo $d->number_id . '<br>';
                // if (!\App\Models\WhatsAppMnpBank::where('number', '=', $d)->exists()) {

                //     \App\Models\WhatsAppMnpBank::create([
                //         'number_id' => $code,
                //         'number' => $d,
                //         'data_valid_from' => 'FromCRMViciDialManual',
                //         'status' => '0',
                //         'soft_dnd' => $d,
                //     ]);
                // }
            }
            // $shortURL = "https://is.gd/OeN6S8";
            // $finalURL = Self::getFinalURL($shortURL);
            // echo "Final URL: " . $finalURL;
    }
    //
    function getFinalURL($shortURL) {
            $ch = curl_init($shortURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $finalURL = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
            curl_close($ch);
            return $finalURL;
    }



}
