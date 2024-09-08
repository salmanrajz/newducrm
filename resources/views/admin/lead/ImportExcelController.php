<?php

namespace App\Http\Controllers;

use App\Imports\ClawBackImportExcel;
use App\Imports\CourixData;
use App\Imports\GetEmail;
use App\Imports\ImportFNEData;
use App\Imports\ImportWhatsAppNumDU;
use App\Imports\MostImportImportNum;
use App\Imports\Upload4gNumber;
use App\Imports\Upload5gNumber;
use App\Models\ClawBackTable;
use App\Models\fetch_data;
use App\Models\main_data_explorer;
use App\Models\TestNumberEmirti;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Excel;
use Maatwebsite\Excel\Facades\Excel;
use GoogleCloudVision\GoogleCloudVision;
// use GoogleCloudVision\Request\AnnotateImageRequest;
// GoogleCloud
use Google\Cloud\Vision\VisionClient;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



class ImportExcelController extends Controller
{
    //
    public function ImportExcel()
    {
        // return "b";
        return view('dashboard.import');
    }
    //
    //
    public function ImportExcelFNE()
    {
         $tl = \App\Models\User::select('id','name')->where('role', 'TeamLeader')->get();

        // return "b";
        return view('dashboard.importFNE',compact('tl'));
    }
    //
    public function ImportExcel4g()
    {
        // return "b";
        return view('dashboard.import4g');
    }
    //
    //
    public function GetUpdateEmail()
    {
        // return "b";
        return view('dashboard.GetUpdateEmailPost');
    }
    //
    public function GetUpdateEmailPost(Request $request){
        // return
        // return $request;
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new GetEmail, $path);
        // return "SSS";
        return back()->with('success', 'Number Data Imported successfullys.');
    }
    //
    //
    public function OcrForm()
    {
        // return phpinfo();
        // return "b";
        return view('dashboard.OcrForm');
    }
    //
    public function OcrFormSubmit(Request $request){
        // return $request;
                ini_set('memory_limit', '1024M'); // or you could use 1G
                ini_set('upload_max_filesize', '2000M'); //300 seconds = 5 minutes
                ini_set('post_max_size', '2000M'); //300 seconds = 5 minutes
                // ini_set('post_max_size', '2000M'); //300 seconds = 5 minutes
                ini_set('max_file_uploads', '300'); //300 seconds = 5 minutes

        if (!empty($request->front_img)) {

            // return "SOo";
        for($i=1;$i<=471;$i++){
            echo $i . '<br>';
        // foreach ($request->front_img as $key => $val) {
            // return "Salman";
        if ($file = $request->file('front_img')) {
            //convert image to base64
            // return $file;
            // return "Ok";
            // $image = base64_encode(file_get_contents($request->file('front_img')));
            // $image = base64_encode(file_get_contents($request->file('front_img')));
            // $image2 = file_get_contents($request->file('front_img'));
            // AzureCodeStart
            // $originalFileName = time() . $file[$key]->getClientOriginalName();
            // // dd($image2);
            // $multi_filePath = 'documents' . '/' . $originalFileName;
            // // \Storage::disk('azure')->put($multi_filePath,` $image2);
            // // AzureCodeEnd
            // // $name = $originalFileName;
            // $name = $originalFileName;
            // // $file->move('documents', $name);
            // $file[$key]->move('documents', $name);


            $vision = new VisionClient([
                'projectId' => 'potent-plasma-331404',
                'keyFilePath' => 'potent-plasma-331404-38e44d947ff2.json'
            ]);
            $multi_filePath = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/fne-team/file-'.$i.'.png';
            // Annotate an image, detecting faces.
            $image = $vision->image(
                fopen($multi_filePath, 'r'),
                ['text']
            );

            $tadaa = $vision->annotate($image);


            // echo '<pre>';
            // return $tadaa->text();
            // dd($tadaa->text()[0]->description());
            $data =  $tadaa->text()[0]->description();
                    // echo '</pre>';
            // $regexJs = '#\\{ame:\\}(.+)\\{/Nationality\\}#s';
                 // $regexJs = '/Name: ([^.]+)*(\1)/';
            // $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';
            // $str = 'United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLL';
            // if (preg_match('/Name:(.*?)Nationality/', $string, $match) == 1) {
            $string = preg_replace('/\s+/', ' ', $data);
            // return "wild";

             if (preg_match('/eshopCommitment(.*?)Description/', $string, $match) == 1) {
                $plan_name_two =  '###' . $match[1];
            }
            else{
                $plan_name_two = '=>Unable to Fetch Plan Name';
                // echo "Unable to Fetch Plan Name;"
            }
            // return $plan_name_two;
            //  $pnf = explode(' ',$plan_name_two);
            // return $pnf[2];
            if (preg_match('/First Name:(.*?)Contact/', $string, $match) == 1) {
                $name =  $match[1];
            }
            else{
                $name = 'Unable to Fetch Name';
            }
            if (preg_match('/Delivered Date:(.*?)Order/', $string, $match) == 1) {
                $expiry =  $match[1];
            }
            else{
                $expiry = 'Unable to Fetch Name';
            }
            if (preg_match('/First Name:(.*?)Number/', $string, $match) == 1) {
                $name_two =  $match[1];
            }
            else{
                $name_two = 'Unable to Fetch Name';
            }
            if (preg_match('/Order Status:(.*?)Personal/', $string, $match) == 1) {
                $order_status =  $match[1];
            }
            else{
                $order_status = 'Unable to Fetch Name';
            }
            if (preg_match('/Phone Number:(.*?)ID/', $string, $match) == 1) {
                $contact =  $match[1];
            }
            if (preg_match('/Phone Number:(.*?)Expiry/', $string, $match) == 1) {
                $contact_two =  $match[1];
            }else{
                $contact_two =  'Unable to Fetch CC Num';

            }
                    if (isset($contact)) {

            // echo str::length($contact);
            if(str::length($contact) > 14){
                // return "acha";
                if (preg_match('/Phone Number:(.*?)Transaction/', $string, $match) == 1) {
                    $contact =  $match[1];
                }
                else {
                            $contact = 'Unable to Fetch Contact';
                }

            }
            else{
                // return "zoom";
                if (preg_match('/Phone Number:(.*?)ID/', $string, $match) == 1) {
                    $contact =  $match[1];
                } else {
                    $contact = 'Unable to Fetch Contact';
                }
            }
        }else{
            if (preg_match('/Phone Number:(.*?)Amount:/', $string, $match) == 1) {
                $contact =  $match[1];
            } else {
                $contact =  'Unable to Fetch CC Num';
            }
            // $contact = 'Unable to Fetch Contact';
        }
            // dd(str::length($contact));
            // if()
            if (preg_match('/Country:(.*?)Expiry/', $string, $match) == 1) {
                $nationality =  $match[1];
            }
            else{
                        $nationality = 'Unable to Fetch';
            }
            if (preg_match('/Country:(.*?)Contact/', $string, $match) == 1) {
                $nationality_two =  $match[1];
            }
            else{
                        $nationality_two = 'Unable to Fetch';
            }
            // if (preg_match('/Country:(.*?)First/', $string, $match) == 1) {
            //     $nationality =  $match[1];
            // }
            if (preg_match('/Shipping Address:(.*?)Expected/', $string, $match) == 1) {
                $address =  $match[1];
            }
            else{
                $address = 'Unable to fetch Address';
            }
            if (preg_match('/ID Number:(.*?)Type/', $string, $match) == 1) {
                $emirate_id =  $match[1];
            }
            else {
                        $emirate_id = 'Unable to fetch Address';
            }
            if (preg_match('/ID Number:(.*?)Entry/', $string, $match) == 1) {
                $emirate_id_two =  $match[1];
            }
            else {
                        $emirate_id_two = 'Unable to fetch Address';
            }
            // if (preg_match('/Id: Phone Number(.*?)Account/', $string, $match) == 1) {
            //     $five_jee =  $match[1];
            // }
            if (preg_match('/Phone Number (.*?)Passcode/', $string, $match) == 1) {
                $five_jee =  $match[1];
            }
            // return $five_jee;
            // if
            // return str::length($five_jee);
            if (preg_match('/Number Passcode(.*?)ES/', $string, $match) == 1) {
                $five_jee_second =  $match[1];
            }
            else{
                $five_jee_second =  'Unable to Fetch 5g';

            }
            // return $five_jee;
            if(!isset($five_jee)){
                $five_jee = 'Unable to Fetch Data';
            }



            if(str::length($five_jee) > 14){
                if (preg_match('/Phone Number > 0 (.*?)Passcode/', $string, $match) == 1) {
                    $five_jee = $match[1];
                } else {
                    $five_jee = 'Unable to fetch 5g';
                }
            }
            // return $five_jee;
            // else{
            //             if (preg_match('/Transaction Number(.*?)Payment/', $string, $match) == 1) {
            //                 $five_jee =  '###' . $match[1];
            //             } else {
            //                 $five_jee = 'Unable to fetch 5g';
            //             }
            // }
            // }
            // else{
            //                 $five_jee = 'Unable wala scene';
            // }


            if (preg_match('/Account Id:(.*?)Other/', $string, $match) == 1) {
                $account_id =  $match[1];
            }
            else
            {
                        $account_id = 'Unable to fetch Acccount ID';
            }
            if (preg_match('/Account Id:(.*?)Shipping/', $string, $match) == 1) {
                $account_id_second =  $match[1];
            }
            else
            {
                        $account_id_second = 'Unable to fetch Acccount ID';
            }
            if (preg_match('/Identifier(.*?)BS/', $string, $match) == 1) {
                $plan_name =  '###' . $match[1];
            }
            else{
                $plan_name = 'Unable to Fetch Plan Name';
                // echo "Unable to Fetch Plan Name;"
            }

            if (preg_match('/Identifier(.*?)Description/', $string, $match) == 1) {
                $plan_name_plus =  '###' . $match[1];
            }
            else{
                $plan_name_plus = '=>Unable to Fetch Plan Name';
                // echo "Unable to Fetch Plan Name;"
            }
            if (preg_match('/Delivery Date:(.*?)T/', $string, $match) == 1) {
                $delivery_date =  '###' . $match[1];
            }
            else{
                $delivery_date = '=>Unable to Fetch Plan Name';
                // echo "Unable to Fetch Plan Name;"
            }
            if (preg_match('/Expiry Date:(.*?)T/', $string, $match) == 1) {
                        $expiry_date =  '###' . $match[1];
            }
            else{
                        $expiry_date = '=>Unable to Fetch Plan Name';
                // echo "Unable to Fetch Plan Name;"
            }
                    //
                    // $names = array(
                    // 'Dragana Jovanovic Contact Email: Jdragana20@gmail. Phone'
                    // );
                    // // foreach ($names as $name) {
                    //     $name_valid = preg_match("/^(?!.*['-]{2})[a-zA-Z][a-zA-Z'\s-]{1,20}$/",
                    //         $name,$match
                    //     );
                    //     return $match;
                    // echo "$name is " . (($name_valid) ? "valid" : "not valid") . "\n";
                    // }


                    // preg_match('/^Tmps(.+)$/', $fieldName, $matches);
                    // $cont = 971;
                    // $regex = "/^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$/";
                    // // if (preg_match($regex, $cont, $match) == 1) {
                    // //     // $five_jee =  $match[1];
                    // //     return $match[1];
                    // // }
                    // // else
                    // // {
                    // //     // return "lol";
                    // // }
                    // // $uaeNumber = "971";
                    // // $regex = "/^9715\d{7}$/";

                    // // if (!preg_match($regex, $uaeNumber)) {
                    // //     echo "The number is a valid UAE phone number.";
                    // // } else {
                    // //     echo "The number is not a valid UAE phone number.";
                    // // }
                    // // $string = '<strong>Apr- May Price: </strong>Adult: $2,999.00 Children: $2,249.00 <br />';
                    // if(preg_match_all($regex, $cont, $match)){
                    //     return $match;
                    // }
                    // $str = '971522221220';
                    //                     $str = '00971551234567
                    // +971551234567
                    // +97141234567
                    // 0551234567
                    // 041234567
                    // ';
                    // return $contact_exp;
                    // return $contact;se

                    // $text = "This is, a text, with commas, that will, be replaced, by new lines.";
                    // $new_text = str_replace(",", "\n", $text);
                    // $fullName = 'Dragana Jovanovic';
                    // // $ms = "/^[a-zA-Z ]*$/";
                    // // $fullName = "John Christopher Smith";
                    // $regex = "/^[\p{L}']+(\s[\p{L}']+)*$/u";

                    // if (preg_match($regex, $fullName)) {
                    //     echo "Matched full name: " . substr($fullName, 0, 15);
                    // } else {
                    //     echo "The input is not a valid full name.";
                    // }



                    // echo $new_text;
                    // $str = '971585596011 Expiry Date: 2026-02-26T20:00:0 Date Of Birth: 1987-04-06T20:00:0 Order Entries | Menu | Edit Entry ID Customer Id: 66544084 DIPID Cancellation Reason: Payment Info';
                    // return $contact_exp;
                    // $re = '/^(?:\+971|971|0)?(?:50|51|52|55|56|58|2|3|4|6|7|9)\d{7}$/m';
                    // $contact_exp = str_replace(' ', "\n <br>",trim($contact_two));
                    // // preg_match_all($re, $contact_exp, $matches, PREG_SET_ORDER, 0);
                    // preg_match($re, $contact_exp, $matches);
                    // // preg_match('/Expiry Date:(.*?)T/', $string, $match)

                    // $contact_one =  $matches[0];
                    // $contact_exp_1 = str_replace(' ', "\n <br>",trim($contact));
                    // preg_match($re, $contact_exp_1, $matches);

                    // // preg_match($re, $contact_exp_1, $matches, PREG_SET_ORDER, 0);
                    // $contact_one_two =  $matches[0];
                    // Print the entire match result
                    // var_dump($matches[0]);




            //

            // echo '<br>';
            // echo '<br>';
            // echo '<br>';
            // echo '<br>';
            // echo '<br>';
            // echo '<br>';
            // echo 'Order Status: => ' . $order_status . '<br>';
            // echo 'Name: => ' . $name . '<br>';
            // echo 'Name Two: => ' . $name_two . '<br>';
            // echo 'Contact: => ' . $contact_one . '<br>';
            // echo 'Contact Two: => ' . $contact_one_two . '<br>';
            // echo 'Nation: => ' . $nationality . '<br>';
            // echo 'Nation: => ' . $nationality_two . '<br>';
            // echo 'Address: => ' . $address . '<br>';
            // echo 'Emirate ID: => ' . $emirate_id . '<br>';
            // echo 'Emirate ID: => ' . $emirate_id_two . '<br>';
            // echo 'Five: => ' . $five_jee . '<br>';
            // echo '5g Second: => ' . $five_jee_second . '<br>';
            // echo 'AccountID: => ' . $account_id . '<br>';
            // echo 'AccountID Second: => ' . $account_id_second . '<br>';
            // echo 'PlanName: => ' . $plan_name . '<br>';
            // echo 'PlanName Two: => ' . $plan_name_two . '<br>';
            // echo 'PlanName Plus: => ' . $plan_name_plus . '<br>';
            // echo 'Delivery Date: => ' . $delivery_date . '<br>';
            // echo 'Expiry Date: => ' . $expiry_date . '<br>';
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<br>';
            // else{
            //     return $data;
            // }
            // if (preg_match('/Nationality(.*?)/', $string, $match) == 1) {
            //     echo 'Nationality: ' . $match[1] . '<br>';
            // }
            // return $mp = str_replace(' ','*',$plan_name_two);
            // $myData = explode('*',$mp);
            // $pfm = $myData[0] . ' ' . $
            // $plan_name_fp = str_replace()
            // return $five_jee;
            fetch_data::create(
                [
                    'data'=>$data,
                    'order_status'=> $order_status,
                    'name'=>$name,
                    'name_two'=>$name_two,
                    'contact'=>$contact,
                    'contact_two'=>$contact_two,
                    'nation'=> $nationality,
                    'nation_two'=> $nationality_two,
                            'address'=> $address,
                            'emirate_id'=> $emirate_id,
                            'emirate_id_two'=> $emirate_id_two,
                            'five_jee'=> $five_jee,
                            'five_jee_second'=> $five_jee_second,
                            'account_id'=> $account_id,
                            'account_id_second'=> $account_id_second,
                            'plan_name_second'=> $plan_name_two,
                            'plan_name'=> $plan_name_plus,
                            'expiry_data'=> $expiry,
                            'expiry'=> $expiry,
                            'data_type' => 'order-ready-7-may',
                ]
            );
            // return $data = fetch_data::all();

        }
    }
    // return "si";
}else{
    return "Something else";
}
}
    //
    public function import(Request $request){
        // return
        // return $request;
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new ImportWhatsAppNumDU, $path);
        // return "SSS";
        return back()->with('success', 'Number Data Imported successfullys.');
    }
    //
    //
    public function importFNE(Request $request){
        // return
        // $data = '02/04/2023';
        // return
        //     $date = Carbon::createFromFormat('d-m-Y', Carbon::parse($data)->format('d-m-Y'));
        // return $request;
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new ImportFNEData, $path);
        // return "SSS";
        return back()->with('success', 'Number Data Imported successfullys.');
    }
    //
    public function import4g(Request $request){
        // return
        // return $request;
        ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
        ini_set('max_file_uploads', '3000'); //300 seconds = 5 minutes
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new Upload4gNumber, $path);
        // return "SSS";
        return back()->with('success', 'Number Data Imported successfullys.');
    }
    //
    //
    public function Import5GData(Request $request){
        // return
        // return $request;
        ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
        ini_set('max_file_uploads', '3000'); //300 seconds = 5 minutes
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new Upload5gNumber, $path);
        // return "SSS";
        return back()->with('success', 'Number Data Imported successfullys.');
    }
    //
    public function MostImport()
    {
        // return "b";
        return view('dashboard.MostImport');
    }
    //
    public function MostImportImport(Request $request){
        // return\
        // return phpinfo();
        ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
        ini_set('max_file_uploads', '3000'); //300 seconds = 5 minutes

        // return $request;
        $this->validate($request, [
            'select_file.*'  => 'required|mimes:xls,xlsx'
        ]);

        foreach ($request->file('select_file') as $f) {
            // return $f;
        // $path = $request->file('select_file')->getRealPath();
        // $path1 = $request->file('select_file')->store('temp');
        $path1 = $f->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new MostImportImportNum, $path);
        }

        return back()->with('success', 'Number Data Imported successfullys.');
    }
    // /
    public function Mygame(Request $request){


        // $number = 971589999999;
        // $zp = substr($number,5);

        ini_set('max_execution_time', '300000'); //300 seconds = 5 minutes

         $duplicates = \DB::table('test_number_emirtis') // replace table by the table name where you want to search for duplicated values
            ->select('id', 'number') // name is the column name with duplicated values
            ->whereIn('number', function ($q) {
                $q->select('number')
                ->from('test_number_emirtis')
                    ->groupBy('number')
                    ->havingRaw('COUNT(*) > 1');
            })
            ->orderBy('number')
            ->orderBy('id') // keep smaller id (older), to keep biggest id (younger) replace with this ->orderBy('id', 'desc')
            ->limit(1000)
            ->get();
            $value = "";

            foreach ($duplicates as $duplicate) {
            if ($duplicate->number === $value) {
                \DB::table('test_number_emirtis')->where('id', $duplicate->id)->delete(); // comment out this line the first time to check what will be deleted and keeped
                echo "$duplicate->number with id $duplicate->id deleted! \n";
            } else
            echo "$duplicate->number with id $duplicate->id keeped \n";
            $value = $duplicate->number;
        }
        return "Mission Complete";

        //

        //
        // ini_set('max_execution_time', '-1'); //300 seconds = 5 minutes
        //
        $numberstart = TestNumberEmirti::orderBy('id', 'desc')->first();
        if (!$numberstart) {
            $numberstart = 1000000;
        } else {
             $numberstart = $numberstart->number;
        }
        if ($numberstart === 9999999 || $numberstart > 9999999) {
            return "Game Over";
        }
        // $end = $numberstart + 5;
        $end = $numberstart + 1000000;
        // for ($v = $numberstart; $v <= '971583999999'; $v++) {
        for ($v = $numberstart; $v <= $end; $v++) {
            // for($i='971581000000';$i<= '971581001000';$i++){
                // return $v;
            //     // echo $i . '</br>';
            //     // $d=
            //         if (!WhatsAppScan::where('wapnumber', '=', $i)->exists()) {
            //             $d = WhatsAppScan::create([
            //                 'wapnumber' => $i,
            //             ]);
            //         }
            // }
            // $regex = “\\b([a-zA-Z0-9])\\1\\1+\\b”;
            // for($i='971581000000';$i<= '971581002000';$i++){
            // \Log::info($v)
            // return $v;
            if (preg_match('/(.)\\1{6}/', $v)) {
                $data[] = [
                    'number' => $v,
                    'count_digit' => 7,
                ];
            } elseif (preg_match('/(.)\\1{5}/', $v)) {
                // echo '###' . $i . '<br> => 5 Times Number';
                $data[] = [
                    'number' => $v,
                    'count_digit' => 6,
                ];
            } elseif (preg_match('/(.)\\1{4}/', $v)) {
                // echo '###' . $i . '<br> => 5 Times Number';
                $data[] = [
                    'number' => $v,
                    'count_digit' => 5,
                ];
            } else if (preg_match('/(.)\\1{3}/', $v)) {
                // echo '###' . $i . '<br> => 4 Times Number';
                $data[] = [
                    'number' => $v,
                    'count_digit' => 4,
                ];
            } else if (preg_match('/(.)\\1{2}/', $v)) {
                // echo '###' . $i . '<br> => 3 Times Number';
                $data[] = [
                    'number' => $v,
                    'count_digit' => 3,
                ];
            } else if (preg_match('/(.)\\1{1}/', $v)) {
                // echo '###' . $i . '<br> => 2 Times Number';
                $data[] = [
                    'number' => $v,
                    'count_digit' => 2,
                ];
            }
            // else if (preg_match('/(.)\\1{1}/', $i)) {
            //     // echo '###' . $i . '<br> => 2 Times Number';
            //     if (!WhatsAppScan::where('wapnumber', '=', $i)->exists()) {
            //         $d = WhatsAppScan::create([
            //             'wapnumber' => $i,
            //         ]);
            //     }
            // }
            else {
                // echo $i . ' => <br>' . '=> No 3 Times';
                $data[] = [
                    'number' => $v,
                    'count_digit' => 'random',
                ];
            }
        }
        // return "soo";
        $chunks = array_chunk($data, 5000);
        foreach ($chunks as $chunk) {
            TestNumberEmirti::query()->insert($chunk);
        }
    }

    public static function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    //
    //
    public function ImportCourix()
    {
        // return "b";
        return view('dashboard.import-courix');
    }
    //
    //
    public function Import5g()
    {
        // return "b";
        return view('dashboard.import-courix');
    }
    //
    public function ImportCourixData(Request $request)
    {
        // return
        // return $request;
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new CourixData, $path);
        // return "SSS";
        return back()->with('success', 'Number Data Imported successfullys.');
    }
    //
    // public function dnc_add_number_agent(Request $request)
    // {
    //     return view('dashboard.dnc-add-number-agent');
    // }
    //
    //
    public function dnc_add_number_agent_follow(Request $request)
    {
        return view('dashboard.dnc-add-follow-agent');
    }
    //
    //
    public function dnc_add_number_agent(Request $request)
    {
        return view('dashboard.dnc-add-number-agent');
    }
    //
    //
    public function submit_dnc_number(Request $request)
    {
        // return $request;
        // $k = number_assigner::findorfail($request->userid);
        // $k->remarks = $request->status;
        // $k->user_id = auth()->user()->id;
        // $k->save();
        // $details = [
        //     'numbers' => '923123500256,923121337222',
        //     'dnc_number' => $request->list,
        // ];
        // $d  = \App\dnd_aashir::create([
        //         // 'system_dnd','vicidial_dnd','yeastar_dnd','old_yeastar_dnd'
        //         'system_dnd' => $request->list,
        //         'vicidial_dnd' => $request->list,
        //         'yeastar_dnd' => $request->list,
        //         'old_yeastar_dnd' => $request->list,
        //     ]);
        $validatedData = Validator::make($request->all(), [
            'list' => 'required|numeric|digits:10',
            'type' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }
        $ddm1 = \App\Models\dnd_aashir::where('system_dnd', $request->list)
        // ->whereNot('saler_id', auth()->user()->id)
        // ->whereNot('status', '1.15')
        ->first();
        if ($ddm1) {
            return redirect()->back()
                ->withErrors(['Already Added', 'Please try again'])
                ->withInput();

            // return response()->json(['error' => ['Documents' => ['Sudhar ja :) pehly hi lead bani hwi h bhai']]], 200);
        }
        $str_to_replace = '088880Z';

        // $input_str = '9715088880Z9714088880Z8088880Z';

        $l =  $output_str = $str_to_replace . substr(
                $request->list,
                2
            );
        $details = [
                'numbers' => '923121337222,9231213500256,923313678032',
                'dnc_number' => $l,
                'type' => $request->type,
                'username'=> auth()->user()->name,
            ];
        $d = \App\Models\dnd_aashir::create(
            [
                'system_dnd' => $request->list,
                'yeastar_dnd' => $l,
                'type' => $request->type,
                'userid' => auth()->user()->id,
                'username' => auth()->user()->name,
            ]
        );
        if ($request->status == 'DNC') {
            \App\Http\Controllers\FunctionController::DNCWhatsApp($details);
        }
        return back()->with('success', 'Add successfully.');
        // return 1;
    }
    //
    public function ClawBackImport()
    {
         $d = ClawBackTable::all();
        // return "b";
        return view('dashboard.ClawBackImport');
    }
    //ClawBackImportMain
    public function ClawBackImportMain(Request $request)
    {
        // return
        // return $request;
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        // $path = storage_path('app') . '/' . $path1;
        // $data = \Excel::import(new UsersImport, $path);

        // $data = Excel::Import(new $path);
        // Excel::import(new NumberImport, $path);
        Excel::import(new ClawBackImportExcel, $path);
        // return "SSS";
        return back()->with('success', 'Number Data Imported successfullys.');
    }
    //
    public function AddData(Request $request){
        // return "o";
        // $users = User::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Claw Back Data"]
        ];
        // $role = Role::all();
        // $tl = User::where('role', 'TeamLeader')->get();

        // $call_center = call_center::where('status', 1)->get();
        return view('admin.clawback.add-data', compact('breadcrumbs'));
    }
    public function ViewClawBack(Request $request){
        // return "o";
        // $users = User::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Claw Back Data"]
        ];
        // $role = Role::all();
        $data = ClawBackTable::all();

        // $call_center = call_center::where('status', 1)->get();
        return view('admin.clawback.view-clawback', compact('breadcrumbs','data'));
    }
    //
    public function AddDataPost(Request $request){
        // return $request;
        ClawBackTable::create([
            'customer_name' => $request->customer_name,
            'alternative_number' => $request->alternative_number,
            'remarks' => $request->remarks,
            'activation_date' => $request->activation_date,
            'mobile_number' => $request->customer_number,
            'lead_source' => $request->lead_source,
            'account_number' => $request->account_number,
            'sim_serial_number' => $request->sim_serial_number,
            'contract_id' => $request->contract_id,
            'status' => $request->status,
            'billing_cycle' => $request->billing_cycle,
            'fbd' => $request->fbd,
            'fbd_bill_date' => $request->fbd_bill_date,
            'fbd_21' => $request->fbd_21,
            'fbd_90' => $request->fbd_90,
            'sbd' => $request->sbd,
            'sbd_bill_date' => $request->sbd_bill_date,
            'sbd_21' => $request->sbd_21,
            'sbd_90' => $request->sbd_90,
            'tbd' => $request->tbd,
            'tbd_bill_date' => $request->tbd_bill_date,
            'tbd_21' => $request->tbd_21,
            'tbd_90' => $request->tbd_90,
            'total_pending' => $request->total_pending,
            'clawback' => $request->clawback,
            'category' => $request->category,
            'plan_name' => $request->plan_name,
            'agent_name' => $request->agent_name,
            'nationality' => $request->nationality,
        ]);
        // return back()->with('success', 'Data Imported');
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    public function UpdateClawBack(Request $request){
        // return $request;
        ClawBackTable::updateOrCreate(
            [
                'id'   => $request->id,
            ],
            [
            'customer_name' => $request->customer_name,
            'alternative_number' => $request->alternative_number,
            'remarks' => $request->remarks,
            'activation_date' => $request->activation_date,
            'mobile_number' => $request->customer_number,
            'lead_source' => $request->lead_source,
            'account_number' => $request->account_number,
            'sim_serial_number' => $request->sim_serial_number,
            'contract_id' => $request->contract_id,
            'status' => $request->status,
            'billing_cycle' => $request->billing_cycle,
            'fbd' => $request->fbd,
            'fbd_bill_date' => $request->fbd_bill_date,
            'fbd_21' => $request->fbd_21,
            'fbd_90' => $request->fbd_90,
            'sbd' => $request->sbd,
            'sbd_bill_date' => $request->sbd_bill_date,
            'sbd_21' => $request->sbd_21,
            'sbd_90' => $request->sbd_90,
            'tbd' => $request->tbd,
            'tbd_bill_date' => $request->tbd_bill_date,
            'tbd_21' => $request->tbd_21,
            'tbd_90' => $request->tbd_90,
            'total_pending' => $request->total_pending,
            'clawback' => $request->clawback,
            'category' => $request->category,
            'plan_name' => $request->plan_name,
            'agent_name' => $request->agent_name,
            'nationality' => $request->nationality,
        ]);
        // return back()->with('success', 'Data Imported');
        return response()->json(['success' => 'Update records, please wait meanwhile we are redirecting you....!!!']);
    }
    //
    public function EditClawBack(Request $request){
        //
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Claw Back Data"]
        ];
        // $role = Role::all();
        $data = ClawBackTable::findorfail($request->id);

        // $call_center = call_center::where('status', 1)->get();
        return view('admin.clawback.edit-clawback', compact('breadcrumbs', 'data'));
    }
    //
    //
    public function ShowClawBack(Request $request){
        //
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Claw Back Data"]
        ];
        // $role = Role::all();
        $data = ClawBackTable::findorfail($request->id);

        // $call_center = call_center::where('status', 1)->get();
        return view('admin.clawback.show-clawback', compact('breadcrumbs', 'data'));
    }
    //
    public function DeleteClawBack(Request $request){
        //
        // $breadcrumbs = [
        //     ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Claw Back Data"]
        // ];
        // // $role = Role::all();
        $data = ClawBackTable::findorfail($request->id);
        $data->delete();
        return redirect()->route('ViewClawBack');
        // return redirect('')

        // // $call_center = call_center::where('status', 1)->get();
        // return view('admin.clawback.edit-clawback', compact('breadcrumbs', 'data'));
    }
    //
    public function BulkClawBackDelete(Request $request){
        // return $request;
        foreach($request->id as $i){
            $data = ClawBackTable::findorfail($i);
            $data->delete();
            // return redirect()->route('ViewClawBack');

        }
    }
    //
    public static function TodayEntry($day){
        // return "ZOME";
        $startOfWeek = Carbon::now()->startOfWeek()->startOfDay();
        $endOfWeek = Carbon::now()->endOfWeek()->endOfDay();

        return ClawBackTable::select('id')
        ->when($day, function ($query) use ($day) {
            if ($day == 'daily') {
                $query->whereDate('created_at', Carbon::today());
                // $query->whereDate('lead_sales.updated_at', Carbon::today());
                // ->whereYear('lead_sales.created_at', Carbon::now()->year)
            }
            elseif ($day == 'Weekly') {
                 $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            elseif ($day == 'Monthly') {
                $query->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
                // $query->whereDate('lead_sales.updated_at', Carbon::today());
                // ->whereYear('lead_sales.created_at', Carbon::now()->year)
            }
            else {
                $query->whereDate('created_at', Carbon::today());
                // $query->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                // return $query->where('users.agent_code', $id);
            }
        })
        // ->whereBetween(
        //     'created_at',
        //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        // )
        ->get()->count();
    }
    //
    public function Calendar(Request $request){
        // return "20";
        // return
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Data Calendar"]
        ];
        $data = main_data_explorer::whereNot('status','suspended')->limit(1000)->get();
        // $type = 'Vocus';
        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.data-calendar', compact('breadcrumbs','data'));
    }
}
