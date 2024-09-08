<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\AttendanceAi;
use App\Models\EtisalatDataGame;
use App\Models\face_group_ai;
use App\Models\User;
use App\Models\UserFaceAi;
use Carbon\Carbon;

class ApiController extends Controller
{
    //
    public function AssignNumberToMe(Request $request){
        // return
        return $data = EtisalatDataGame::where('status',0)->get();
    }
    //

    public function process(Request $request)
    {

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
            CURLOPT_POSTFIELDS => array('MSISDN' => $User, 'rechargeType' => '7', 'requestType' => 'customerInfo', 'msisdnSource' => $User,
            '_authkey_' => '1557C95577BBE64422AA9775BBBD074CC770C542478F8B2AED214394440EF1CCBFD9CEDD24F5344DD41A93834D259829'),
            CURLOPT_HTTPHEADER => array(
                'ADRUM: isAjax:true',
                'Accept: application/json, text/plain, */*',
                'Accept-Language: en-US,en;q=0.9',
                'Connection: keep-alive',
                'Cookie: JSESSIONID="ENCAAAAAAXmILhr0Kxpc7gz1J+FTtf5ipPum7wxbp5x2MmIXI8CBv/DNUBEubcCtVuB77aAirA53RFX6JEkspIAufazT3KO7xRtP9usawdwZv2wl++RxKZB6uPcpNjiCtm7uqBPsIgwfKE+tFz8kk7rvMxbCwyN"; _gcl_au=1.1.540678625.1708697244; _ga=GA1.2.1594703308.1708697244; _gid=GA1.2.994976385.1708697244; _scid=32481e82-137e-4ec6-89f7-5613a8341150; retargetting-gmo=3fad7306-1068-4f12-ae3f-386476dc7181; _fbp=fb.1.1708697245760.294739889; _sctr=1%7C1708628400000; _tt_enable_cookie=1; _ttp=0ki-EWPoDn4TO3rQJGwH5aSqdOr; QuantumMetricUserID=ef266585725d3d3c04d3887c9d05c776; QuantumMetricSessionID=6f0a176680e60b3025866c1924098f43; ADRUM_BTa="ENCAAAAAAXYyX/CFZgqNkvAwiiMB2MywGiilZ7fy9aowFILXcgQRHmfuslZ67Ld148yLTEvzZYJ7hB3l2hAyYiZrgbkWdbidog5vrMce0vsI3utvbCfev8dsqgD3rD1hAiZSosX6TiNLHsJjXrmjmv2eKQD8AqRJEEq2NClvmAm8lN4W4oCA+/EfSnzEmRQkZPpq7WeYqo="; SameSite="ENCAAAAAAVQ4gv9mEa10zBX8BhKKRaqqHmmN43og7+S4OJ6FjKsDZQEUJKjUItyU8Ht0O2qGqc="; ADRUM_BT1="ENCAAAAAAW1o+lLCioihHcGW63P0NFb8xTXaEw8r3kwOGgf/6rJJeYbE75xJFFD5fZi/zKJC1UEJu24VikjiCJnPxKzk+Sj"; _dc_gtm_UA-407073-6=1; _scid_r=32481e82-137e-4ec6-89f7-5613a8341150; _uetsid=de86e900d25411ee832cdfbb4d23b12e; _uetvid=de872880d25411ee9a6e893cfc82c862; NSC_TFMGDBSF_TTM_443="ENCAAAAAAWfh6ScZJzAg9XH+YV5Tov8fEBvsSlzGS2pTuu81BQbqiATqONd1BchWdLul/geNVwFIsYplDOG7dumKBKXi/F2ZCMIHkzmlH8cP7BE5DpmbZ8GcGEKoLcYB7PJSGK5HPyshSSiTHUlb15QFcbvMaMi"; _gat_UA-407073-6=1',
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
    //
    // public function WhatsApiHint(Request $request)
    // {
    //     // return $request;
    //     $status = $request->status;
    //     $number = $request->number;
    //     //
    //     // $number = preg_replace('/@s.whatsapp.net/', '', $number);
    //     //
    //     $dt = WhatsAppScan::where('id', trim($number))->where('is_whatsapp', 0)->update(['is_whatsapp' => $status]);
    //     // if($dt){
    //     //     $dt->is_whatsapp = $status;
    //     //     $dt->save();
    //     // }
    //     // return "Done";
    // }

    public function clearall(Request $request)
    {
        // return "ok";
        $user = request()->user();
        if($user){
            $user->tokens()->delete();
        }
        return "OK";
        // // return $user->id;
    }
    //
    public function CheckAuth(Request $request)
    {
        if ($request->email == 'salmanahmedrajput@outlook.com') {
            return 1 . "," . 10000 . "," . 10000;
        } else {
            return "0" . ",";
        }
    }

    //
    public function requestToken(Request $request)
    {
        //    $validator = $request->validate([
        $validator = Validator::make($request->all(), [ // <---
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            // here we return all the errors message
            // return response()->json(['errors' => $validator->errors()], 422);
            return [
                    'ResponseCode' => '0',
                    'ResponseMessage' => 'error',
                    'ResponseData' => $validator->errors(),
                ];
        }

        // $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
        // if (!$user) {
        //     return [
        //         'ResponseCode' => '0',
        //         'ResponseMessage' => 'error',
        //         'ResponseData' => array(
        //             'error' => array(
        //                 'message' => 'User Not Verified Yet',
        //             )
        //         ),
        //     ];
        // }
        $user = User::where('email', $request->email)->whereNull('deleted_at')->first();
        if (!$user) {
            return [
                'ResponseCode' => '0',
                'ResponseMessage' => 'error',
                'ResponseData' => array(
                    'error' => array(
                        'message' => 'User not Exist',
                    )
                ),
            ];
        }
        // return "Password Issue";
        if (!$user || !Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'email' => ['The provided credentials are incorrect.'],
            // ]);
            // return "SOmething Wrong";
            return [
                'ResponseCode' => '0',
                'ResponseMessage' => 'error',
                'ResponseData' => array(
                    'error' => array(
                        'message' => 'The provided credentials are incorrect.',
                    )
                ),
            ];
        }
        // if ($user && Hash::check($request->password, $user->password)) {
        // 	    // return $user;
        // }else{
        //     'email' => ['The provided credentials are incorrect.'],

        // }
        $sam =  $user->createToken($request->device_name)->plainTextToken;
        // $test_categories = exam_category::where('status', 1)->get();
        if (empty($user->api_profile) || $user->api_profile == 'default.png') {
            $ar = 0;
        } else {
            $ar = 1;
        }
        //
        $today = Carbon::now()->format('Y-m-d'); //yyyy-mm-dd etc
        $timing = \Carbon\Carbon::now();
        // return "za";
        // return $user->id;
        $duplicate = \App\Models\attendance_management::where('userid', $user->id)->whereDate('created_at', Carbon::today())
        ->where('mobile_status', '!=', '0')
        ->Orwhere('mobile_status', '=', '0')
        ->first();
        // $duplicate = \App\Models\attendance_management::where('userid', $user->id)->where('date', $today)->where('mobile_status','!=','0')->first();
        if ($duplicate) {
            $dp = 1;
        } else {
            $dp = 0;
        }
        //
        $details = array(
            // 'user_details' => $user,
            // 'test_categories' => $test_categories,
            'token' => array(
                'token_name' => $sam,
                'attendance_register' => $ar,
                'attendance_done' => $dp,
                'role' => $user->role,


            ),
        );
        // return "Zoom";
        return response()->json(
            [
                'ResponseCode' => '1',
                'ResponseMessage' => 'Thank you for Login',
                'ResponseData' => $details,
                // 'ResponseToken' => $sam,
            ],
            200
        );
    }
    //
    //
    public function aws_pic_ai(Request $request)
    {
        //
        // $customer_id =  $request->user()->id;
        // $data = add_base::create(['value'=>$request->image]);
        // $data = add_base::findorfail(5);



        // return "Zoom";

        // $image_64 = $data->value; //your base64 encoded data
        // $file = base64_decode($image_64);
        // $safeName = str::random(10) . '.' . 'png';
        // $success = file_put_contents(public_path() . '/uploads/' . $safeName, $file);
        // return $success;

        // // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        // // $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        // // // find substring fro replace here eg: data:image/png;base64,

        // // $image = str_replace($replace, '', $image_64);

        // // $image = str_replace(' ', '+', $image);
        // // $img = preg_replace('/^data:image\/\w+;base64,/', '', $image_64);
        // // $type = explode(';', $image_64)[0];
        // // return $type = explode('/', $image_64)[1]; // png or jpg etc
        // $file = base64_decode($image_64);
        // $safeName = str::random(10) . '.' . 'png';



        // $imageName = Str::random(10) . '.' . $safeName;
        // $multi_filePath = 'k' . '/' . $imageName;
        // // \Storage::disk('azure')->put($multi_filePath, $imageName);

        // \Storage::disk('public')->put($multi_filePath, $imageName);
        // return "Zoom ZOom";


        $validator = Validator::make($request->all(), [ // <---
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'image' => 'required',
        ]);
        // return "Z";

        if ($validator->fails()) {
            // here we return all the errors message
            // return response()->json(['errors' => $validator->errors()], 422);
            return [
                'ResponseCode' => '0',
                'ResponseMessage' => 'error',
                'ResponseData' => $validator->errors(),
            ];
        }
        // "pass";
        //
        $curl = curl_init();
        //
        $userID = $request->user();
        //
        $GroupFacePerson = face_group_ai::where('name', 'call_center')->first();
        //
        // Create Person ID
        //
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://eastus.api.cognitive.microsoft.com/face/v1.0/persongroups/' . $GroupFacePerson->personGroupId . '/persons',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "name": "' . $userID->name . '",
                "userData": "' . $userID->id . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Ocp-Apim-Subscription-Key: 94af1a1d691f42369c915aa74b9955e1'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response/;
        // dd($response);
        $json = json_decode($response, true);
        // dd($json);
        // return $json;
        if ($json) {
            $person_id = $json['personId'];
            //
            // if ($file = $request->file('image')) {
            //     //convert image to base64
            //     $image = base64_encode(file_get_contents($request->file('image')));
            //     $image2 = file_get_contents($request->file('image'));
            //     // AzureCodeStart
            //     $originalFileName = time() . $file->getClientOriginalName();
            //     $multi_filePath = 'user_ai' . '/' . $originalFileName;
            //     \Storage::disk('azure')->put($multi_filePath, $image2);
            //     // AzureCodeEnd
            //     //prepare request
            //     $mytime = Carbon::now();
            //     $ext =  $mytime->toDateTimeString();
            //     // $name = $ext . '-' . $file->getClientOriginalName();
            //     $cnic_back = $originalFileName;
            //     // $file->move('user-cnic', $name);
            // }
            if (!empty($request->image)) {
                $image = $request->image;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $originalFileName = str::random(10) . '.png';
                $imageName = 'user_ai' . '/' . $originalFileName;

                Storage::disk('azure')->put($imageName, base64_decode($image));
            } else {
                return [
                    'ResponseCode' => '0',
                    'ResponseMessage' => 'error',
                    'ResponseData' => array(
                        'error' => array(
                            'message' => 'The provided image are incorrect.',
                        )
                    ),
                ];
            }
            // return ""
            // else{
            //     $cnic_back = 'default.png';
            // }
            //
            // Create persistedFaces ID
            //
            $curl = curl_init();
            $final_image_url = 'https://salmanrajzzdiag.blob.core.windows.net/vocus/user_ai/' . $originalFileName;
            // return 'https://eastus.api.cognitive.microsoft.com/face/v1.0//persongroups/' . $GroupFacePerson->personGroupId . '/' . 'persons/' . $person_id . '/persistedFaces';
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://eastus.api.cognitive.microsoft.com/face/v1.0/persongroups/' . $GroupFacePerson->personGroupId . '/' . 'persons/' . $person_id . '/persistedFaces',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "url": "' . $final_image_url . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Ocp-Apim-Subscription-Key: 94af1a1d691f42369c915aa74b9955e1'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response;
            // dd($response);
            // echo $response;
            $json_create_face_person = json_decode($response, true);
            if (isset($json_create_face_person['error'])) {
                // return $json_create_face_person;
                return [
                    'ResponseCode' => '0',
                    'ResponseMessage' => 'error',
                    'ResponseData' => array(
                        'error' => array(
                            'message' => $json_create_face_person['error']['message'],
                        )
                    ),
                ];
            }
            if (!$json_create_face_person) {
                return [
                    'ResponseCode' => '0',
                    'ResponseMessage' => 'error',
                    'ResponseData' => array(
                        'error' => array(
                            'message' => 'Something Wrong Please try again.',
                        )
                    ),
                ];
            }
            $persistedFaceId = $json_create_face_person['persistedFaceId'];

            //

            //
            if ($persistedFaceId) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://eastus.api.cognitive.microsoft.com/face/v1.0/detect',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                        "url": "' . $final_image_url . '"
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Ocp-Apim-Subscription-Key: 94af1a1d691f42369c915aa74b9955e1',
                        'Content-Type: application/json'
                    ),
                ));

                $ResponseFaceID = curl_exec($curl);

                curl_close($curl);
                //
                $FaceID = json_decode($ResponseFaceID, true);
                $FinalFaceID = $FaceID['0']['faceId'];
                // echo $response;
                $details = array(
                    'user_details' => 'Image Approved',
                    'user_url' => 'https://salmanrajzzdiag.blob.core.windows.net/vocus/user_ai/' . $originalFileName,
                    'persistedFaceId' => $persistedFaceId,
                    'FaceID' => $FinalFaceID,
                    'PersonGroupID' => $GroupFacePerson->personGroupId,
                    // 'test_categories' => $test_categories,
                    // 'token' => array(
                    // 'token_name' => $sam,

                    // ),
                );
                //
                //
                $d = UserFaceAi::updateOrCreate(['userid' => $userID->id], [
                    // $d = UserFaceAi::create([
                    'userid' => $userID->id,
                    'UserImageUrl' => $final_image_url,
                    'FaceID' => $FinalFaceID,
                    'persistedFaceId' => $persistedFaceId,
                    'PersonGroupID' => $GroupFacePerson->personGroupId,
                    'person_id' => $person_id,
                ]);
                //
                $details = array(
                    'user_details' => 'Image Approved',
                    'user_url' => 'https://salmanrajzzdiag.blob.core.windows.net/vocus/user_ai/' . $originalFileName,
                    'persistedFaceId' => $persistedFaceId,
                    'FaceID' => $FinalFaceID,
                    'PersonGroupID' => $GroupFacePerson->personGroupId,
                    'final_data' => $d,
                    // 'test_categories' => $test_categories,
                    // 'token' => array(
                    // 'token_name' => $sam,

                    // ),
                );
            }
            //

        } else {
            return response()->json(
                [
                    'ResponseCode' => '1',
                    'ResponseMessage' => 'Something Wrong',
                    // 'ResponseData' => $details,
                    // 'ResponseToken' => $sam,
                ],
                200
            );
        }
        //
        $userID->api_profile = $final_image_url;
        $userID->save();

        return response()->json(
            [
                'ResponseCode' => '1',
                'ResponseMessage' => 'Thank you for Login',
                'ResponseData' => $details,
                // 'ResponseToken' => $sam,
            ],
            200
        );
    }
    //
    public function attendance_log(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [ // <---
            'image' => 'required',
            // 'date_time' => 'required',
            // 'userid' => 'required',
        ]);
        // return "zoom";
        // return $request->userid;
        // $customer_id =  $request->user()->id;


        if ($validator->fails()) {
            // here we return all the errors message
            // return response()->json(['errors' => $validator->errors()], 422);
            return [
                'ResponseCode' => '0',
                'ResponseMessage' => 'error',
                'ResponseData' => $validator->errors(),
            ];
        }
        //
        // $ip = $request->ip();
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {

            $region_name = $_SERVER["HTTP_CF_IPCOUNTRY"];
            $user_country = $_SERVER["HTTP_CF_IPCOUNTRY"];
            $ip = $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            // $details = json_decode(file_get_contents("http://ipinfo.io/{$ipaddress}"));
            $details = $ip;
        } else {
            $ip =   $request->ip();
            $details = $ip;

            // $details = json_decode(file_get_contents("http://ipinfo.io/{$ipaddress}"));
            // $user_country =   $details->country;
            // $region_name =   $details->region;
        }
        $userID = $request->user();
        $userID = User::findorfail($request->userid);
        // return $ip .'-'.$userID->call_center_ip;
        // if($ip != $userID->call_center_ip || $ip != $userID->secondary_ip){
        if($ip != '137.59.220.124' || $ip != '137.59.220.124'){
            return [
                'ResponseCode' => '0',
                'ResponseMessage' => 'error',
                'ResponseData' => array(
                    'error' => array(
                        'message' => 'Attendance only accept on Call Center IP',
                    )
                ),
            ];
        }

        //
        // if ($file = $request->file('image')
        // ) {
        //     //convert image to base64
        //     $image = base64_encode(file_get_contents($request->file('image')));
        //     $image2 = file_get_contents($request->file('image'));
        //     // AzureCodeStart
        //     $originalFileName = time() . $file->getClientOriginalName();
        //     $multi_filePath = 'user_compare' . '/' . $originalFileName;
        //     \Storage::disk('azure')->put($multi_filePath, $image2);
        //     // AzureCodeEnd
        //     //prepare request
        //     $mytime = Carbon::now();
        //     $ext =  $mytime->toDateTimeString();
        //     // $name = $ext . '-' . $file->getClientOriginalName();
        //     $cnic_back = $originalFileName;
        //     // $file->move('user-cnic', $name);
        // }
        //
        if (!empty($request->image)) {
            $image = $request->image;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(
                ' ',
                '+',
                $image
            );
            $originalFileName = str::random(10) . '.png';
            $imageName = 'user_compare' . '/' . $originalFileName;

            Storage::disk('azure')->put($imageName, base64_decode($image));
        } else {
            return [
                'ResponseCode' => '0',
                'ResponseMessage' => 'error',
                'ResponseData' => array(
                    'error' => array(
                        'message' => 'The provided image are incorrect.',
                    )
                ),
            ];
        }
        //
        // return "Zoom Again";
        //
        // $https://salmanrajzzdiag.blob.core.windows.net/vocus/user_ai/lf7ts9kkKo.png
        $final_image_url = 'https://salmanrajzzdiag.blob.core.windows.net/vocus/user_compare/' . $originalFileName;
        //

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://eastus.api.cognitive.microsoft.com/face/v1.0/detect',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "url": "' . $final_image_url . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Ocp-Apim-Subscription-Key: 94af1a1d691f42369c915aa74b9955e1',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true);
        $FaceID = json_decode($response, true);
        if (empty($FaceID) || $FaceID == null) {
            return [
                'ResponseCode' => '0',
                'ResponseMessage' => 'error',
                'ResponseData' => array(
                    'error' => array(
                        'message' => 'something wrong.',
                    )
                ),
            ];
        }
        // else if ($FaceID['error']['code'] == 'InvalidImageSize') {
        //     return [
        //         'ResponseCode' => '0',
        //         'ResponseMessage' => 'error',
        //         'ResponseData' => array(
        //             'error' => array(
        //                 'message' => $FaceID['error']['message'],
        //             )
        //         ),
        //     ];
        // }
        else {
            $FinalFaceID = $FaceID['0']['faceId'];
            // echo $response;
            if ($FinalFaceID) {
                $data = UserFaceAi::where('userid', $userID->id)->first();
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://eastus.api.cognitive.microsoft.com/face/v1.0//verify',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                    "faceId": "' . $FinalFaceID . '",
                    "personGroupId": "' . $data->PersonGroupID . '",
                    "personId": "' . $data->person_id . '"
                }',
                    CURLOPT_HTTPHEADER => array(
                        'Ocp-Apim-Subscription-Key: 94af1a1d691f42369c915aa74b9955e1',
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                //  $response;
                $MyJson = json_decode($response, true);
            }
            //  $MyJson['isIdentical'];
            if ($MyJson['isIdentical'] == false) {
                return [
                    'ResponseCode' => '0',
                    'ResponseMessage' => 'error',
                    'ResponseData' => array(
                        'error' => array(
                            'message' => 'Unable to recognize face, Please try again.',
                        )
                    ),
                ];
            }



            //
            $details = array(
                'user_details' => 'Attendance Success',
                'date_time' => $request->date_time,
                'userid' => $request->userid,
                // 'test_categories' => $test_categories,
                // 'token' => array(
                // 'token_name' => $sam,

            );
            // ),
            $dd = AttendanceAi::create([
                'results' => $response,
            ]);


            $startTime = \Carbon\Carbon::createFromFormat('H:i a', '09:00 AM');
            $endTime = \Carbon\Carbon::createFromFormat('H:i a', '09:30 AM');
            $Second = \Carbon\Carbon::createFromFormat('H:i a', '09:31 AM');
            $SecondEnd = \Carbon\Carbon::createFromFormat('H:i a', '09:00 PM');
            $currentTime = \Carbon\Carbon::now();
            $today = Carbon::now()->format('Y-m-d'); //yyyy-mm-dd etc
            if ($currentTime->between($startTime, $endTime, true)) {
                //    return "Zoom";

                // if ($request->attendance == 'Late') {
                // $timing = $request->timing;
                // } else {

                $timing = \Carbon\Carbon::now();
                // }
                // return $userID;
                // return $timing;
                $duplicate = \App\Models\attendance_management::where('userid', $userID->id)->where('date', $today)->where('mobile_status', '=', '0')->first();
                if (!$duplicate) {
                    $data = \App\Models\attendance_management::create([
                        'status' => 'Present',
                        'mobile_status' => 'Present',
                        'date' => $today,
                        'timing' => $timing,
                        'userid' => $userID->id,
                    ]);
                    //
                    $ntc = User::select('call_centers.notify_email', 'users.secondary_email', 'users.agent_code', 'call_centers.numbers')
                    ->Join(
                        'call_centers',
                        'call_centers.call_center_code',
                        'users.agent_code'
                    )
                    ->where('users.id', $userID->id)->first();
                    //
                    // $number = '923121337222';
                    $number = array('923121337222', $ntc->numbers);
                    $msg_details = [
                        'attendance_date' => $today,
                        'attendance_time' => $timing,
                        'status' => 'Late',
                        'call_center' => $userID->agent_code,
                        'name' => $userID->name,
                        'email' => $userID->email,
                    ];
                    \App\Http\Controllers\FunctionController::SendAttendanceWhatsApp($msg_details, $number);
                    //
                }
                // return "1";
            } else if ($currentTime->between($Second, $SecondEnd, true)) {
                // if ($request->attendance == 'Late') {
                // $timing = $request->timing;
                // } else {
                // return $userID;
                $timing = \Carbon\Carbon::now();
                // }
                // return $timing;
                $duplicate = \App\Models\attendance_management::where('userid', $userID->id)->where('date', $today)->where('mobile_status', '=', '0')->first();
                if (!$duplicate) {
                    $data = \App\Models\attendance_management::create([
                        'status' => 'Late',
                        'mobile_status' => 'Late',
                        'date' => $today,
                        'timing' => $timing,
                        'userid' => $userID->id,
                    ]);
                    //
                    $ntc = User::select('call_centers.notify_email', 'users.secondary_email', 'users.agent_code', 'call_centers.numbers')
                    ->Join(
                        'call_centers',
                        'call_centers.call_center_code',
                        'users.agent_code'
                    )
                    ->where('users.id', $userID->id)->first();
                    //
                    // $number = '923121337222';
                    $number = array('923121337222', $ntc->numbers);
                    $msg_details = [
                        'attendance_date' => $today,
                        'attendance_time' => $timing,
                        'status' => 'Late',
                        'call_center' => $userID->agent_code,
                        'name' => $userID->name,
                        'email' => $userID->email,
                    ];
                    \App\Http\Controllers\FunctionController::SendAttendanceWhatsApp($msg_details, $number);
                    // return "1";
                }
                // return "Already Exist";
                // return "Alright";
                // $number = array('923249660466', '923027520611', '923460854541', '923487602506');
                // ChatController::SendToWhatsAppFunction($details,$number);
            }

            return response()->json(
                [
                    'ResponseCode' => '1',
                    'ResponseMessage' => 'Thank you for Login',
                    'ResponseData' => $response,
                    // 'ResponseToken' => $sam,
                ],
                200
            );
        }
    }
    //
    public function VerifyWebHook(Request $request)
    {
        // $request;
        $mode = $request->hub_mode;
        $challenge = $request->hub_challenge;
        $token = $request->hub_verify_token;
        echo $challenge;
    }
    //
    public function mydata(Request $request)
    {
        // return
        $userID = $request->user();
        // $userID = $request->user();
        $user = User::where('email', $userID->id)->whereNull('deleted_at')->first();
        if (!$user) {
            $userID->tokens()->delete();
        }
        return [
            'ResponseCode' => '1',
            'ResponseMessage' => 'success',
            'ResponseData' => $userID,
            'CnicUrl' => 'https://cdn.riuman.com/callmax/user-cnic/',
        ];
    }
    //

    //
}
