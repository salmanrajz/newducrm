<?php

namespace App\Http\Controllers;

use App\Exports\ActivationSheet;
use App\Exports\ExportHW;
use App\Exports\DncExport;
use App\Exports\FneReminder;
use App\Exports\P2PTracker;
use App\Exports\QualityExport;
use App\Models\call_center;
use App\Models\data_entry_game;
use App\Models\lead_sale;
use App\Models\main_data_manager_assigner;
use App\Models\main_data_user_assigner;
use App\Models\MissionDU;
use App\Models\product;
use App\Models\User;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;



class ReportController extends Controller
{
    //
    public function Token(Request $request){
        return view('admin.call.token');
    }
    //
    public function tlcard(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        // $cc = call_center::where('status', 1)->get();
        $numberOfAgent = \App\Models\User::where('role', 'TeamLeader')->get();
        return view('admin.report.tl-card', compact('breadcrumbs', 'numberOfAgent'));

    }
    // /
    //
    public function AddEntry(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        // $cc = call_center::where('status', 1)->get();

        $item = \App\Models\data_entry_game::whereNull('status')
        ->where('cm_status',auth()->user()->id)
        ->first();
        // return $item;
        if(!$item){
            // return "0";
            $item = \App\Models\data_entry_game::whereNull('status')
            ->whereNull('cm_status')
            ->where('type', 'Old')
            ->orderBy('created_at','desc')
            ->first();
            // return $item;
            $item->cm_status = auth()->user()->id;
            $item->save();
            $item = \App\Models\data_entry_game::whereNull('status')
            ->where('cm_status', auth()->user()->id)
            // ->where('type', 'Old')
            ->first();
        }
        return view('admin.lead.add-entry', compact('item', 'breadcrumbs'));


        // return view('admin.report.tl-card', compact('breadcrumbs', 'numberOfAgent'));

    }
    //
    //
    public function AddEntryNew(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        // $cc = call_center::where('status', 1)->get();

        $item = \App\Models\data_entry_game::whereNull('status')
        ->where('cm_status',auth()->user()->id)
        ->first();
        // return $item;
        if(!$item){
            // return "0";
            $item = \App\Models\data_entry_game::whereNull('status')
            ->whereNull('cm_status')
            ->where('type','NEW')
            ->orderBy('created_at','asc')
            ->first();
            // return $item;
            $item->cm_status = auth()->user()->id;
            $item->save();
            $item = \App\Models\data_entry_game::whereNull('status')
            ->where('cm_status', auth()->user()->id)
            ->first();
        }

        return view('admin.lead.add-entry-new', compact('item', 'breadcrumbs'));

        // return view('admin.report.tl-card', compact('breadcrumbs', 'numberOfAgent'));

    }
    //
    //
    public function AddRfs(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        // $cc = call_center::where('status', 1)->get();

         $item = \App\Models\fetch_data::whereNull('rfs_type')

        ->where('data_type', 'WithAddressAllFinal')
        // ->orderBy('id','desc')
        ->first();
        // return $item;
        // if(!$item){
        //     // return "0";
        //     $item = \App\Models\data_entry_game::whereNull('status')
        //     ->whereNull('cm_status')
        //     ->first();
        //     // return $item;
        //     $item->cm_status = auth()->user()->id;
        //     $item->save();
        //     $item = \App\Models\data_entry_game::whereNull('status')
        //     ->where('cm_status', auth()->user()->id)
        //     ->first();
        // }

        return view('admin.lead.add-rfs', compact('item', 'breadcrumbs'));

        // return view('admin.report.tl-card', compact('breadcrumbs', 'numberOfAgent'));

    }
    public function ViewFetchData(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        // $cc = call_center::where('status', 1)->get();

         $users = \App\Models\fetch_data::where('data_type', 'HomeWirelessEnt')
        // ->whereDate('fetch_datas.updated_at', Carbon::today())
            // ->whereMonth('created_at', Carbon::now()->month)

        // ->whereBetween('fetch_datas.updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])

        ->get();
        // return $item;
        // if(!$item){
        //     // return "0";
        //     $item = \App\Models\data_entry_game::whereNull('status')
        //     ->whereNull('cm_status')
        //     ->first();
        //     // return $item;
        //     $item->cm_status = auth()->user()->id;
        //     $item->save();
        //     $item = \App\Models\data_entry_game::whereNull('status')
        //     ->where('cm_status', auth()->user()->id)
        //     ->first();
        // }

        return view('admin.lead.ViewFetchData', compact('users', 'breadcrumbs'));

        // return view('admin.report.tl-card', compact('breadcrumbs', 'numberOfAgent'));

    }
    //
    public function ViewFetchDataNew(Request $request){
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        // $cc = call_center::where('status', 1)->get();

         $users = \App\Models\fetch_data::where('data_type', 'NewDataDaily')
        ->whereDate('fetch_datas.created_at', Carbon::today())
            // ->whereMonth('created_at', Carbon::now()->month)
//
        // ->whereBetween('fetch_datas.updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])

        ->get();
        // return $item;
        // if(!$item){
        //     // return "0";
        //     $item = \App\Models\data_entry_game::whereNull('status')
        //     ->whereNull('cm_status')
        //     ->first();
        //     // return $item;
        //     $item->cm_status = auth()->user()->id;
        //     $item->save();
        //     $item = \App\Models\data_entry_game::whereNull('status')
        //     ->where('cm_status', auth()->user()->id)
        //     ->first();
        // }

        return view('admin.lead.ViewFetchDataNew', compact('users', 'breadcrumbs'));

        // return view('admin.report.tl-card', compact('breadcrumbs', 'numberOfAgent'));

    }
    //
    public function SubmitEntry(Request $request){
        // return $request;

        if ($file = $request->file('file')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('file')));
            $image2 = file_get_contents($request->file('file'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'DataScan/' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $front_id = $originalFileName;
        }else{
            $front_id = 'Blank';
        }
            // $file->move('documents', $front_id);
        $d = data_entry_game::where('cmid',$request->cmid)->first();
        $d->address = $request->address;
        $d->post_or_hw = $front_id;
        $d->status = $request->status;
        $d->save();
        return "1";

    }
    //
    public function SubmitEntryNew(Request $request){
        // return $request;

        if ($file = $request->file('file')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('file')));
            $image2 = file_get_contents($request->file('file'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'DataScan/' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $front_id = $originalFileName;
        }else{
            $front_id = 'Blank';
        }
            // $file->move('documents', $front_id);
        $d = data_entry_game::where('cmid',$request->cmid)->first();
        $d->address = $request->address;
        $d->post_or_hw = $front_id;
        $d->status = $request->status;
        $d->save();
        return "1";

    }
    //
    public function SubmitEntryRfs(Request $request){
        // return $request;


            // $file->move('documents', $front_id);
        $d = \App\Models\fetch_data::where('cmid',$request->cmid)->first();
        $d->rfs_type = $request->rfs_type;
        $d->save();
        return "1";

    }
    // /
    public function tlreport(Request $request){
        //
        // return "s";
        $pageConfigs = ['pageHeader' => false];
        $product = product::where('status', 1)->get();
        $numberOfAgent = \App\Models\User::where('teamleader',$request->id)->where('role', 'Sale')->get();
        $tlid = $request->id;
        return view('/content/dashboard/tlreport', ['pageConfigs' => $pageConfigs, 'product' => $product, 'numberOfAgent' => $numberOfAgent, 'tlid'=> $tlid]);
        //
    }
    //
    public function mainreport(Request $request){
        // return $request;
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        $cc = call_center::where('status',1)->get();
        return view('admin.report.view-main-report', compact('breadcrumbs','cc'));

    }

   public function ActivationSheet(Request $request){
        // return\
        ob_end_clean();

        return Excel::download(new ActivationSheet, 'p2p_mnp_activation.xlsx');
    }
    //

    public function DncExport(Request $request){
        // return\
        if (ob_get_contents()) ob_end_clean();


        return Excel::download(new DncExport, 'DncExport.xlsx');
    }
    //
    public function AllActivationSheet(Request $request){
        // return\
        ob_end_clean();

        return Excel::download(new P2PTracker, 'p2p_mnp_activation.xlsx');
    }
    //
    //
    public function ExportHW(Request $request){
        // return\
        // ob_end_clean();
        if (ob_get_contents()) ob_end_clean();


        return Excel::download(new ExportHW, 'ExportHW.xlsx');
    }
    //
    public function Scrape(Request $request){
//         $html = '
// <html>
// <body>
// <h1 id="test">test element text</h1>
// <h1>test two</h1>
// </body>
// </html>
// ';
        $html = 'https://portal.tamex.ae';
        $ch = curl_init($html);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,
            1
        );
        $html = curl_exec($ch);
        curl_close($ch);
        echo $html;

        // $dom = new DOMDocument();
        // $dom->loadHTML($html);
        // $xpath = new DOMXPath($dom);
        // $res = $xpath->query('//input[@id="company_mobile"]');
        // if ($res->item(0) !== NULL) {
        //     return $test = $res->item(0)->nodeValue;
        // }

    }
    //
    public function DataScience(Request $request){
        $data = '0561404001,0548887797,0548880002,0506895552,0563664666,0569093888,0548882262,0509619669,0545678670,0569032222,0563417777,0563517777,0563052222,0545552525,0508007049,0547328888,0569677676,0545005506,0547888823,0509296296,0548883005,0509911951,0567999968,0509469969,0566118117,0562035555,0548882242,0548882240,0547000667,0547000737,0548881886,0506455456,0564432432,0509599119,0545950005,0548880444,0548881277,0509252424,0547007500,0567091111,0563300550,0566996677,0566116766,0569797776,0563064306,0569888805,0565770775,0543528888,0563040301,0567266661,0509449479,0567652222,0564714714,0548880887,0565628282,0569604444,0567092222,0563927777,0547368888,0567777830,0564300440,0567809009,0543311800,0506486489,0545447771,0548883020,0545080006,0565590090,0545555061,0544484804,0563965555,0569064444,0567111994,0562424774,0561311316,0565515560,0569179977,0563773379,0563666888,0547744455,0569888872,0568686875,0545777441,0545544499,0565866669,0569682222,0569836666,0564929244,0563588188,0563311373,0569043333,0561111603,0569396396,0563487777,0509323293,0567855557,0502616113,0509285050,0563577772,0567770660,0542060050,0561553511,0563534445,0543255536,0569009606,0506404774,0566766444,0569847777,0562220900,0501472929,0543377222,0562202228,0547321111,0567231111,0547231111,0567333111,0547533345,0564555502,0565603020,0509779597,0567447644,0548881805,0567171760,0565577477,0567767705,0506099449,0568098900,0545550999,0548880005,0509496161,0545555090,0562200611,0548889778,0567066662,0542235999,0542555252,0562222005,0544888832,0545990111,0545120111,0502330082,0565515570,0506622572,0544744040,0504532332,0562442626,0567872828,0509237923,0562626622,0507593434,0543333459,0508939395,0509213921,0506406116,0508893232,0542555585,0542220700,0565888820,0568799995,0567844144,0544897770,0548882083,0542220800,0569336366,0548883007,0566788008,0567767709,0562225507,0565777252,0548887977,0548883633,0567576776,0569376666,0503817381,0548880222,0569177778,0567777458,0509494937,0545905000,0567203333,0568070608,0508269269,0562788788,0548880886,0567577677,0562008808,0567777530,0547349999,0562908989,0548880009,0548880006,0545558889,0548880003,0508489484,0544551100,0567461111,0567462222,0548880883,0548880889,0562524444,0547968999,0568055553,0563916666,0565808777,0563666604,0562040500,0563997997,0568688803,0547041111,0548880882,0562672626,0567788210,0503823827,0506322442,0544666681,0562822999,0548883323,0562866688,0568998448,0563772773,0566744448,0562777123,0509298298,0549900567,0562093333,0569814444,0569075555,0561329292,0563652222,0563313116,0545555048,0563496666,0561561414,0548880038,0567802002,0562094444,0564765555,0509560303,0567670706,0562516666,0569622221,0547026666,0569083333,0504096262,0567060303,0545333350,0562222601,0562222605,0567847888,0547043333,0508002585,0565780777,0547148888,0567577676,0506556181,0506100722,0562299884,0567700567,0563599991,0566277727,0548880885,0554600197,0544690090,0564703333,0563131441,0548881001,0562222603,0562222608,0562222609,0542007030,0544557544,0508740074,0543450707,0505373734,0563039090,0544775599,0542116661,0569166566,0567844443,0561555509,0564666346,0545495995,0561522525,0508174499,0563495555,0548887828,0562060808,0503038138,0561531533,0543288887,0567755060,0567666615,0567683333,0564422141,0568666619,0542888898,0509337332,0505524955,0563407080,0565588336,0507488668,0544117116,0547631111,0547044440,0544554200,0569002626,0565715557,0548884010,0545757576,0545222214,0551379119,0563353330,0563011119,0547333831,0547773039,0564569990,0542288777,0548883070,0567464447,0542333360,0566322224,0566620920,0509323553,0544994100,0544994200,0501441808,0569751111,0569761111,0568981991,0542999987,0569547777,0509446363,0548880077,0567983333,0547361111,0545070004,0545070006,0567799757,0506063099,0547892888,0562666637,0565823232,0545499993,0544555252,0567703090,0544666693,0544664660,0542230888,0563733223,0543335999,0545556333,0566455552,0585306311,0547111400,0567555789,0503007473,0561241240,0567111102,0509959567,0564499662,0568066566,0563666625,0563773376,0545509500,0569848777,0543999666,0543336700,0545550141,0547772220,0544277779,0562422424,0567771140,0565750075,0567288889,0548882772,0547531111,0563751111,0568887724,0561588500,0568588500,0542888808,0562066220,0507724004,0544723333,0547737007,0565785785,0568313132,0566596565,0565773336,0548880089,0563088803,0504833003,0567057755,0506651771,0543040804,0548881855,0507232030,0565576776,0543777507,0509447797,0548882818,0562020797,0566450050,0509599569,0508554424,0501440885,0548882802,0563836366,0548883858,0568855992,0508820120,0566631515,0509919132,0568766663,0562200223,0545333340,0502929656,0568857878,0545005441,0545006067,0566776323,0503201516,0568309990,0568689090,0561555567,0567080109,0563496669,0561311108,0505005488,0509596464,0567322220,0542888282,0563904444,0566505603,0545027770,0507098050,0561414418,0543444888,0568887795,0563677772,0563677774,0568044443,0568077779,0562999981,0543335599,0547772994,0566767887,0547722600,0566336001,0567588338,0563044449,0565668989,0543333460,0566343400,0566330334,0544882887,0569455552,0548887120,0542200082,0567267626,0567654654,0562888896';
        foreach (explode(',', $data) as $kn) {

            // foreach($data )
            $s = main_data_user_assigner::select('users.email', 'whats_app_mnp_banks.number', 'whats_app_mnp_banks.created_at', 'whats_app_mnp_banks.updated_at', 'main_data_user_assigners.status')
                ->join(
                    'users',
                    'users.id',
                    'main_data_user_assigners.user_id'
                )
                ->join(
                    'whats_app_mnp_banks',
                    'whats_app_mnp_banks.id',
                    'main_data_user_assigners.number_id'
                )
                ->where('whats_app_mnp_banks.number', $kn)->first();
            if ($s) {

                echo $s->number . ',' . $s->email . ',' . $s->created_at . ',' . $s->updated_at . ',' . $s->status . '<br>';
            } else {
                echo $kn . ',' . ' => NOT FOUND' . '<br>';
            }
        }
    }
    //
    public function lastthreemonths(Request $request){
        // return "lastthreemonth";
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Main Daily | Monthly Report"]
        ];
        $cc = call_center::where('status', 1)->get();
        $period = now()->subMonths(2)->monthsUntil(now());

        $data = [];
        foreach ($period as $date) {
            $data[] = [
                'month' => $date->shortMonthName,
                'year' => $date->year,
                'monthId' => $date->month
            ];
        }

        // dd($data);
        return view('admin.report.last-three-months', compact('breadcrumbs', 'cc','data'));
    }
    //
    //     5G:971523393447
    // AccountID: 1.54200319
    // Created: 18/03/2023
    // Expired: 18/03/2024
    //
    public static function InitiateWhatsAppVerification($number)
    {
        // return "Agni";
        // return $details;
        // return $details['lead_no'];
        // $token = env('FACEBOOK_TOKEN');
        $details = [
                'numbers' => '923121337222' . ',' . $number,
                // 'numbers' => '923121337222,971522221220,923103862624,923340123430,923328281218,923123025802',
            ];
        // $token = 'EAAgQb8SiR8UBOz4ybhAQYOTOxP2ZCOJmZBLaNuJLMEdfZAkvRi0DW3ZAKr9NU0RGb9xpjFW1OHTqNYOMXvnCL6KRqZCx0eX7SdhZBZBtret03sM8YEhSuG2n7RjQZC3UV1eHqNepnSPr1X6R1GZB26MOZBvVm4oF2ifw16vDWYNgOCSKMdsl7SDExip2hT';
        foreach (explode(',', $details['numbers']) as $nm) {

            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://graph.facebook.com/v14.0/201026003096258/messages',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_POSTFIELDS => '{
            //     "messaging_product": "whatsapp",
            //     "to": "' . $nm . '",
            //     "type": "template",
            //     "template": {
            //         "name": "press_start",
            //         "language": {
            //             "code": "en_US"
            //         },

            //     }
            //     }',
            //     CURLOPT_HTTPHEADER => array(
            //         'Content-Type: application/json',
            //         'Authorization: Bearer ' . $token
            //     ),
            // ));

            // 385
            // $response = curl_exec($curl);

            // curl_close($curl);
            // echo $response;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://botsailor.com/api/v1/whatsapp/send/template?apiToken=5779%7C7YrGT0byM5f75LEi1l6Jycp5S4mhqTMdbvE7KXzl&phone_number_id=414127678450960&template_id=102818&template_quick_reply_button_values=%5B%2266d999493fca1%22%5D&phone_number=' . $nm . '"',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;


            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://botsailor.com/api/v1/whatsapp/send/template?apiToken=5779|7YrGT0byM5f75LEi1l6Jycp5S4mhqTMdbvE7KXzl&phoneNumberID=414127678450960&botTemplateID=102818&botTemplateQuickreplyButtonValues=%5B%22zvU3bJUf68dWGIJ%22%5D&sendToPhoneNumber="' . $nm . '"',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'GET',
            //     CURLOPT_HTTPHEADER => array(
            //         'Cookie: XSRF-TOKEN=eyJpdiI6IjFKUWFWUmZCM1NnY2pHT1laRnNoM3c9PSIsInZhbHVlIjoiWHAzV0ZIc2tCU1c2ZnEyVVN6eDYwMGRRU0R0QXFYclJMaXFrRnJyTkFET1pNWk1DcVREaXNuOGI1R0syTzJOVjYzOWloSGpFMnNnWjQxc25HellBdzhIWjNxbXRzNVpTbnNaQW04eTVwUUorYTN2bm42N1EvUWN4SG1KcS9xQVYiLCJtYWMiOiIyZDFhNGRiODVjZDZiNjM3NjRkZjJkNGJhNjMyODZiYjFiYTYwNTdlMTY0Yjk0ZDBkNzliZWJjYmM4NTU2ZDM1IiwidGFnIjoiIn0%3D; _btx5i0h383fscy9=_btxvlo093hsma6y1; botsailor_session=eyJpdiI6IjZZVWRyNjYvT3BSSGtYZUlDTERvV2c9PSIsInZhbHVlIjoiWFVZTzJYRHRycEJNUllqWnFVZnNlZ0poRXpIQ0FGR1QwUllLdHNsNVd3bjhTdHpiMzlTMUkzRytKSkk4eDJQd1VwQytSYXFlSzFQdDRJQlUvRzBxZ2R4TmxoWXRNd1grUGxWLzc5bnplZkk5dzVVTTNlc2Q4U0hqNGFxUm9HUmMiLCJtYWMiOiJlZTM5Zjk2YzNmNzc5ZjA4OTJmYTI2YmNhNjNkOWIxM2M0OTMzMzQzYTVhMDJkYWJmYjkwMmIzOTk0OWMyYzZmIiwidGFnIjoiIn0%3D'
            //     ),
            // ));

            // $response = curl_exec($curl);

            // curl_close($curl);
            // echo $response;

        }

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    //
    // public function
    public static function OrderTracking($mobile,$code){
        // return $request->code
        $url = "orderCode=".trim($code)."&mobile=".trim($mobile). "&CSRFToken=e9e2b31c-2f0f-40ac-82a5-dce6a26ddb49";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shop.du.ae/en/order-tracking/searchOrderByMobile',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $url,
            CURLOPT_HTTPHEADER => array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                'Accept-Language: en-US,en;q=0.9',
                'Cache-Control: max-age=0',
                'Connection: keep-alive',
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: JSESSIONID=DFACFC12F3885C420D57F8C41C0B5982; ROUTEID=.node4; NSC_IZCNBTXFC_TTM_443=ffffffffaf1cfa1545525d5f4f58455e445a4a423660; _gcl_au=1.1.861997431.1714595395; _omappvp=5orFU3ykvjel3RGrALwSaax1dEYGM7ui9Vedk4nR5zNbjjGDwUGQGxAwhtPkqEm4niXUXxUJQNyEQ01fVMjMDN2ZSReVWMya; _omappvs=1714595395226; _ga=GA1.2.219533106.1714595395; _gid=GA1.2.403332251.1714595395; _dc_gtm_UA-407073-6=1; _scid=589a5e46-1124-4281-9c6d-ded153754b26; _scid_r=589a5e46-1124-4281-9c6d-ded153754b26; _uetsid=92648ee007f911ef9ad5e9354b0f8a53; _uetvid=9264807007f911ef9409dbaaa8ffd87c; du-cart=d4f0ff34-201b-460a-b2d3-5ae93a1d7705; _fbp=fb.1.1714595395772.1047414484; _clck=1svz3yf%7C2%7Cfle%7C0%7C1582; _tt_enable_cookie=1; _ttp=Fh-kgAogdUsLOGdwjEn5UKxPLc7; _sctr=1%7C1714590000000; _clsk=17eevc7%7C1714595396975%7C1%7C1%7Cx.clarity.ms%2Fcollect; userjournies=e62e9545-ce51-47eb-acde-2bd0dc3da8d5; s2stracking=5d83d6f5-e64f-4114-876f-e178aa4bb90d; NSC_IZCNBTXFC_TTM_443=ffffffffaf1cfa1545525d5f4f58455e445a4a423660; du-cart=d4f0ff34-201b-460a-b2d3-5ae93a1d7705',
                'Origin: https://shop.du.ae',
                'Referer: https://shop.du.ae/en/order-tracking',
                'Sec-Fetch-Dest: document',
                'Sec-Fetch-Mode: navigate',
                'Sec-Fetch-Site: same-origin',
                'Sec-Fetch-User: ?1',
                'Upgrade-Insecure-Requests: 1',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                'sec-ch-ua: "Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "macOS"'
            ),
        ));



        $html = curl_exec($curl);

        curl_close($curl);
        // echo $html;

        // / Create a new DOMDocument object and load the HTML content
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        libxml_use_internal_errors(true);

        $doc->loadHTML($html);

        // Create a new DOMXPath object to query the HTML
        $xpath = new DOMXPath($doc);

        // Specify the ID of the HTML element you want to extract data from
        $className = 'status__tittle';

        // Query the HTML to find the element with the specified ID
        $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' {$className} ')]");

        // Loop through each matching element and display its content
        foreach ($elements as $element) {
            echo $element->textContent . "<br>";
        }
        echo '<br>' . ' => Salman';
        // $element = $xpath->query("//*[@class='{$id}']")->item(0);

        // // Get the content of the element based on the ID
        // if ($element) {
        //     $data = $element->textContent;
        //     echo $data;
        // } else {
        //     echo "Element with ID '{$id}' not found";
        // }
        // return "";
    }
    //
    public function TestNumber(Request $request){
        // return $page_name = $request->segment(3);
        // return request()->route()->getActionName();

        return url()->current();
         $d = \App\Models\data_entry_game::where('cm_status',719)
        // ->whereNotNull('post_or_hw')
        ->whereIn('status',['Home Wireless Plus','Home Wireless Entertainment','Postpaid'])
        // ->OrWhere('post_or_hw','!=','B')
        ->whereDate('data_entry_games.updated_at', Carbon::today())->get();
        foreach($d as $dd){
            $dim = \App\Models\data_entry_game::where('id',$dd->id)->first();
            $dim->status = NULL;
            $dim->post_or_hw = NULL;
            $dim->save();
        }
        return "done";
        return $ddm = lead_sale::where('customer_number', '0552264892')
            ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001'])
            ->where('is_allowed', 0)
            ->first();

        $data = 'CM0001760697,CM0001770458,CM0001762837,CM0001763502,CM0001763039,CM0001763234,CM0001763076,CM0001763063,CM0001764578,CM0001765452,CM0001766621,CM0001766737,CM0001768084,CM0001768757,CM0001769371,CM0001769135,CM0001769223,CM0001772458,CM0001770632,CM0001772948,CM0001785468,CM0001785932,CM0001787109';
        // foreach()
        // foreach
        foreach (explode(',', $data) as $s) {
             $data = \App\Models\lead_sale::where('reff_id',$s)->first();
            if($data){
                $data = lead_sale::findorfail($data->id);
                $data->status = '1.15';
                $data->save();
                \App\Models\remark::create([
                    'remarks' => 'Lead Reject By DU',
                    'lead_status' => '1.01',
                    'lead_id' => $data->id,
                    'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                    'user_agent' => 'Verified Bot',
                    'user_agent_id' => $data->saler_id,
                ]);
                // return "Done";
                //  echo $data->emirate_id .','.$data->nationality . '<br>';
            }else{
                // echo 'NF' . '<br>';
            }
        }
        return "z";
        // $data = array();
        // return $request;
        // $number =  $request['chat_id'];

        // $str_to_replace = '0';

        // // $input_str = '9715088880Z9714088880Z8088880Z';

        // $l =  $output_str = $str_to_replace . substr(
        //     $number,
        //     1
        // );

        // $f = lead_sale::where('customer_number',$l)->where('status','1.22')->first();
        // $f->status='1.01';
        // $f->remarks = 'Lead Verified, Please do pre check and make tracking after checking';
        // $f->save();

        //  return $data['data'] = $request['user_input_data'];
        //   $manage = json_decode($request['user_input_data']);

            // dd($manage);
//
// sssqyndwfcbnxlfr
            // 971502949563
        $number = '971523792454';
    return \App\Http\Controllers\ReportController::InitiateWhatsAppVerification($number);
//         return view('email.cancellation-case');
//         $string = '"Win 10-BUPartnerCC - Desktop Viewer
// File Edit View Navigate Query Tools Help
// Account:1.54700178 > Account:
// Saved Queries:
// Services Home Service Campaign
// Activities Campaigns Opportunities Dealers
// Inbound Calls
// Vouchers Calling Cards
// Mobile Number Portability Requeste
// Home
// Customers Activation Portal
// Accounts
// Agreements
// Accounts Home Accounts List
// Account Explorer
// Collections Wifi Accounte
// Menu▼ Map Query Results
// eSHOP Order Id: <Case Required>
// eSHOP Order Details
// Menu Query
// Query Results
// Customer: Guest
// Customer Id: 50763921
// Order Status: ORDER_ACTIVATEI
// Cancellation Reason:
// Personal Details
// Payment Info
// First Name: Oussama Saleh Sal
// Amount:
// Contact Email: Oussamasaleh 76@ Transaction Referecne:
// Phone Number: 971544490848
// ID Number: 784197618455089
// ID Type: EMIRATEID
// Passport Issue Country: Lebanon
// Transaction Number:
// Payment Id:
// Expiry Date: 2025-03-27T20:00:
// Date Of Birth: 1976-11-15T20:00
// Order Entries | Menu ▾
// Entry ID
// DIPID
// Phone Number Passcode
// > 0
// 971552519638
// ES0755467
// Type here to search
// E
// C
// Account Id: 1.49262025
// Other Comments:
// ECB Check:
// Order Comments:
// Shipping Address: 20 d Street
// Currency: AED
// 80A villa mirdif
// Total Price:
// Expected Delivery Date: 2023-04-12T12:10
// Delivered Date: 2023-04-12T07:07
// Order Cancelled Date:
// Order Ready Date: 2023-04-11T12:10
// BSC SID
// ERPID
// Number Category Article Number
// eshopCommitment 1-9YWL1W8_2
// Identifier
// Description
// Home Wireless Ente Home Wireless 5G HOLTE
// Intgration ID
// d0
// Trouble Tickets
// The selected field 19 Case sensitive: 1 of 1
// | 1 of 1+
// 1-1 of 1
// BBK837 Vate Windows
// COM-ROUTER-BNDI 1-BBK8S37
// Go to Settings to activate Windows.
// 9:45 PM
// 4/8/2024
// 22"';

//         // $geeks = 'Welcome 2 Geeks 4 Geeks.';

//         // Use preg_match_all() function to check match
//         preg_match_all('!\d+!', $string, $matches);

//         // print output of function
//         // print_r($matches[0]);
//         $count = count($matches[0]);
//         for($i=0;$i<$count;$i++){
//             // echo $matches[$i] . '<br>';
//             // echo $matches[0][$i] . '<br>';
//             $mc = strlen(trim($matches[0][$i]));
//             // echo
//             if($mc == 12){
//                 echo $i . '>'. $matches[0][$i] . '<br>';

//             }
//         }
        // if(count($matches[18]) > 10){
        //     return "Zero";
        // }


        // return "Zero";
        $number = '971551427563';
        $cmnumber = '971569075846';
        $account_code = '1.4189374';
        $lead = [
            'customer_name' => 'Imtiaz Ali',
            'nationality' => 'Pakistan',
            'customer_number' => $cmnumber,
            'lead_type' => 'Refferal',
            'title' => 'Request for Approval // HW to Fiber // ' . $number,
            'lead_date' => \Carbon\Carbon::today(),
            'submission_type' => 'Upgrade',
            'hw_type' => '5G Plus',
            'hw_number' => $number,
            'hw_account_number' => $account_code,
            'plan_details' => 'Du Home Starter 409 without contract and 50% discount, 250 mbps speed , landline 2000 mins',
            'pilot' => 'Refferal',
            'pilot_offer' => 'Refferal',
            'gis_project' => 'R-BL',
            'giad' => 'DXB_E3378R_10489_001009002',
            'eid_number' => '• 784-1981-8087413-7',
            'eid_expiry' => '16/01/2025',
            'email' => 'salmanahmedrajput@outlook.com',
            'full_address' => 'Flat no 302, Al maktoum Building, ,Warsan 4th,  International city Phase 2',
            'hw_active_date' => '17/04/2023',
            'hw_expiry' => '17/04/2024'
        ];
        \Mail::send(
            'email.approval-table',
            compact('lead'),
            function ($message) use ($lead) {
                $message->to('parhakooo@gmail.com', 'Parhakooo')
                ->cc(['sales@vocus.ae','shahzaib.hasan@du.ae'])
                ->subject($lead['title']);
                $message->from('sales@vocus.ae', 'Vocus Sales');
            }
        );

        // // $client = new \Predis\Client('tcp://40.71.59.120:6379');
        // // //$client = new Predis\Client();
        // // $client->set('foo', 'bar');
        // // $value = $client->get('foo');
        // // return $value;
        // // exit;

        // // return "Chala ja BSDK";
        // // $ManagerID = User::select('id')->whereIn('users.role', ['FloorManager'])
        // // ->where('agent_code', 'CC3')
        // // // ->where('email','')
        // // ->first();
        // // $checker  = main_data_manager_assigner::select('main_data_manager_assigners.number_id', 'main_data_user_assigners.status', 'main_data_manager_assigners.id')
        // // ->Join(
        // //     'main_data_user_assigners',
        // //     'main_data_user_assigners.number_id',
        // //     'main_data_manager_assigners.number_id'
        // // )
        // // ->Join(
        // //     'users','users.id','main_data_user_assigners.user_id'
        // // )
        // // ->whereNull('main_data_user_assigners.status')
        // // // ->where('users.agent_code', 'CL1')
        // // // ->whereIn('users.email', ['abdulwasay@cl1.com','zunaif@cl1.com', 'umair-saleem@cl1.com','sumera@cl1.com','asad@cl1.com','asadbaig@cl1.com','saad-ahmed@cl1.com', 'saraateeq@cl1.com', 'Farajahmed@CL1.com'])
        // // ->whereIn('users.email', ['ammar@cl1.com'])
        // // ->get();
        // // // $checker = main_data_manager_assigner::where('manager_id',$ManagerID->id)->whereNull('main_data_manager_assigners.status')->limit(1000)->get();
        // // foreach ($checker as $k) {
        // //     // $kk = WhatsAppMnpBank::where('id',$k->number_id)->first();
        // //     $kkk = main_data_manager_assigner::where('id', $k->id)->first();
        // //     // if($kk){
        // //     //     $kk->is_status = 0;
        // //     //     $kk->save();
        // //     //     // $kk->delete();
        // //     //     // $kk->is_status = NULL;
        // //     // }
        // //     if ($kkk) {
        // //         $kkk->status = 3;
        // //         $kkk->save();
        // //     }
        // //     $zk = main_data_user_assigner::where('number_id', $k->number_id)->whereNull('main_data_user_assigners.status')->first();
        // //     if ($zk) {
        // //         $zk->delete();
        // //     }
        // // }
        // // return "Abdullah -  Reset";

        // //         ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes


        // //         // <?php
        // //         $data = 971581000000;
        // //         $numberstart = MissionDU::orderBy('id', 'desc')->first();
        // //         if (!$numberstart) {
        // //             $numberstart = 971581000000;
        // //         } else {
        // //             $numberstart = $numberstart->last_num;
        // //         }

        // //         $end = $numberstart + 30;

        // //         // $data = '971581000199,971581000200,971581000201,971581000202,971581000203,971581000204,971581000205,971581000206,971581000207,971581000208,971581000209,971581000210,971581000211,971581000212,971581000213,971581000214,971581000215,971581000216,971581000217,971581000218,971581000219,971581000220,971581000221,971581000222,971581000223,971581000224,971581000225,971581000226,971581000227,971581000228,971581000229,971581000230,971581000231,971581000232,971581000233,971581000234,971581000235,971581000236,971581000237,971581000238,971581000239,971581000240,971581000241,971581000242,971581000243,971581000244,971581000245,971581000246,971581000247';
        // //         // $data = '971581000199,971581000200,971581000201,971581000202';

        // // for ($d = $numberstart; $d <= $end; $d++) {
        // // // foreach (explode(',', $data) as $d) {
        // //     $curl = curl_init();

        // //     curl_setopt_array($curl, array(
        // //       CURLOPT_URL => 'https://myaccount.du.ae/servlet/ContentServer?pagename=MA_QuickPayRedirect&d=front&MSISDN='.$d.'&rechargeType=7&requestType=customerInfo&msisdnSource='.$d,
        // //       CURLOPT_RETURNTRANSFER => true,
        // //       CURLOPT_ENCODING => '',
        // //       CURLOPT_MAXREDIRS => 10,
        // //       CURLOPT_TIMEOUT => 0,
        // //       CURLOPT_FOLLOWLOCATION => true,
        // //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // //       CURLOPT_CUSTOMREQUEST => 'POST',
        // //       CURLOPT_HTTPHEADER => array(
        // //         'Cookie: JSESSIONID="ENCAAAAAAXw+17ntYcaVfKUEnDkZnSLafaRTMNbNGVVuq4M1L6ZwfQLmhdGBj1iztYlVbBmdKUZwytPw6dWdKqC1NOM5zCQKOhjzCpW9mJl4ZtxWsrkpnc3bJkAXrzNOGqWkYEcp6AYVj45n6777eNBWlFXoHbO"; NSC_TFMGDBSF_TTM_443="ENCAAAAAAXp/fP8xKGonvjBYM11MVPwUVIRK3Qw+7Q1v2TWaWVKgeXFwitqXxC9VEbS/75HCeemX9GTmJmM0UJcVq5Mq6vBfclFdtDGFzDvVFuIqxhXIs6E/bjmjD9U9xcLmEaDYj+KkA8tzQY+/e50fsmPyxcQ"'
        // //       ),
        // //     ));

        // //     $response = curl_exec($curl);
        // //     curl_close($curl);
        // //     $c[]['number'] = $d;
        // //     $b[] = json_decode($response, true); //here the json string is decoded and returned as associative array
        // //     // return $b[][1];
        // //     $array = array_merge($b, $c);

        // //     // $my =  $b[0];
        // //     // $object = json_decode($response);
        // //     // $object->role = 'Admin';
        // //     // $b = json_encode($response);

        // //     // $fl = $b['code'];
        // //     // if($fl != '400'){
        // //     // echo $response . '<br>';
        // //     // if($b['PrePaid'] == 'true'){
        // //     //     echo $d . '- PREPAID';
        // //     // }
        // //     // echo $b['customerType'] . '-' . $b['PrePaid']
        // //     // }
        // // }
        // // return $array;
        // // return "DUUDUDUUDUDUDUDU";
        // // $yesterday = date("Y-m-d", strtotime('-1 days'));

        // $data = User::whereIn('email', ['salmanahmedrajput@outlook.com'])->get();
        // foreach($data as $d2){
        // $zp = main_data_user_assigner::where('status','No Answer')
        //         //  $zp = main_data_user_assigner::whereNull('status')
        //         // ->whereDate('updated_at', Carbon::yesterday())
        //         ->whereBetween(
        //             'created_at',
        //             [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        //         )
        //         // ->whereMonth('created_at', Carbon::now()->submonth())
        //         // ->whereBetween(
        //         // 'updated_at',
        //         //     [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
        //         // )

        //     // ->whereMonth('created_at', Carbon::now()->month)
        //     ->OrderBy('id','desc')->limit(500)->get();
        //     foreach($zp as $zp2){
        //          $zp3 = main_data_manager_assigner::where('number_id',$zp2->number_id)->OrderBy('id', 'asc')->first();
        //          if($zp3){
        //             $zp3->status = NULL;
        //             $zp3->save();
        //          }
        //         //
        //         $zp2 = main_data_user_assigner::where('id',$zp2->id)->first();
        //         if($zp2){
        //             $zp2->delete();
        //         }

        //     }
        //     // $zp->delete();
        // }
        // return "Zoom";

        // $duplicates = \DB::table('main_data_user_assigners')
        //     ->select('id','status', 'number_id', \DB::raw('COUNT(*) as `count`'))
        //     ->groupBy('number_id')
        //     ->havingRaw('COUNT(*) > 1')
        //     ->get();
        // foreach($duplicates as $dd){
        //     $dz = main_data_user_assigner::whereNull('status')->where('number_id',$dd->number_id)->first();
        //     if($dz){
        //         $dz->delete();
        //     }
        // }

        // return "kuch nahi hga mat kr try";
        // // $data = main_data_user_assigner::all();
        // // $data = main_data_user_assigner::select('name',)
        // // foreach($data as $d){
        //     // $z = main_data_user_assigner::whereNull('status')->where('id',$data->id)->first();
        // // }
    }
    //
    //
    public function SendForApproval(Request $request){
        // return $request;
        $number = $request->fiveg_number;
        $cmnumber = $request->customer_number;
        $account_code = $request->account_id;

        $emirate_expiry = \Carbon\Carbon::parse($request->emirate_expiry)->format('d-m-Y');
        $expiry = \Carbon\Carbon::parse($request->expiry)->format('d-m-Y');
        $expirycp = \Carbon\Carbon::parse($request->expiry)->format('d-m-Y');
        $date = Carbon::createFromFormat('d-m-Y', $expirycp);

        $created = $date->subYear(); // Subtracts 1 day
        $created = \Carbon\Carbon::parse($created)->format('d-m-Y');

        // $expiry = ]Carbon\Carbon::createFromFormat('Y-m-d', $request->date)->format('d-m-Y');


        $lead = [
            'customer_name' => $request->customer_name,
            'nationality' => $request->nationality,
            'customer_number' => $cmnumber,
            'lead_type' => 'Refferal',
            'title' => 'Request for Approval // HW to Fiber // ' . $number,
            'lead_date' => \Carbon\Carbon::today(),
            'submission_type' => 'Upgrade',
            'hw_type' => '5G Plus',
            'hw_number' => $number,
            'hw_account_number' => $account_code,
            'plan_details' => 'Du Home Starter 409 without contract and 50% discount, 250 mbps speed , landline 2000 mins',
            'pilot' => 'Refferal',
            'pilot_offer' => 'Refferal',
            'gis_project' => $request->project_type,
            'giad' => $request->giad,
            'eid_number' => $request->emirate_id,
            'eid_expiry' => $emirate_expiry,
            'email' => 'salmanahmedrajput@outlook.com',
            'full_address' => $request->unit . ' ' . $request->address,
            'hw_active_date' => $created,
            'hw_expiry' => $expiry
        ];
        \Mail::send(
            'email.approval-table',
            compact('lead'),
            function ($message) use ($lead) {
                $message->to('parhakooo@gmail.com', 'Parhakooo')
                ->cc(['sales@vocus.ae'])
                ->subject($lead['title']);
                $message->from('sales@vocus.ae', 'Vocus Sales');
            }
        );

        // $client = new \Predis\Client('tcp://40.71.59.120:6379');
        // //$client = new Predis\Client();
        // $client->set('foo', 'bar');
        // $value = $client->get('foo');
        // return $value;
        // exit;

        // return "Chala ja BSDK";
        // $ManagerID = User::select('id')->whereIn('users.role', ['FloorManager'])
        // ->where('agent_code', 'CC3')
        // // ->where('email','')
        // ->first();
        // $checker  = main_data_manager_assigner::select('main_data_manager_assigners.number_id', 'main_data_user_assigners.status', 'main_data_manager_assigners.id')
        // ->Join(
        //     'main_data_user_assigners',
        //     'main_data_user_assigners.number_id',
        //     'main_data_manager_assigners.number_id'
        // )
        // ->Join(
        //     'users','users.id','main_data_user_assigners.user_id'
        // )
        // ->whereNull('main_data_user_assigners.status')
        // // ->where('users.agent_code', 'CL1')
        // // ->whereIn('users.email', ['abdulwasay@cl1.com','zunaif@cl1.com', 'umair-saleem@cl1.com','sumera@cl1.com','asad@cl1.com','asadbaig@cl1.com','saad-ahmed@cl1.com', 'saraateeq@cl1.com', 'Farajahmed@CL1.com'])
        // ->whereIn('users.email', ['ammar@cl1.com'])
        // ->get();
        // // $checker = main_data_manager_assigner::where('manager_id',$ManagerID->id)->whereNull('main_data_manager_assigners.status')->limit(1000)->get();
        // foreach ($checker as $k) {
        //     // $kk = WhatsAppMnpBank::where('id',$k->number_id)->first();
        //     $kkk = main_data_manager_assigner::where('id', $k->id)->first();
        //     // if($kk){
        //     //     $kk->is_status = 0;
        //     //     $kk->save();
        //     //     // $kk->delete();
        //     //     // $kk->is_status = NULL;
        //     // }
        //     if ($kkk) {
        //         $kkk->status = 3;
        //         $kkk->save();
        //     }
        //     $zk = main_data_user_assigner::where('number_id', $k->number_id)->whereNull('main_data_user_assigners.status')->first();
        //     if ($zk) {
        //         $zk->delete();
        //     }
        // }
        // return "Abdullah -  Reset";

        //         ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes


        //         // <?php
        //         $data = 971581000000;
        //         $numberstart = MissionDU::orderBy('id', 'desc')->first();
        //         if (!$numberstart) {
        //             $numberstart = 971581000000;
        //         } else {
        //             $numberstart = $numberstart->last_num;
        //         }

        //         $end = $numberstart + 30;

        //         // $data = '971581000199,971581000200,971581000201,971581000202,971581000203,971581000204,971581000205,971581000206,971581000207,971581000208,971581000209,971581000210,971581000211,971581000212,971581000213,971581000214,971581000215,971581000216,971581000217,971581000218,971581000219,971581000220,971581000221,971581000222,971581000223,971581000224,971581000225,971581000226,971581000227,971581000228,971581000229,971581000230,971581000231,971581000232,971581000233,971581000234,971581000235,971581000236,971581000237,971581000238,971581000239,971581000240,971581000241,971581000242,971581000243,971581000244,971581000245,971581000246,971581000247';
        //         // $data = '971581000199,971581000200,971581000201,971581000202';

        // for ($d = $numberstart; $d <= $end; $d++) {
        // // foreach (explode(',', $data) as $d) {
        //     $curl = curl_init();

        //     curl_setopt_array($curl, array(
        //       CURLOPT_URL => 'https://myaccount.du.ae/servlet/ContentServer?pagename=MA_QuickPayRedirect&d=front&MSISDN='.$d.'&rechargeType=7&requestType=customerInfo&msisdnSource='.$d,
        //       CURLOPT_RETURNTRANSFER => true,
        //       CURLOPT_ENCODING => '',
        //       CURLOPT_MAXREDIRS => 10,
        //       CURLOPT_TIMEOUT => 0,
        //       CURLOPT_FOLLOWLOCATION => true,
        //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //       CURLOPT_CUSTOMREQUEST => 'POST',
        //       CURLOPT_HTTPHEADER => array(
        //         'Cookie: JSESSIONID="ENCAAAAAAXw+17ntYcaVfKUEnDkZnSLafaRTMNbNGVVuq4M1L6ZwfQLmhdGBj1iztYlVbBmdKUZwytPw6dWdKqC1NOM5zCQKOhjzCpW9mJl4ZtxWsrkpnc3bJkAXrzNOGqWkYEcp6AYVj45n6777eNBWlFXoHbO"; NSC_TFMGDBSF_TTM_443="ENCAAAAAAXp/fP8xKGonvjBYM11MVPwUVIRK3Qw+7Q1v2TWaWVKgeXFwitqXxC9VEbS/75HCeemX9GTmJmM0UJcVq5Mq6vBfclFdtDGFzDvVFuIqxhXIs6E/bjmjD9U9xcLmEaDYj+KkA8tzQY+/e50fsmPyxcQ"'
        //       ),
        //     ));

        //     $response = curl_exec($curl);
        //     curl_close($curl);
        //     $c[]['number'] = $d;
        //     $b[] = json_decode($response, true); //here the json string is decoded and returned as associative array
        //     // return $b[][1];
        //     $array = array_merge($b, $c);

        //     // $my =  $b[0];
        //     // $object = json_decode($response);
        //     // $object->role = 'Admin';
        //     // $b = json_encode($response);

        //     // $fl = $b['code'];
        //     // if($fl != '400'){
        //     // echo $response . '<br>';
        //     // if($b['PrePaid'] == 'true'){
        //     //     echo $d . '- PREPAID';
        //     // }
        //     // echo $b['customerType'] . '-' . $b['PrePaid']
        //     // }
        // }
        // return $array;
        // return "DUUDUDUUDUDUDUDU";
        // $yesterday = date("Y-m-d", strtotime('-1 days'));

        $data = User::whereIn('email', ['salmanahmedrajput@outlook.com'])->get();
        foreach($data as $d2){
        $zp = main_data_user_assigner::where('status','No Answer')
                //  $zp = main_data_user_assigner::whereNull('status')
                // ->whereDate('updated_at', Carbon::yesterday())
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                )
                // ->whereMonth('created_at', Carbon::now()->submonth())
                // ->whereBetween(
                // 'updated_at',
                //     [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
                // )

            // ->whereMonth('created_at', Carbon::now()->month)
            ->OrderBy('id','desc')->limit(500)->get();
            foreach($zp as $zp2){
                 $zp3 = main_data_manager_assigner::where('number_id',$zp2->number_id)->OrderBy('id', 'asc')->first();
                 if($zp3){
                    $zp3->status = NULL;
                    $zp3->save();
                 }
                //
                $zp2 = main_data_user_assigner::where('id',$zp2->id)->first();
                if($zp2){
                    $zp2->delete();
                }

            }
            // $zp->delete();
        }
        return "Zoom";

        $duplicates = \DB::table('main_data_user_assigners')
            ->select('id','status', 'number_id', \DB::raw('COUNT(*) as `count`'))
            ->groupBy('number_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();
        foreach($duplicates as $dd){
            $dz = main_data_user_assigner::whereNull('status')->where('number_id',$dd->number_id)->first();
            if($dz){
                $dz->delete();
            }
        }

        return "kuch nahi hga mat kr try";
        // $data = main_data_user_assigner::all();
        // $data = main_data_user_assigner::select('name',)
        // foreach($data as $d){
            // $z = main_data_user_assigner::whereNull('status')->where('id',$data->id)->first();
        // }
    }
    //
    public function TestWhatsApp(Request $request){
    {
            $token = env('FACEBOOK_TOKEN');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/100519382920865/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": "923121337222",
                "type": "interactive",
                "interactive":{
                "type": "button",
                "header": {
                    "type": "text",
                    "text": "HOME WIFI PLUS PROMO"
                },
                "body": {
                    "text": "*Home Wireless Plus* \nActual Price Aed ~399~ \nPROMO OFFER AED 199 + VAT Per Month \n12 MONTHS CONTRACT \nUNLIMITED 5G Data \nWith 5G ROUTER"
                },
                "footer": {
                    "text": "AUTHORIZED DU CHANNEL PARTNER VOCUS DEMO"
                },
                "action": {
                    "buttons": [
                        {
                        "type": "reply",
                        "reply": {
                            "id": "un1",
                            "title": "Interested"
                        }
                        },
                        {
                        "type": "reply",
                        "reply": {
                            "id": "un2",
                            "title": "Not Interested"
                        }
                        }
                    ]
                    }
                }
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
    }
    }
    //
    public function ExportQuality(Request $request){
        if (ob_get_contents()) ob_end_clean();


        return Excel::download(new QualityExport, 'QualityExport.xlsx');
    }
    //
    public function FNEExport(Request $request){
        $currentTime = Carbon::now();
    //    $currentTime->addDays(2);

        // return $data = lead_sale::whereDate('appointment_date', $currentTime->addDays(1))->get();

        if (ob_get_contents()) ob_end_clean();


        return Excel::download(new FneReminder, 'FNEExport.xlsx');
    }
    //
    public function Iframe(Request $request){
        // return "Iframe";
        // echo $recaptchaToken = isset($_GET['g-recaptcha-response']) ? $_GET['g-recaptcha-response'] : '';

        return view('email.iframe');
    }
    public function process(Request $request){

         $recaptchaToken = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
        $User = isset($_POST['user']) ? $_POST['user'] : '';

        $curl = curl_init();
        if ($curl === false) {
            throw new Exception('failed to initialize');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://myaccount.du.ae/servlet/myaccount/en/mya-qpRedirect.html?g-recaptcha-response=' . $recaptchaToken,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('MSISDN' => $User, 'rechargeType' => '7', 'requestType' => 'customerInfo', 'msisdnSource' => $User, '_authkey_' => 'B01003ED2C208DC104CC03D9A11B14F774C758AF1B9CCA09C7E4F852D602944C03962739EBC5CEC82CF1746857F9E8A4'),
            CURLOPT_HTTPHEADER => array(
                'ADRUM: isAjax:true',
                'Accept: application/json, text/plain, */*',
                'Accept-Language: en-US,en;q=0.9',
                'Connection: keep-alive',
                'Cookie: JSESSIONID="ENCAAAAAAXSH2A7jl+ft3z9mqxoi+cEnHuMoIYEDQOS7OTbBR3X2gqGduyLzX6kL+sMV3FRKYhQckyjSy+3ZfzjqUcQeuzZxs394jqU/mG/zfdUxMeQTbJr1o8Lszhliw8rkJPsOXzq9KAfvAmX5jv+2Rf4YiDB"; _gcl_au=1.1.540678625.1708697244; _ga=GA1.2.1594703308.1708697244; _gid=GA1.2.994976385.1708697244; _dc_gtm_UA-407073-6=1; _scid=32481e82-137e-4ec6-89f7-5613a8341150; retargetting-gmo=3fad7306-1068-4f12-ae3f-386476dc7181; _fbp=fb.1.1708697245760.294739889; _sctr=1%7C1708628400000; _tt_enable_cookie=1; _ttp=0ki-EWPoDn4TO3rQJGwH5aSqdOr; QuantumMetricSessionID=f821b48a7120e5c7bdbeb697c54b506d; QuantumMetricUserID=ef266585725d3d3c04d3887c9d05c776; _scid_r=32481e82-137e-4ec6-89f7-5613a8341150; _uetsid=de86e900d25411ee832cdfbb4d23b12e; _uetvid=de872880d25411ee9a6e893cfc82c862; ADRUM_BTa="ENCAAAAAAXYoChMwi5HUslN3TdQAMPbLg6acV9ZBMMP9tM6ib2s9JAJUEtFlX5N8hmhLwneg06TGaWSrPJnuSEC+rlal4kS7BWO/xxS6gxmiwicU49hoWb3olR+M8hokUivrem0p0adV6C29VASvQCPhtXxhLLgWc92e5XjiXM/DSD3S6pn1Hctk0ak2Pn4WV+g4+hRDwo="; SameSite="ENCAAAAAAWPYt6/HzZabk6dTgfNGUoxx1Lb5UF5SX/Q3MDshup7uFPfW+1WueDv2zqf4R6wbmw="; ADRUM_BT1="ENCAAAAAAWlRBQ2QVcIHA0jjUQxoOwXpFqL4BoStRaS1Rdxb9sHTiB3/QIpj/cGjKujU8BAAJzy5YZcYZVLGRYr7ywDmcZx"; NSC_TFMGDBSF_TTM_443="ENCAAAAAAWmGRg9/0YaBIUfvgJKwMoYcQ5njprTjaCGw1ZcBPG9/itJqb/zXrmZvJl54Zq4QuSmy/FrCj3DdC99orWHnkxfmqoJpdNfL/wB3BcsLNChLVSEjpxiebmYb5vbgHDRjsTI/a52oGiZ6CVrqBB53z90"; _gat_UA-407073-6=1; NSC_TFMGDBSF_TTM_443="ENCAAAAAAVZU73z6Ori6Wrw0id0Cew7ChMzdyU0ipy7m9pw0qkw/SnHfBGEEf0GCrS4/0PYxmRSG7ewlyNtyaCn3WM0rS0FFOUBnX7v7ixnOq0dOFdbOUq50EM3sP9ckMenwrV6X0VAI6veTk6ngmIwoyqaHgcn"',
                'Origin: https://myaccount.du.ae',
                'Referer: https://myaccount.du.ae/webapp/en/quick-pay',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: same-origin',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Google Chrome";v="122"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "macOS"'
            ),
        ));


        $response = curl_exec($curl);

        curl_close($curl);
        $content = $response;

        if ($content === false) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }

        // Check HTTP return code, too; might be something else than 200
        echo $httpReturnCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // echo $response;
        var_dump($response);

        // echo $recaptchaToken = isset($_GET['g-recaptcha-response']) ? $_GET['g-recaptcha-response'] : '';
        // return
        // $client = new Client();
        // $headers = [
        //     'Cookie' => '1P_JAR=2024-02-23-08; AEC=Ae3NU9MGlPKnzClaCxmrJdQTkxU3NvWHZrwo8s1NmRJ1K9-aEHhUUTAdog; NID=511=Dui2KKud9vNbl7CiTsI_u9xpK3SrYtIN2HPoWwrP8qhLGj4cdYVbYCg32TiW-YVPHS-h5zqpDoS_ikpdxXOAdswvqVR4PkeILCmSraq_B4nfLJDAnXA8OkJAAB-kjRhf_JGqIIfzgzm2shAUXfSZx38wgrBJ2TS2bjgdcBHaFPw'
        // ];
        // $request = new Request('GET', 'https://www.google.com', $headers);
        // $res = $client->sendAsync($request)->wait();
        // echo $res->getBody();


    }
}
