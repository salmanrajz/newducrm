<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Valorin\Random\Random;

class TestController extends Controller
{
    //
    public function Test(Request $request){
            $shortURL = "https://is.gd/OeN6S8";
            $finalURL = Self::getFinalURL($shortURL);
            echo "Final URL: " . $finalURL;
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
