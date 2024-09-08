<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    //
    public function MyWhatsApp(Request $request){
        // return $request;
        $number = $request->id;
        $data = $request->data;
        if($data == 199){
            $a = "https://api.whatsapp.com/send?phone='".$number."'&text=";
                    $a .= "*HOME WIRELESS PLUS*  %0a";
                    $a .= "*Actual Price AED 299*  %0a";
                    $a .= "*PROMO OFFER AED 199*  %0a";
                    $a .= "*12 MONTHS CONTRACT*  %0a";
                    $a .= "*UNLIMITED 5G DATA*  %0a";
                    $a .= "*WITH 5G ROUTER%0a %0a";
                    return response()->json(['success' => $a]);
                }else{
                    $a = "https://api.whatsapp.com/send?phone='" . $number . "'&text=";
                    $a .= "HOME WIRLEESS ENTERTAINMENT%0a";
                    $a .= "*ACTUAL PRICE AED 399*  %0a";
                    $a .= "*PROMO OFFER AED 299*  %0a";
                    $a .= "*24 MONTHS CONTRACT*  %0a";
                    $a .= "*UNLIMITED 5G DATA*  %0a";
                    $a .= "*With 5G ROUTER*  %0a";
                    $a .= "🛑 *INTERNET CALLING PACK FOR 3 MONTHS*  %0a";
                    $a .= "🛑 *OSN PLUS (1 YEAR FREE)*  %0a";
                    $a .= "🛑 *AMAZON PRIME (1 YEAR FREE)*  %0a";
                    // $a .= " %0a %0a";
                    return response()->json(['success' => $a]);

        }

    }
    //
}


// *Home Wireless Plus*

// *Actual Price Aed 399*
// *PROMO OFFER AED 199*
// *12 MONTHS CONTRACT*
// *UNLIMITED 5G Data*
// *With 5G ROUTER*



// *Home Wireless ENTERTAINMENT*

// *Actual Price ~Aed 399~*
// *PROMO OFFER AED 299*
// *24 MONTHS CONTRACT*
// *UNLIMITED 5G Data*
// *With 5G ROUTER*

// *ALSO GET*

// 🛑 *INTERNET CALLING PACK FOR 3 MONTHS*

// 🛑 *OSN PLUS (1 YEAR FREE)*

// 🛑*AMAZON PRIME (1 YEAR FREE)*
