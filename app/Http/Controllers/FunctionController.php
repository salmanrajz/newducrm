<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
// ImageAnn
use AhmadMayahi\Vision\Vision;
use AhmadMayahi\Vision\Config;
use App\Models\fne_data;
use App\Models\lead_sale;
use App\Models\User;
use App\Models\WhatsAppScan;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Illuminate\Support\Facades\Hash;
use Cache;
use Illuminate\Support\Facades\Validator;







class FunctionController extends Controller
{
    public static function MaskMyNum($num){
        // $num = '0501230579';

        return substr($num, 0, 2) // Get the first two digits
            . str_repeat('*', (strlen($num) - 4)) // Apply enough asterisks to cover the middle numbers
            . substr($num, -2); // Get the last two digits
    }
    //
    public static function LeadStatus($num){
        // $num = '0501230579';

        return $da = ucfirst(\App\Models\status_code::where('status_code',$num)->first()->status_name);
    }
    //
    public static function MyIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }

    //
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
    //
    public static function DataEntryCountLog($type,$agentid,$day)
    {
        return $data = \App\Models\data_entry_game::select('id')
            -> when($type, function ($q) use ($type) {
                if ($type == 'All') {
                } else {
                    $q->where('data_entry_games.status',$type);
                }
            })
            -> when($day, function ($q) use ($day) {
                if ($day == 'Daily') {
                    return $q->whereDate('data_entry_games.updated_at', Carbon::today())
                        ->whereYear('data_entry_games.updated_at', Carbon::now()->year);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($day == 'Monthly') {
                    return $q->whereMonth('data_entry_games.updated_at', Carbon::now()->month)
                        ->whereYear('data_entry_games.updated_at', Carbon::now()->year);
                }
            })
            ->where('data_entry_games.cm_status',$agentid)
            ->get()->count();
        // where('$type')
        // $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    //
    public function ChangeAllPassword(Request $request){
        $user = User::whereIn('role',['Sale','TeamLeader'])->whereIn('agent_code',['CL1','CL3'])->get();
        foreach($user as $u){
            $rand = FunctionController::quickRandom(7);
            $password = Hash::make($rand);
            $u = User::where('id',$u->id)->first();
            $u->password = $password;
            $u->sl = $rand;
            $u->save();
        }
    }
    //
    public static function TotalLeadVerifiedDailyBoss($id, $leadtype, $userid)
    {
        // return $id;
        // return "ok";
        return $postpaid_verified = \App\Models\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')

            ->Join(
                'verification_forms',
                'verification_forms.verify_agent',
                '=',
                'users.id'
            )
            ->Join(
                'lead_sales',
                'lead_sales.id',
                '=',
                'verification_forms.lead_id'
            )
            // ->where('verification_forms.status', $id)
            // ->where('lead_sales.lead_type', $leadtype)
            // ->where('lead_sales.channel_type',$channel)
            ->where('users.id', $userid)
            ->whereMonth('verification_forms.created_at', Carbon::now()->month)
            ->whereYear('verification_forms.created_at', Carbon::now()->year)
            // ->get();
            // ->whereDate('verification_forms.created_at', Carbon::today())
            ->count();
    }
    public static function TotalLeadVerifiedDailyBossToday($id, $leadtype, $userid)
    {
        // return "09";
        // return $id;
        return $postpaid_verified = \App\Models\User::select("users.id")
            // $user =  DB::table("subjects")->select('subject_name', 'id')

            ->Join(
                'verification_forms',
                'verification_forms.verify_agent',
                '=',
                'users.id'
            )
            ->Join(
                'lead_sales',
                'lead_sales.id',
                '=',
                'verification_forms.lead_id'
            )
            // ->where('verification_forms.status', $id)
            // ->where('lead_sales.lead_type', $leadtype)
            // ->where('lead_sales.channel_type',$channel)
            ->where('users.id', $userid)
            // ->whereMonth('verification_forms.created_at', Carbon::now()->month)
            // ->whereMonth('verification_forms.created_at', Carbon::now()->submonth(3))
            // ->whereYear('verification_forms.created_at', Carbon::now()->year)
            // ->get();
            ->whereDate('verification_forms.created_at', Carbon::today())
            ->count();
    }
    //
    public static function user_monthly_ach($userid,$month,$year){
        // return $month;
        return $active = lead_sale::select('lead_sales.id')
            ->LeftJoin(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->whereIn('lead_sales.status', ['1.02'])
            // ->where('lead_sales.lead_type', $status)
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $userid)
            ->whereMonth('lead_sales.updated_at', $month)
            ->whereYear('lead_sales.created_at', $year)
            ->get()
            ->count();
    }
    public static function TeamLeaderName($userid){
        // return $month;
         $active = \App\Models\User::where('id', $userid)->first();
         if($active){
             return $active->name;
         }
    }
    //
    public static function user_total_act($userid,$month,$year){
        // return $month;
        return $active = lead_sale::select('lead_sales.id')
            ->LeftJoin(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->whereIn('lead_sales.status', ['1.02'])
            // ->where('lead_sales.lead_type', $status)
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $userid)
            // ->whereMonth('lead_sales.updated_at', $month)
            // ->whereYear('lead_sales.created_at', $year)
            ->get()
            ->count();
    }
    // public function userwise_target(R)
    public static function userwise_target($id, $month,$wise)
    {
        // return $month;
        return $active = lead_sale::select('lead_sales.id')
        ->LeftJoin(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )
            ->whereIn('lead_sales.status', ['1.02'])
            // ->where('lead_sales.lead_type', $status)
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $id)
            ->when($wise, function ($query) use ($wise, $month) {
                if ($wise == 'daily') {
                    $query->whereDate('lead_sales.updated_at', Carbon::today());
                    // ->whereYear('lead_sales.created_at', Carbon::now()->year)
                } else {
                    // $query->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                    $query->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    // return $query->where('users.agent_code', $id);
                }
            })
            ->get()
            ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    //
    public static function userwise_targetBatch($ld,$id, $month,$wise)
    {
        // return $wise;
        // return $ld;
        return $active = lead_sale::select('lead_sales.id')
        ->LeftJoin(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )
            ->whereIn('lead_sales.status', ['1.02'])
            // ->where('lead_sales.lead_type','HomeWifi')
            ->where('lead_sales.lead_type', $ld)
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $id)
            ->when($wise, function ($query) use ($wise, $month) {
            if ($wise == 'daily') {
                $query->whereDate('lead_sales.updated_at', Carbon::today());
                // ->whereYear('lead_sales.created_at', Carbon::now()->year)
            } else {
                $query->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                    ->whereYear('lead_sales.created_at', Carbon::now()->year);
                // return $query->where('users.agent_code', $id);
            }
            })
            // ->whereMonth('lead_sales.updated_at', $month)
            // ->whereYear('lead_sales.created_at', Carbon::now()->year)
            ->get()
            ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    //
    public static function TLVeri($id,$month,$status){
        return $active = lead_sale::select('lead_sales.id')
            ->LeftJoin(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->whereIn('lead_sales.status', ['1.05','1.08','1.11'])
            // ->where('lead_sales.lead_type', $status)
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $id)
            ->whereDate('lead_sales.created_at', Carbon::today())
            // ->whereYear('lead_sales.created_at', Carbon::now()->year)
            ->get()
            ->count();
    }
    //
    public static function inprocesslead($id, $month,$status)
    {
        // return $id;
        return $active = lead_sale::select('lead_sales.id')
        ->LeftJoin(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )
            ->whereIn('lead_sales.status', [$status])
            // ->where('lead_sales.lead_type', $status)
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $id)
            ->whereMonth('lead_sales.updated_at', $month)
            ->whereYear('lead_sales.created_at', Carbon::now()->year)
            ->get()
            ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    //
    public static function cctotal($id, $month,$wise)
    {
        // return $id;
        if(auth()->user()->role == 'TeamLeader'){
            return $active = lead_sale::select('lead_sales.id')
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->whereIn('lead_sales.status', ['1.02'])
                // ->where('lead_sales.lead_type', $status)
                // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
                ->where('users.agent_code', $id)
                ->where('users.teamleader',auth()->user()->id)
                ->when($wise, function ($query) use ($wise, $month) {
                    if ($wise == 'daily') {
                        $query->whereDate('lead_sales.updated_at', Carbon::today());
                        // ->whereYear('lead_sales.created_at', Carbon::now()->year)
                    } else {
                        $query->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $query->where('users.agent_code', $id);
                    }
                })
                // ->whereMonth('lead_sales.updated_at', $month)
                // ->whereYear('lead_sales.created_at', Carbon::now()->year)
                ->get()
                ->count();
        }
        else{
            return $active = lead_sale::select('lead_sales.id')
                ->LeftJoin(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->whereIn('lead_sales.status', ['1.02'])
                // ->where('lead_sales.lead_type', $status)
                // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
                ->where('users.agent_code', $id)
                ->when($wise, function ($query) use ($wise, $month) {
                    if ($wise == 'daily') {
                        $query->whereDate('lead_sales.updated_at', Carbon::today());
                        // ->whereYear('lead_sales.created_at', Carbon::now()->year)
                    } else {
                        $query->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $query->where('users.agent_code', $id);
                    }
                })
                // ->whereMonth('lead_sales.updated_at', $month)
                // ->whereYear('lead_sales.created_at', Carbon::now()->year)
                ->get()
                ->count();
        }

        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    public static function cctotaltl($id, $month,$wise)
    {
        // return $id;
        return $active = lead_sale::select('lead_sales.id')
        ->LeftJoin(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )
            ->whereIn('lead_sales.status', ['1.02'])
            // ->where('lead_sales.lead_type', $status)
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.teamleader', $id)
            ->when($wise, function ($query) use ($wise, $month) {
            if ($wise == 'daily') {
                $query->whereDate('lead_sales.updated_at', Carbon::today());
                // ->whereYear('lead_sales.created_at', Carbon::now()->year)
            } else {
                $query->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                    ->whereYear('lead_sales.created_at', Carbon::now()->year);
                // return $query->where('users.agent_code', $id);
            }
            })
            // ->whereMonth('lead_sales.updated_at', $month)
            // ->whereYear('lead_sales.created_at', Carbon::now()->year)
            ->get()
            ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    //
    public static function DNCWhatsApp($details)
    {
        // return $details;
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        $token = env('FACEBOOK_TOKEN');
        foreach (explode(',', $details['numbers']) as $nm) {

        if(isset($details['type'])){
            $type = $details['type'];
        }else{
            $type = 'Hard DNC';
        }
        if(isset($details['username'])){
            $username = $details['username'];
        }else{
            $username = auth()->user()->name;
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "du_dncr",
                    "language": {
                        "code": "en_US"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "' . $details['dnc_number'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $type . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $username . '"
                                },

                            ]
                        }
                    ]
                }
                }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo$response;
        }

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    // /
    //
    public static function SendWhatsApp($details){
        // Instantiate the WhatsAppCloudApi super class.
        //
        // return $details;
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "lead_update",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['lead_no'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_number'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['sim_type'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['plan'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['remarks_final'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['link'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['status'] . '"
                        }

                    ]
                }
            ]
        }
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        }
        //

    }
    // public static function SendWhatsAppTL($details){
    //     // Instantiate the WhatsAppCloudApi super class.
    //     //
    //     $token = env('FACEBOOK_TOKEN_SECOND');

    //     foreach (explode(',', $details['number']) as $nm) {


    //         //

    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => 'https://graph.facebook.com/v14.0/100519382920865/messages',
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => '',
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => 'POST',
    //             CURLOPT_POSTFIELDS => '{
    //     "messaging_product": "whatsapp",
    //     "to": "' . $nm . '",
    //     "type": "template",
    //     "template": {
    //         "name": "lead_update",
    //         "language": {
    //             "code": "en_US"
    //         },
    //         "components": [
    //             {
    //                 "type": "body",
    //                 "parameters": [
    //                     {
    //                         "type": "text",
    //                         "text": "' . $details['lead_no'] . '"
    //                     },
    //                     {
    //                         "type": "text",
    //                         "text": "' . $details['customer_name'] . '"
    //                     },
    //                     {
    //                         "type": "text",
    //                         "text": "' . $details['customer_number'] . '"
    //                     },
    //                     {
    //                         "type": "text",
    //                         "text": "' . $details['sim_type'] . '"
    //                     },
    //                     {
    //                         "type": "text",
    //                         "text": "' . $details['plan'] . '"
    //                     },
    //                     {
    //                         "type": "text",
    //                         "text": "' . $details['remarks_final'] . '"
    //                     },
    //                     {
    //                         "type": "text",
    //                         "text": "' . $details['link'] . '"
    //                     }

    //                 ]
    //             }
    //         ]
    //     }
    //     }',
    //             CURLOPT_HTTPHEADER => array(
    //                 'Content-Type: application/json',
    //                 'Authorization: Bearer ' . $token
    //             ),
    //         ));

    //         $response = curl_exec($curl);

    //         curl_close($curl);
    //         // echo $response;
    //     }
    //     //

    // }
    //
    //
    public static function SendWhatsAppVerification($details){
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');
        // $details['']
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        // return $details['lead_no'];
        // if($details['agent_code'] == 'CC1'){
        //     $number = '923460854541,923487602506';
        // }
        // elseif($details['agent_code'] == 'CC2'){
        //     $number = '917827250250';
        // }
        // elseif($details['agent_code'] == 'CC4'){
        //     $number = '923102939111,923121337222';
        // }
        // elseif($details['agent_code'] == 'CC5'){
        //     $number = '923333135199,971503658599';
        // }
        // elseif($details['agent_code'] == 'CC6'){
        //     $number = '923058874773,923121337222';
        // }
        // elseif($details['agent_code'] == 'CC7'){
        //     $number = '923453627686,923121337222';
        // }
        // elseif($details['agent_code'] == 'CC8'){
        //     $number = '923352920757,971503658599';
        // }
        // elseif($details['agent_code'] == 'CC9'){
        //     $number = '97143032128';
        //     // $number = '923121337222';
        // }else{
        //     $number = '923121337222';
        // }
        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "new_lead_for_verification",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['lead_no'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_number'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['sim_type'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['plan'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['remarks_final'] . '"
                        }
                    ]
                }
            ]
        }
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        }
        //

    }
    //
    //
    public static function SendActiveWhatsApp($details){
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        // $details['']


        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "active_du",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['lead_no'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_number'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['sim_type'] . '"
                        },
                    ]
                }
            ]
        }
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        }
        //

    }
    //
    //
    public static function SendMNPWhatsApp($details){
        // Instantiate the WhatsAppCloudApi super class.
        //
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';

        $token = env('FACEBOOK_TOKEN');
        // $details['']


        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "mnp_proceed",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['lead_no'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_number'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['sim_type'] . '"
                        },
                    ]
                }
            ]
        }
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        }
        //

    }
    //
    //
    public static function SendWhatsAppDesigner($details){
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');
        // $details['']


        foreach (explode(',', $details['number']) as $nm) {


            //

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
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "notifications_for_designer",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['customer_name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['customer_number'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['emirate_id'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['nationality'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['emirate'] . '"
                        }
                    ]
                }
            ]
        }
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        }
        //

    }
    //
    public function ocr_name_new(Request $request)
    {
        $config = (new Config())
            // Required: path to your google service account.
            ->setCredentials('js/google-vision.json');

            // Optional: defaults to `sys_get_temp_dir()`
            // ->setTempDirPath('/my/tmp');
        // return env('GOOGLE_APPLICATION_CREDENTIALS');

         $response = Vision::init($config)
            ->file('images/emirate-id/emirate-id.jpeg')
            ->imageTextDetection()
            ->plain();


        if ($response) {
            $response->locale; // locale, for example "en"
             $response->text;   // Image text
            // return
            $string = preg_replace('/\s+/', ' ', $response->text) . '<br>';
            $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
            $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
            $regexJs = '#\\{Name:\\}(.+)\\{/المتحدة\\}#s';
            // dd($string);
            // if (preg_match($regexJs, $string, $matches)) {
            //                 // print_r($matches);
            // }
            // $data[]
            $data =array();
            foreach (explode(' ', $string) as $id) {
                preg_match($regex, $id, $matches);
                // echo $id . '<br>';

                // if match, show VALID
                if (count($matches) == 1) {
                    // echo '###'."{$id}";
                    $data['emirate_id'] = $id;
                } else {
                    // echo "{$id} INVALID</br>";
                }
            }
            //
            if (preg_match('/Issuing Date(.*?)تاريخ/', $string, $match) == 1) {
                // echo '###' . $match[1] . '<br>';
                // $data['dates'] = trim($match[1]);
                $dbx = explode(' ', trim($match[1]));
                $data['dob'] = trim($dbx[0]);
                $data['expiry'] = trim($dbx[1]);

            }
            if (preg_match('/Name:(.*?)Date/', $string, $match) == 1) {
                // echo '###' . $match[1] . '<br>';
                $data['name'] = $match[1];

            }
            return $data['name'] . '###' . $data['emirate_id'] . '###' . $data['expiry'] . '###' . $data['dob'];
            //     // echo $string = preg_replace("/[^a-zA-Z\s]/", "", $match[1]);
            //     // $re = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
            //     // $str = '09/08/2026';
            //     // $subst = '';
            //     // echo $string = preg_replace($re, "", $match[1]);
            //     $expiry_date = preg_replace('/[^0-9\s\.\-\/]/', "", $match3[1]);
            //     echo '###' . $replace = str_replace('/4 ', '', $expiry_date);


            //     // $result = preg_replace($re, $subst, $match, 1);

            //     // echo "The result of the substitution is " . $result;
            // } else {
            //     echo "failed";
            // }

        }
        // return $response;
        // try {
        //     $imageAnnotatorClient = new ImageAnnotatorClient();

        //     $image_path = 'https://i3.ytimg.com/vi/oeVPsNBTWqU/hqdefault.jpg';
        //     $imageContent = file_get_contents($image_path);
        //     $response = $imageAnnotatorClient->textDetection($imageContent);
        //     $text = $response->getTextAnnotations();
        //     echo $text[0]->getDescription();

        //     if ($error = $response->getError()) {
        //         print('API Error: ' . $error->getMessage() . PHP_EOL);
        //     }

        //     $imageAnnotatorClient->close();
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }
        // if ($file = $request->file('front_img')) {
        //     //convert image to base64
        //     $image = base64_encode(file_get_contents($request->file('front_img')));
        //     $image2 = file_get_contents($request->file('front_img'));
        //     // AzureCodeStart
        //     $originalFileName = time() . $file->getClientOriginalName();
        //     $multi_filePath = 'documents' . '/' . $originalFileName;
        //     \Storage::disk('azure')->put($multi_filePath, $image2);
        //     // AzureCodeEnd
        //     //prepare request
        //     $mytime = Carbon::now();
        //     $ext =  $mytime->toDateTimeString();
        //     // $name = $ext . '-' . $file->getClientOriginalName();
        //     $name = $originalFileName;
        //     // $file->move('documents', $name);
        //     Session::put('front_image', $name);
        //     //to put the session value

        //     $request = new AnnotateImageRequest();
        //     $request->setImage($image);
        //     $request->setFeature("TEXT_DETECTION");
        //     $gcvRequest = new GoogleCloudVision([$request],  'AIzaSyBMeil9pvJHiW-1nxYU54BKyN9I3xM6aYQ');
        //     //send annotation request
        //     $response = $gcvRequest->annotate();
        //     // dd($response);
        //     $string =  json_encode(["description" => $response->responses[0]->textAnnotations[0]->description]);
        //     // ech
        //     if (!empty($response)) {
        //         $string = $response->responses[0]->textAnnotations[0]->description;
        //         $string = preg_replace('/\s+/', ' ', $string) . '<br>';
        //         $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        //         $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
        //         $regexJs = '#\\{Name:\\}(.+)\\{/المتحدة\\}#s';
        //         // dd($string);
        //         // foreach (explode(' ', $string) as $id) {
        //         //     // echo $id . '<br>';
        //         //     // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
        //         //     // print_r($matches);
        //         //     // }
        //         //     preg_match($regex2, $id, $matches2);

        //         //     // if match, show VALID
        //         //     if (count($matches2) == 1) {
        //         //         echo '###' . $id;
        //         //     } else {
        //         //         echo "{$id} INVALID</br>";
        //         //     }
        //         // }
        //         // // echo $string['description'];
        //         // if (preg_match('/ame:(.*?)ation/', $string, $match) == 1) {
        //         //     echo '###' . $match[1] . '<br>';
        //         // }

        //         // Emirate ID Fetching Succesfully
        //         foreach (explode(' ', $string) as $id) {
        //             // echo $id . '<br>';
        //             preg_match($regex, $id, $matches);

        //             // // if match, show VALID
        //             if (count($matches) == 1) {
        //                 // echo "SSS";
        //                 // echo $matches['0'];
        //                 echo '###' . "{$id}";
        //             }
        //             // else {
        //             // echo "{$string} INVALID</br>";
        //             // }
        //         }
        //         // // Emirate ID Fetching End
        //         // //// ZOOOM
        //         // // Name Fetch Done
        //         if (preg_match('/Name:(.*?)المتحدة/', $string, $match) == 1) {
        //             // echo '###' . $match[1] . '<br>';
        //             echo '###' . $string_name = preg_replace("/[^a-zA-Z\s]/", "", $match[1]);
        //         }
        //         // Name Fetch Done END
        //         // Emirate Expiry Done
        //         if (preg_match('/Expiry(.*?)Signature/', $string, $match3) == 1) {
        //             // echo '###' . $match[1] . '<br>';
        //             // echo $string = preg_replace("/[^a-zA-Z\s]/", "", $match[1]);
        //             // $re = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
        //             // $str = '09/08/2026';
        //             // $subst = '';
        //             // echo $string = preg_replace($re, "", $match[1]);
        //             $expiry_date = preg_replace('/[^0-9\s\.\-\/]/', "", $match3[1]);
        //             echo '###' . $replace = str_replace('/4 ', '', $expiry_date);


        //             // $result = preg_replace($re, $subst, $match, 1);

        //             // echo "The result of the substitution is " . $result;
        //         } else {
        //             echo "failed";
        //         }
        //         // Emirate Expiry  Done END
        //         //// ZOOM END
        //         // foreach (explode(' ', $string) as $id) {
        //         //     // echo $id . '<br>';
        //         //     preg_match($regexJs, $id, $matches);

        //         //     // // if match, show VALID
        //         //     if (count($matches) == 1) {
        //         //         // echo "SSS";
        //         //         // echo $matches['0'];
        //         //         echo '###' . "{$id}";
        //         //     }
        //         //     // else {
        //         //     // echo "{$string} INVALID</br>";
        //         //     // }
        //         // }
        //         echo '###' . "{$name}";
        //     }
        // }
        // return $request;
        // $fileName = time() . '_' . $request->file->getClientOriginalName();
        // if ($file = $request->file('front_img')) {
        //     // $ext = date('d-m-Y-H-i');
        //     $mytime = Carbon::now();
        //     $ext =  $mytime->toDateTimeString();
        //     $name = $ext . '-' . $file->getClientOriginalName();
        //     // $name = Str::slug($name, '-');

        //     // $name1 = $ext . '-' . $file1->getClientOriginalName();
        //     // $name1 = Str::slug($name, '-');

        //     // $name2 = $ext . '-' . $file2->getClientOriginalName();
        //     // $name2 = Str::slug($name, '-');

        //     // $name = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
        //     $file->move('img', $name);
        //     $input['path'] = $name;
        //     $k = (new TesseractOCR('img/'.$name))
        //         // ->digits()
        //         // ->hocr()
        //         // ->quiet()
        //         //
        //         // ->tsv()

        //         // ->pdf()

        //         // ->lang('eng', 'jpn', 'spa')
        //         // ->whitelist(range('A', 'Z'))
        //         // ->whitelist(range(0,9,'-'))
        //         // ->whitelist(range(0,9), '-/@')

        //     ->run();
        //       $string = rtrim($k);
        //      echo $string = preg_replace('/\s+/', ' ', $k);

        //     // echo $l = str_replace(" ","@",$k);
        //     // echo $l['0'];
        //     // echo $k .'<br> ' . 'Sa';
        //     $regex = '/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/';
        //     $regex2 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        //     // const str = 'The first sentence. Some second sentence. Third sentence and the names are John, Jane, Jen. Here is the fourth sentence about other stuff.'

        //     // $regexJs = '/Name: ([^.]+)*(\1)/';
        //     $regexJs = '#\\{Name:\\}(.+)\\{/Nationality\\}#s';
        //     // $str = 'United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLL';
        //     // if (preg_match('/Name:(.*?)Nationality/', $string, $match) == 1) {
        //     if (preg_match('/Name:(.*?)Nation/', $string, $match) == 1) {
        //         echo '###'.$match[1];
        //     }
        //     // if (preg_match('/Nationality(.*?)/', $string, $match) == 1) {
        //     //     echo 'Nationality: ' . $match[1] . '<br>';
        //     // }


        //     foreach (explode(' ', $string) as $id) {
        //         preg_match($regex, $id, $matches);

        //         // if match, show VALID
        //         if (count($matches) == 1) {
        //             echo '###'."{$id}";
        //         } else {
        //             // echo "{$id} INVALID</br>";
        //         }
        //     }
        //     // foreach (explode(' ', $string) as $id) {
        //     //     // echo $id . '<br>';
        //     //     // if (preg_match_all($regex2, $id, $matches, PREG_PATTERN_ORDER)) {
        //     //     // print_r($matches);
        //     //     // }
        //     //     preg_match($regex2, $id, $matches2);

        //     //     // if match, show VALID
        //     //     if (count($matches2) == 1) {
        //     //         echo '###' . $id;
        //     //     } else {
        //     //         // echo "{$id} INVALID</br>";
        //     //     }
        //     // }
        //     // preg_match('#\\{FINDME\\}(.+)\\{/FINDME\\}#s', $out, $matches);
        //     // //
        //     //             if(preg_match($regexJs, $string, $matches)){
        //     //                 print_r($matches);
        //     //             }
        //     // if (preg_match("/Name:\s(.*)\Nationality/", $string, $matches1)) {
        //     //     // echo $matches1[1] . "<br />";
        //     //                     print_r($matches);
        //     // }
        //     // $code = preg_quote($string);
        //     //     $k = "United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLLMuhammad Kashif Saleem Uddin";
        //     // if (preg_match("/Name:\s(.*)\sNationality/",$string,$matches1)) {
        //     //     echo $matches1[1] . "<br />";
        //     //                     print_r($matches1);
        //     //                     echo "1";
        //     // }
        //     // return preg_match('/Name:\s(.*)/', $string);


        //     // $startsAt = strpos($string, "{Name:}") + strlen("{Nationality}");
        //     // $endsAt = strpos($string, "{/Nationality}", $startsAt);
        //     // $result = substr($string, $startsAt, $endsAt - $startsAt);

        //     // names = str.match(regex)[1],
        //     //     array = names.split(/,\s*/)

        //     // console.log(array)
        //     // $pattern = '#(?:\G(?!\A)|Name:(?:\s+F)?)\s*\K[\w.]+#';
        //     // // print_r($matches);
        //     // // $txt = "calculated F 15 513 153135 155 125 156 155";
        //     // $txt = "calculated F 15 16 United Arab Emirates ay ‘ doa‘Lal Ann Resident Identity Card ID Number: / 42 gli a8) 784-1974-6574140-8 Coa) apls URGAS tame aul! Name: Muhammad Kashif Saleem Uddin Nationality: Pakistan ARAELLLLL";
        //     // echo preg_match_all("/(?:\bName\b|\G(?!^))[^:]*:\K./", $txt, $matches);
        //     // print_r($matches);
        //     // foreach(explode('@', $string) as $info)
        //     // {
        //     // // $str = "http://www.youtube.com/ytscreeningroom?v=NRHVzbJVx8I";
        //     // foreach (explode('@', $string) as $id) {
        //     //     // echo $id;
        //     //     // $pattern = '#(?:\G(?!\A)|Name:(?:\s+F)?)\s*\K[\w.]+#';
        //     //     // preg_match($pattern, $id, $matches);
        //     //     // print_r($matches);

        //     // }
        //     //     // $string = "SALMAN";
        //     //     // preg_match("/^[a-zA-Z-'\s]+$/", $value);

        //     //     // $rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
        //     //     // $rexSafety = "/^[^<,\"@/{}()*$%?=>:|;#]*$/i";
        //     //     if (preg_match('#(?:\G(?!\A)|salmanahmed(?:\s+F)?)\s*\K[\w.]+', $id)) {
        //     //         // var_dump('bad name');
        //     //         echo $id . '<br>';
        //     //     } else {
        //     //         // var_dump('ok');
        //     //     }
        //     // }

        //     //
        // }
        // return $fileName = time() . '.' . $request->file->extension();
        // return view('number.vision');
        // echo (new TesseractOCR('mixed-languages.png'))
        // ->lang('eng', 'jpn', 'spa')
        // ->run();
        // echo (new TesseractOCR('img/text.png'))
        // ->lang('eng', 'jpn', 'spa')
        // ->run();
        // $ocr = new TesseractOCR();
        // $ocr->image('img/text.png');
        // $ocr->run();
        // return "s";
        // echo $ocr;
        // return $ocr;
        // return IdentityDocuments::parse($request);
    }
    //
    public static function billing_count($first){
        $dt = Carbon::now();
        $mdt = $dt->format('d');
       $data_hw = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no', 'lead_sales.work_order_num', 'lead_sales.billing_cycle', 'lead_sales.contract_id')
        ->whereIn('lead_sales.lead_type', ['HomeWifi'])
        // ->where('lead_type','HomeWifi')
        ->Join(
            'home_wifi_plans',
            'home_wifi_plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'lead_sales.status'
            )
            ->whereNotNull('lead_sales.contract_id')
            ->whereNotNull('lead_sales.billing_cycle')
            // ->where('lead_sales.contract_id','!=')
            // ->where('billing_cycle',$mdt)
            ->where('lead_sales.status', '1.02')
            ->whereMonth('lead_sales.updated_at', Carbon::now()->submonths($first))
            // ->where('lead_sales.billing_cycle', '<', str_replace('0', '', $mdt))
            ->whereYear('lead_sales.updated_at', Carbon::now()->year)
            ->get()->count();
            $data_postpaid = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name as plan_name', 'lead_sales.lead_no', 'lead_sales.work_order_num', 'lead_sales.billing_cycle', 'lead_sales.contract_id')
                ->whereIn('lead_sales.lead_type', ['New','MNP','P2P'])
        // ->where('lead_type','HomeWifi')
        ->Join(
            'plans',
            'plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'lead_sales.status'
            )
            ->whereNotNull('lead_sales.contract_id')
            ->whereNotNull('lead_sales.billing_cycle')
            // ->where('lead_sales.contract_id','!=')
            // ->where('billing_cycle',$mdt)
            ->where('lead_sales.status', '1.02')
            ->whereMonth('lead_sales.updated_at', Carbon::now()->submonths($first))
            // ->where('lead_sales.billing_cycle', '<', str_replace('0', '', $mdt))
            ->whereYear('lead_sales.updated_at', Carbon::now()->year)
            ->get()->count();
            return $data_postpaid  +$data_hw;

    }
    //
    public static function PendingVerification($status){
        //Verify
        // return $status;
        return $data = lead_sale::select('lead_sales.id')
        ->when($status, function ($q) use ($status) {
            if ($status == 'Verify') {
                return $q->whereIn('lead_sales.status', ['1.02','1.13','1.19','1.08']);
            } else {
                return $q->where('lead_sales.status', $status);
            }
        })
        // ->where('lead_sales.saler_id',auth()->user()->id)
        ->get()->count();
    }
    //
    public static function PendingVerificationActivator($status,$product){
        //Verify
        // return $product;
        return $data = lead_sale::select('lead_sales.id')
        // ->where('lead_sales.lead_type',$product)
        ->when($product, function ($q) use ($product) {
            if ($product == 'Postpaid') {
                return $q->whereIn('lead_sales.lead_type', ['P2P','MNP','New']);
            } else {
                return $q->where('lead_sales.lead_type', $product);
            }
        })
        ->when($status, function ($q) use ($status) {
            if ($status == 'Verify') {
                return $q->whereIn('lead_sales.status', ['1.02','1.13','1.19','1.08']);
            } else {
                return $q->where('lead_sales.status', $status);
            }
        })
        // ->where('lead_sales.saler_id',auth()->user()->id)
        ->get()->count();
    }
    public static function DailyActivationCount($status, $agent_code,$lead_type,$day){
        if ($lead_type == 'HomeWifi5g199') {
            // return "199";
            return $data = lead_sale::select('lead_sales.id')->where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 1)
                ->get()->count();
        } elseif ($lead_type == 'HomeWifi5g') {
            return $data = lead_sale::select('lead_sales.id')->where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 2)
                ->get()->count();
        }
        elseif ($lead_type == 'HomeWifiUpgrade') {
            return $data = lead_sale::select('lead_sales.id')->where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 3)
                ->get()->count();
        }
        elseif ($lead_type == 'DU389') {
            return $data = lead_sale::select('lead_sales.id')->where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 6)
                ->get()->count();
        }
        elseif ($lead_type == 'DU699') {
            return $data = lead_sale::select('lead_sales.id')->where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 5)
                ->get()->count();
        }
        elseif ($lead_type == 'DU409') {
            return $data = lead_sale::select('lead_sales.id')->where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 7)
                ->get()->count();
        }
        else{

        return $data = lead_sale::select('lead_sales.id')->where('lead_sales.status',$status)
        // ->Join(
        //     'activation_forms',
        //     'activation_forms.lead_id','lead_sales.id'
        // )
        ->Join(
            'users','users.id','lead_sales.saler_id'
        )
        ->where('lead_sales.lead_type', $lead_type)
            // ->where('users.agent_code',$agent_code)
            ->when($agent_code, function ($q) use ($agent_code) {
                if ($agent_code == 'All') {
                } else {
                    return $q->where('users.agent_code', $agent_code);
                }
            })
        ->when($day, function ($q) use ($day) {
            if ($day == 'Daily') {
                return $q->whereDate('lead_sales.updated_at', Carbon::today())
                ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                // return $q->where('numberdetails.identity', 'EidSpecial');
            } elseif ($day == 'Monthly') {
                return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                ->whereYear('lead_sales.updated_at', Carbon::now()->year);
            }
        })
        ->get()->count();
        }

    }
    //
    //
    public static function DailyPoint($status, $agent_code, $lead_type, $day)
    {

        $hw = lead_sale::select(
            'home_wifi_plans.revenue_points'
        )
        // ->where('activation_forms.status', $status)
        // ->Join(
        //     'activation_forms',
        //     'activation_forms.lead_id',
        //     'lead_sales.id'
        // )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'home_wifi_plans',
            'home_wifi_plans.id',
                'lead_sales.plans'
            )
            // ->where('plans.revenue')
            ->where('lead_sales.lead_type', 'HomeWifi')
            ->where('lead_sales.status','1.02')
            // ->where('users.agent_code',$agent_code)
            ->when($agent_code, function ($q) use ($agent_code) {
                if ($agent_code == 'All') {
                } else {
                    return $q->where('users.agent_code', $agent_code);
                }
            })
            ->when($day, function ($q) use ($day) {
                if ($day == 'Daily') {
                    return $q->whereDate('lead_sales.created_at', Carbon::today())
                        ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($day == 'Monthly') {
                    return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                        ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                }
            })
            // ->get()->count();
            ->sum('home_wifi_plans.revenue_points');

        $p2p = lead_sale::select(
            'plans.revenue'
        )->where('lead_sales.status', $status)
        // ->Join(
        //     'activation_forms',
        //     'activation_forms.lead_id',
        //     'lead_sales.id'
        // )
        ->Join(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )
        ->Join(
            'plans','plans.id','lead_sales.plans'
        )
        // ->where('plans.revenue')
        ->whereIn('lead_sales.lead_type', ['P2P','New'])
        // ->where('users.agent_code',$agent_code)
        ->when($agent_code, function ($q) use ($agent_code) {
            if ($agent_code == 'All') {
            } else {
                return $q->where('users.agent_code', $agent_code);
            }
        })
            ->when($day, function ($q) use ($day) {
                if ($day == 'Daily') {
                    return $q->whereDate('lead_sales.created_at', Carbon::today())
                        ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($day == 'Monthly') {
                    return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                        ->whereYear('lead_sales.created_at', Carbon::now()->year);
                }
            })
            ->sum('plans.revenue');
        $mnp = lead_sale::select('plans.revenue_port')->where('lead_sales.status', $status)
        // ->Join(
        //     'lead_sales',
        //     'lead_sales.lead_id',
        //     'lead_sales.id'
        // )
        ->Join(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )
        ->Join(
            'plans','plans.id','lead_sales.plans'
        )
        // ->where('plans.revenue')
        ->where('lead_sales.lead_type', 'MNP')
        // ->where('users.agent_code',$agent_code)
        ->when($agent_code, function ($q) use ($agent_code) {
            if ($agent_code == 'All') {
            } else {
                return $q->where('users.agent_code', $agent_code);
            }
        })
            ->when($day, function ($q) use ($day) {
                if ($day == 'Daily') {
                    return $q->whereDate('lead_sales.created_at', Carbon::today())
                        ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($day == 'Monthly') {
                    return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                        ->whereYear('lead_sales.created_at', Carbon::now()->year);
                }
            })
            // ->get()->count();
            // return "ZZ";
            ->sum('plans.revenue_port');
            return $p2p + $mnp + $hw;
    }
    //
    public static function ShareStatus($cmid){

        // return $cmid;
            $url = 'https://apiv2.shipadelivery.com/7151BFA4-D6DB-66EE-FFFF-2579E2541200/E53D8B22-9B05-48D1-8C1C-D126EF68296F/services/whl/v2/my-packages/' . $cmid;
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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
            // echo $response;
            $d = json_decode($response,true);
            // return $d;
            if(isset($d['orderStatus'])){
                echo $d['orderStatus'];
            }

    }
    //
    public static function TotalCount($status, $agent_code, $lead_type, $day)
    {

        if($lead_type == 'HomeWifi'){

            return $data = lead_sale::where('lead_sales.status', '1.02')
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->whereIn('home_wifi_plans.id', ['1', '2', '3'])

                // ->where('home_wifi_plans.id', 1)
                ->get()->count();
        //    return $hw = lead_sale::select(
        //         'home_wifi_plans.id'
        //     )
        //     // ->where('activation_forms.status', $status)
        //     // ->Join(
        //     //     'activation_forms',
        //     //     'activation_forms.lead_id',
        //     //     'lead_sales.id'
        //     // )
        //         ->Join(
        //             'users',
        //             'users.id',
        //             'lead_sales.saler_id'
        //         )
        //         ->Join(
        //             'home_wifi_plans',
        //         'home_wifi_plans.id',
        //             'lead_sales.plans'
        //         )
        //         // ->where('plans.revenue')
        //         ->where('lead_sales.lead_type', 'HomeWifi')
        //         ->where('lead_sales.status','1.02')
        //         // ->where('users.agent_code',$agent_code)
        //         ->when($agent_code, function ($q) use ($agent_code) {
        //             if ($agent_code == 'All') {
        //             } else {
        //                 return $q->where('users.agent_code', $agent_code);
        //             }
        //         })
        //         ->when($day, function ($q) use ($day) {
        //             if ($day == 'Daily') {
        //                 return $q->whereDate('lead_sales.created_at', Carbon::today())
        //                     ->whereYear('lead_sales.created_at', Carbon::now()->year);
        //                 // return $q->where('numberdetails.identity', 'EidSpecial');
        //             } elseif ($day == 'Monthly') {
        //                 return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
        //                     ->whereYear('lead_sales.updated_at', Carbon::now()->year);
        //             }
        //         })
        //         ->get()->count();
        }
        elseif($lead_type == 'broadband'){

            return $data = lead_sale::where('lead_sales.status', '1.02')
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->whereIn('home_wifi_plans.id', ['5', '6', '7'])

                // ->where('home_wifi_plans.id', 1)
                ->get()->count();
        //    return $hw = lead_sale::select(
        //         'home_wifi_plans.id'
        //     )
        //     // ->where('activation_forms.status', $status)
        //     // ->Join(
        //     //     'activation_forms',
        //     //     'activation_forms.lead_id',
        //     //     'lead_sales.id'
        //     // )
        //         ->Join(
        //             'users',
        //             'users.id',
        //             'lead_sales.saler_id'
        //         )
        //         ->Join(
        //             'home_wifi_plans',
        //         'home_wifi_plans.id',
        //             'lead_sales.plans'
        //         )
        //         // ->where('plans.revenue')
        //         ->where('lead_sales.lead_type', 'HomeWifi')
        //         ->where('lead_sales.status','1.02')
        //         // ->where('users.agent_code',$agent_code)
        //         ->when($agent_code, function ($q) use ($agent_code) {
        //             if ($agent_code == 'All') {
        //             } else {
        //                 return $q->where('users.agent_code', $agent_code);
        //             }
        //         })
        //         ->when($day, function ($q) use ($day) {
        //             if ($day == 'Daily') {
        //                 return $q->whereDate('lead_sales.created_at', Carbon::today())
        //                     ->whereYear('lead_sales.created_at', Carbon::now()->year);
        //                 // return $q->where('numberdetails.identity', 'EidSpecial');
        //             } elseif ($day == 'Monthly') {
        //                 return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
        //                     ->whereYear('lead_sales.updated_at', Carbon::now()->year);
        //             }
        //         })
        //         ->get()->count();
        }
        else{
            $p2p = lead_sale::select(
                'plans.revenue'
            )->where('lead_sales.status', $status)
                // ->Join(
                //     'activation_forms',
                //     'activation_forms.lead_id',
                //     'lead_sales.id'
                // )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'plans',
                    'plans.id',
                    'lead_sales.plans'
                )
                // ->where('plans.revenue')
                ->whereIn('lead_sales.lead_type', ['P2P', 'New'])
                // ->where('users.agent_code',$agent_code)
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })
                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })->get()->count();
            // ->sum('plans.revenue');
            $mnp = lead_sale::select('plans.revenue_port')->where('lead_sales.status', $status)
                // ->Join(
                //     'activation_forms',
                //     'activation_forms.lead_id',
                //     'lead_sales.id'
                // )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'plans',
                    'plans.id',
                    'lead_sales.plans'
                )
                // ->where('plans.revenue')
                ->where('lead_sales.lead_type', 'MNP')
                // ->where('users.agent_code',$agent_code)
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })
                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                ->get()->count();
            // return "ZZ";
            // ->sum('plans.revenue_port');
            return $p2p + $mnp;
        }
            // ->sum('home_wifi_plans.revenue_points');


    }
    public static function DailyPointType($status, $agent_code, $lead_type, $day)
    {
        if($lead_type == 'HomeWifi'){
            return  $hw = lead_sale::select(
                'home_wifi_plans.revenue_points'
            )
            // ->where('activation_forms.status', $status)
            // ->Join(
            //     'activation_forms',
            //     'activation_forms.lead_id',
            //     'lead_sales.id'
            // )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->whereIn('home_wifi_plans.id',['1','2','3'])
                // ->where('plans.revenue')
                ->where('lead_sales.lead_type', 'HomeWifi')
                ->where('lead_sales.status','1.02')
                // ->where('users.agent_code',$agent_code)
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })
                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                // ->get()->count();
                ->sum('home_wifi_plans.revenue_points');
        }
        else if($lead_type == 'broadband'){
            return  $hw = lead_sale::select(
                'home_wifi_plans.revenue_points'
            )
            // ->where('activation_forms.status', $status)
            // ->Join(
            //     'activation_forms',
            //     'activation_forms.lead_id',
            //     'lead_sales.id'
            // )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'home_wifi_plans',
                'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->whereIn('home_wifi_plans.id',['5','6','7'])
                // ->where('plans.revenue')
                ->where('lead_sales.lead_type', 'HomeWifi')
                ->where('lead_sales.status','1.02')
                // ->where('users.agent_code',$agent_code)
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })
                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
                // ->get()->count();
                ->sum('home_wifi_plans.revenue_points');
        }
        else{




    $p2p = lead_sale::select(
        'plans.revenue'
    )->where('lead_sales.status', $status)
    // ->Join(
    //     'activation_forms',
    //     'activation_forms.lead_id',
    //     'lead_sales.id'
    // )
    ->Join(
        'users',
        'users.id',
        'lead_sales.saler_id'
    )
    ->Join(
        'plans',
        'plans.id',
        'lead_sales.plans'
    )
    // ->where('plans.revenue')
    ->whereIn('lead_sales.lead_type', ['P2P','New'])
    // ->where('users.agent_code',$agent_code)
    ->when($agent_code, function ($q) use ($agent_code) {
        if ($agent_code == 'All') {
        } else {
            return $q->where('users.agent_code', $agent_code);
        }
    })
        ->when($day, function ($q) use ($day) {
            if ($day == 'Daily') {
                return $q->whereDate('lead_sales.created_at', Carbon::today())
                    ->whereYear('lead_sales.created_at', Carbon::now()->year);
            // return $q->where('numberdetails.identity', 'EidSpecial');
            } elseif ($day == 'Monthly') {
                return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                    ->whereYear('lead_sales.created_at', Carbon::now()->year);
            }
        })
        ->sum('plans.revenue');
    $mnp = lead_sale::select('plans.revenue_port')->where('lead_sales.status', $status)
    // ->Join(
    //     'activation_forms',
    //     'activation_forms.lead_id',
    //     'lead_sales.id'
    // )
    ->Join(
        'users',
        'users.id',
        'lead_sales.saler_id'
    )
    ->Join(
        'plans',
        'plans.id',
        'lead_sales.plans'
    )
    // ->where('plans.revenue')
    ->where('lead_sales.lead_type', 'MNP')
    // ->where('users.agent_code',$agent_code)
    ->when($agent_code, function ($q) use ($agent_code) {
        if ($agent_code == 'All') {
        } else {
            return $q->where('users.agent_code', $agent_code);
        }
    })
        ->when($day, function ($q) use ($day) {
            if ($day == 'Daily') {
                return $q->whereDate('lead_sales.created_at', Carbon::today())
                    ->whereYear('lead_sales.created_at', Carbon::now()->year);
            // return $q->where('numberdetails.identity', 'EidSpecial');
            } elseif ($day == 'Monthly') {
                return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                    ->whereYear('lead_sales.created_at', Carbon::now()->year);
            }
        })
        // ->get()->count();
        // return "ZZ";
        ->sum('plans.revenue_port');
    return $p2p + $mnp;
}
    }
    //
    public static function DailyLeadProcessCount($status, $agent_code,$lead_type,$day){
        // return "98"

        if($lead_type == 'HomeWifi5g199'){
            // return "199";
            return $data = lead_sale::where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                        ->Join(
                            'home_wifi_plans',
                            'home_wifi_plans.id',
                            'lead_sales.plans'
                        )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 1)
                ->get()->count();
        }elseif($lead_type == 'HomeWifi5g'){
            return $data = lead_sale::where('lead_sales.status', $status)
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 2)
                ->get()->count();
        }
        elseif($lead_type == 'HomeWifiUpgrade'){
            return $data = lead_sale::where('lead_sales.status', $status)
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 3)
                ->get()->count();
        }
        elseif($lead_type == 'DU389'){
            return $data = lead_sale::where('lead_sales.status', $status)
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 6)
                ->get()->count();
        }
        elseif($lead_type == 'DU699'){
            return $data = lead_sale::where('lead_sales.status', $status)
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 5)
                ->get()->count();
        }
        elseif($lead_type == 'DU409'){
            return $data = lead_sale::where('lead_sales.status', $status)
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
                ->Join(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'lead_sales.plans'
                )
                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })

                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    }
                })
                ->where('home_wifi_plans.id', 7)
                ->get()->count();
        }
        else{
            return $data = lead_sale::where('lead_sales.status', $status)
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('lead_sales.lead_type', $lead_type)
                // ->where('users.agent_code', $agent_code)


                ->when($agent_code, function ($q) use ($agent_code) {
                    if ($agent_code == 'All') {
                    } else {
                        return $q->where('users.agent_code', $agent_code);
                    }
                })
                ->when($day, function ($q) use ($day) {
                    if ($day == 'Daily') {
                        return $q->whereDate('lead_sales.created_at', Carbon::today())
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($day == 'Monthly') {
                        return $q->whereMonth('lead_sales.created_at', Carbon::now()->month)
                            ->whereYear('lead_sales.created_at', Carbon::now()->year);
                    }
                })
                ->get()->count();
        }

    }
    public static function PendingSaleAgent($status,$name){
        return $data = lead_sale::select('id')
            // ->when($name, function($q) use ())
            ->when($name, function ($q) use ($name) {
                if ($name == 'P2P') {
                    return $q->whereIn('lead_sales.lead_type', ['P2P']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                else if ($name == 'MNP') {
                    return $q->whereIn('lead_sales.lead_type', ['MNP']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                else{
                    return $q->whereIn('lead_sales.lead_type', ['HomeWifi']);
                }
            })
            ->when($status, function ($q) use ($status) {
                if ($status == '1.01') {
                    return $q->whereIn('lead_sales.status', ['1.01','1.19','1.13']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                else{
                    return $q->where('lead_sales.status', $status);
                }
            })
            -> where('lead_sales.saler_id', auth()->user()->id)

        // ->where('lead_sales.lead_type',$name)
        ->get()->count();
    }
    public static function InProcessSaleAgent($status,$name){
        return $data = lead_sale::select('id')
            // ->when($name, function($q) use ())
            ->when($name, function ($q) use ($name) {
                if ($name == 'P2P') {
                    return $q->whereIn('lead_sales.lead_type', ['P2P']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                else if ($name == 'MNP') {
                    return $q->whereIn('lead_sales.lead_type', ['MNP']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                else{
                    return $q->whereIn('lead_sales.lead_type', ['HomeWifi']);
                }
            })
            ->when($status, function ($q) use ($status) {
                if ($status == '1.01') {
                    return $q->whereIn('lead_sales.status', ['1.01','1.19','1.13']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
            })
        -> where('lead_sales.saler_id', auth()->user()->id)

        // ->where('lead_sales.lead_type',$name)
        ->get()->count();
    }
    //
    public static function SendWhatsAppDocs($details)
    {
        $token = env('FACEBOOK_TOKEN');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v14.0/112632378357432/messages',
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
                "type": "document",
                "document": {
                    "link": "https://prts-mppolice.nic.in/e-Courses/Content%20of%20English%20Typing.pdf",
                    "caption": "' . $details['lead_no'] . '\nCustomer Name: ' . $details['customer_name'] . '\n' . '\nFind Attachment ☝️ : ' . '\nUrl: ' . $details['link'] . '"
                    }
                }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response;
    }
    //
    public function ScanWhatsApp(Request $request)
    {
        // $key = '971522221220';
        //
         $duplicates =\DB::table('whats_app_scans') // replace table by the table name where you want to search for duplicated values
        ->select('id', 'wapnumber') // name is the column name with duplicated values
            ->whereIn('wapnumber', function ($q) {
                $q->select('wapnumber')
                ->from('whats_app_scans')
                ->groupBy('wapnumber')
                ->havingRaw('COUNT(*) > 1');
            })
            ->orderBy('wapnumber')
            ->orderBy('id') // keep smaller id (older), to keep biggest id (younger) replace with this ->orderBy('id', 'desc')
            ->get();
        // //
        $value = "";

        // loop throuht results and keep first duplicated value
        foreach ($duplicates as $duplicate) {
            if ($duplicate->wapnumber === $value) {
                \DB::table('whats_app_scans')->where('id', $duplicate->id)->delete(); // comment out this line the first time to check what will be deleted and keeped
                echo "$duplicate->wapnumber with id $duplicate->id deleted! \n";
            } else
            echo "$duplicate->wapnumber with id $duplicate->id keeped \n";
            $value = $duplicate->wapnumber;
        }
        return "Mission Complete";

        //
        $da = WhatsAppScan::select('id', 'wapnumber')->where('count_digit', '=', 2)
        // ->OrWhere('count_digit', 'random')
        ->where('is_whatsapp', 0)
        ->limit(1000)->get();
        foreach ($da as $d) {

            $data[] = array(

                'receiver' => trim($d->wapnumber),
                'message' => $d->id,
                // 'status' => $d->is_whatsapp

            );
        }
       $data_string = json_encode($data);
        // // // $data = '923121337222,923442708646';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://20.84.63.80:4000/chats/TestBulkTest?id=DXB',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            // CURLOPT_POSTFIELDS =>'[
            //     {
            //         "receiver": "923121337222",
            //         "message": "Hi bro, how are you?"
            //     },
            //     {
            //         "receiver": "9234227086461",
            //         "message": "I\'m fine, thank you."
            //     }
            // ]',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $b = json_decode($response, true); //here the json string is decoded and returned as associative array
        // return $b;
        $not_available = $b['data']['not_available'];
        $available = $b['data']['available'];
        //
        // foreach ($available as $k) {
        //     // return $k;
        //     $an[] = preg_replace('/@s.whatsapp.net/', ',', $k);
        //     //  $z = explode('@',$k);
        //     //  foreach($z as $k){
        //     //      echo $k . '<br>';
        //     //  }
        //     // $l =  preg_replace('/971/', '0', $k, 3);
        // }
        // foreach ($not_available as $nk) {
        //     // return $k;
        //     $nan[] = preg_replace('/@s.whatsapp.net/', ',', $nk);
        //     //  $z = explode('@',$k);
        //     //  foreach($z as $k){
        //     //      echo $k . '<br>';
        //     //  }
        //     // $l =  preg_replace('/971/', '0', $k, 3);
        // }
        // // return $pr;
        // foreach ($an as $p) {
        //     // echo $p . '<br>';
        //     $z = str_replace(',', ' ', $p);
        //     $data = WhatsAppScan::where('wapnumber', '=', $z)->first();
        //     if($data){
        //         $data->is_whatsapp = 1;
        //         $data->save();
        //     }
        // }
        // foreach ($nan as $np) {
        //     // echo $p . '<br>';
        //     $z = str_replace(',', ' ', $np);
        //     $data = WhatsAppScan::where('wapnumber', '=', $z)->first();
        //     if($data){
        //         $data->is_whatsapp = 2;
        //         $data->save();
        //     }
        // }
        return "Clear and OUT";
        return redirect()->route('ScanWhatsApp');
        // return $z;
    }
    //
    //
    public static function SendWhatsAppDailyUpdate($details)
    {
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';

        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "vocus_update",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['date'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['p2p_count'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['wifi_count'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['mnp_count'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['new_sim'] . '"
                        },
                    ]
                }
            ]
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
        //

    }
    //
    //
    public static function SendWhatsAppDailyUpdateCCWise($details)
    {
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';

        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "cc_update_daily",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['date'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['p2p_count'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['wifi_count'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['mnp_count'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['cc_name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['new_sim'] . '"
                        },
                    ]
                }
            ]
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
        //

    }
    //
    //
    public static function SendWhatsAppDailyUpdateCCWiseBoss($details)
    {
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');

        foreach (explode(',', $details['number']) as $nm) {


            //

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
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "boss_update_final",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['date'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['cc_name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['p2p_count_daily'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['wifi_count_daily'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['mnp_count_daily'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['p2p_count_monthly'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['wifi_count_monthly'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['mnp_count_monthly'] . '"
                        },
                    ]
                }
            ]
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
        //

    }
    //
    //
    public static function MissionDU($details)
    {
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');

        foreach (explode(',', $details['number']) as $nm) {


            //

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
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "trackmission",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['data'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['link'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['time'] . '"
                        },

                    ]
                }
            ]
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
        //

    }
    //
    public static function SendWhatsAppTrackingCode($details)
    {
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');
        // return $details['trackingID'];
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';

        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "trackingtemp",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['trackingID'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['trackingUrl'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['AgentName'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['CustomerName'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['LeadNo'] . '"
                        },

                    ]
                }
            ]
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
        //

    }
    //
    //
    public static function SendWhatsAppTrackingCodeTL($details)
    {
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN_SECOND');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        // return "Token";
        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "trackingtemp",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['trackingID'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['trackingUrl'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['AgentName'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['CustomerName'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['LeadNo'] . '"
                        },

                    ]
                }
            ]
        }
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response;
        }
        //

    }
    //
    public static function SendAttendanceWhatsApp($details, $number)
    {
        $token = env('FACEBOOK_TOKEN');
        // return $number;
        // return $details['lead_no'];

        foreach ($number as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/104929992273131/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "messaging_product": "whatsapp",
        "to": "' . $nm . '",
        "type": "template",
        "template": {
            "name": "login_att",
            "language": {
                "code": "en_US"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['attendance_date'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . date('h:i A', strtotime($details['attendance_time'])) . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['status'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['call_center'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['name'] . '"
                        },
                        {
                            "type": "text",
                            "text": "' . $details['email'] . '"
                        }

                    ]
                }
            ]
        }
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token

                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        }
    }
    //
    public function CheckQuickPay(Request $request){

        $number = $request->number;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crm.smarttonedxb.com/api/CheckQuickPay',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('number' => $number),
        ));

        echo $response = curl_exec($curl);

        curl_close($curl);
        // return $response['code'];
        // echo $response['code'];
        //  echo $response['rateplan'];
        // return json_decode($response, true); //here the json string is decoded and returned as associative array
        // return $b['rateplan'];

    }
    //
    public function add_eti(Request $request)
    {
        return view('dashboard.add-eti');
    }
    //
    public function CheckEtiPay(Request $request){

        ini_set('max_execution_time', '30000'); //300 seconds = 5 minutes


            //    $data = '0505660079';
            $data= $request->list;
            // $data = '0501230579,0501230579';
                $a = array();

            foreach ($tags = explode(PHP_EOL, $request->list) as $k => $dm)

                // foreach (explode(',', $data) as $k => $dm)
            {

            // return $dm;

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.etisalat.ae/b2c/getOutstandingBillAmount.service',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"accountNo":"'.trim($dm).'","isAccountId":false}',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
                'Accept-Language: en-GB,en-US;q=0.9,en;q=0.8',
                'CSRF-Token: undefined',
                'Connection: keep-alive',
                'Content-Type: application/json',
                'Cookie: s_ips=1835; s_tp=2089; s_ppv=en-ae:my etisalat - self care,88,88,1835,2,5; affinity="38f9ba60fbfc3ff5"; myAppLocaleCookie=en; B2CJSESSIONID=rGCOQQQ_Oa_CCNruSf1mR_XZwib7Cy3QjMYzu336zedKuo_vMp1X!-2122302380; _gid=GA1.2.1338704933.1690308774; kndctr_129F57B55FC100170A495FAA_AdobeOrg_identity=CiYyODM3Mjc5NDU1OTUxOTUyMjU1MDI2MTk4NTM2NjczOTcyMTQ2NlIPCICShPKYMRgBKgRJUkwx8AGAkoTymDE=; kndctr_129F57B55FC100170A495FAA_AdobeOrg_cluster=irl1; _gcl_au=1.1.509495874.1690308774; ln_or=eyI5ODgxNzEiOiJkIn0%3D; XJSESSIONID=C_SOQQubgCg9f5-AxvfLCqr3yvKit2cr4k3dUZ-iJShBKMCXeiYF!-1583408084; _hjFirstSeen=1; _hjIncludedInSessionSample_1432586=0; _hjSession_1432586=eyJpZCI6IjFiZDk4MGI1LWRhYTktNDA5Zi04OTRlLWUwMTQxYzdhNWM0NiIsImNyZWF0ZWQiOjE2OTAzMDg3NzQ3NTIsImluU2FtcGxlIjpmYWxzZX0=; _hjAbsoluteSessionInProgress=1; _tt_enable_cookie=1; _ttp=Fdj-IV3Tnxmcm8e99aHHYBmw7fh; _fbp=fb.1.1690308775141.164362088; iDSP_Cookie=276ffc05-b824-489f-894a-b2cfed73292a**1690308775404*be74c68eaf2f4481a2c389f9ca07dae8; _scid=ce3d6774-55dc-498a-890e-9c4932284f9f; _sctr=1%7C1690228800000; ADRUM=s=1690309037099&r=https%3A%2F%2Fwww.etisalat.ae%2Fb2c%2Fquick-pay.html%3F-700193875; userPrefLanguage=en_AE; BIGipServerb2cprod_443_pool=365179658.28955.0000; JSESSIONID=VW6OQQplyC_Oqaa95koW6OlzvZ5GCvXs4LyuuxxMqPjaVCHagcYY!-971111052; TS01591b0c=012b7f183c9b7ba54c5117b7fa4a2bf0626c9b8de8e789257f66dea09dfd772afed1580ce727577727759b8a3a1e57b884c110e7d3; _uetsid=e01510602b1611eeaa7dc5b5fe8c0f1d; _uetvid=e0153f002b1611ee8adbcda2a0399a8e; _ga_BPWBRZB9JK=GS1.1.1690308774.1.1.1690309039.58.0.0; _ga=GA1.2.342506883.1690308774; _hjSessionUser_1432586=eyJpZCI6ImNmM2U4ZTc2LWEwM2EtNTAxYi1hYzZmLThmYzEwOWQ5MWI5YyIsImNyZWF0ZWQiOjE2OTAzMDg3NzQ3NDYsImV4aXN0aW5nIjp0cnVlfQ==; cto_bundle=AqfuDl9ETENOUDByaWhWR1pRNUpmVHR3cERBemJ2Sm1GNXJ1bDJhcDBWcm5CU0N2d2JIMVVteHdKcnVYUiUyRmQlMkZMZjJJaSUyRiUyRk1kaXlNd2F1RTg1N0ElMkJxeWM4eDVKYjRGWm82alpyZDQxV1JQVnE3M3BBdU9PS2IlMkZKNlNaYkJjaW8ybEN2STd4aU45NFY5R2Z2S3hiNlJiNWM0bG5hQWhxTFlmS1VpWmNmU21kQXAzckJGODJ0QkRBRDhuOSUyQkJ5ZnRMRG1QSg; _scid_r=ce3d6774-55dc-498a-890e-9c4932284f9f; CMS-cookie=!ewx1jrTMNyz8Tk05SVRtZjzjmMcesnpSSmFiBNMOxLYHr/c/ZTtHhzH8DH6/ifzlZ21dEB7k3Ndn0fU=; TS01affbe6=012b7f183c8f02032624f04aa8a1f059220bb10896342803481ad1035446da548eaba688659a4c19810a044d7d184c3f30fe17fd37; SameSite=None; _ga_CFZHK9Y2D6=GS1.1.1690308774.1.1.1690309389.0.0.0; ADRUM_BTa=R:52|g:a833de2f-0605-4cdd-a029-8c82750064d3|n:customer1_8330acca-5d30-48e6-8384-57b66386c1ba; ADRUM_BT1=R:52|i:91318|e:1049; ADRUM_BT1=R:52|i:758|e:2107|d:478; ADRUM_BTa=R:52|g:656b836b-d3af-4628-a4b4-d45303896ae6|n:customer1_8330acca-5d30-48e6-8384-57b66386c1ba; ADRUM_BTh=R:52|h:e; ADRUM_BTs=R:52|s:f; B2CJSESSIONID=z3COd61TOwGkOyMWg5NNuRPvN8wNRFMzM9K1hG9rqvG79bpm5Qar!-2122302380; SameSite=None; TS01affbe6=012b7f183c108ab5247515fac82ae2a5d5a2e2e592f747c103cdd78d71467d99827a84cb69eab754afc48c1cbb460b243201eae600',
                'Origin: https://www.etisalat.ae',
                'Referer: https://www.etisalat.ae/b2c/quick-pay.html?locale=en',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: same-origin',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'X-CSRF-TOKEN: 8484ef0b-fa24-4b9f-b6a7-3a362fe3f8c8',
                'charset: utf-8',
                'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "macOS"'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $info = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (!$info == 500) {
                return redirect()->back()
                    ->withErrors('Invalid Number, No Numbers found for Calling - ')
                    ->withInput();
            }
            $b = json_decode($response,true);
            if(isset($b['prepaidBalance'])){
                $a[$k]['summary']=  trim($dm) . " => Number is Prepaid - and Balance is => " . $b['prepaidBalance'];
            }
            else if(isset($b['totalAmountDue'])){
                $a[$k]['summary']=  trim($dm) . " => Number is Postpaid - and Balance is => " . $b['totalAmountDue'];
            }
            // else{
            //     $a[$k]['summary']=  trim($dm) . ' = >YE BHT BARA DUKH H MAT DKHO';
            // }
            // echo $response;
        }
        return $a;

    }
    //
    public function RequestAgent(Request $request){

    }
    //
    /**
     * Show user online status.
     */
    public function status()
    {
        $users = User::all();

        foreach ($users as $user) {

            if (Cache::has('user-is-online-' . $user->id))
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " ";
            else {
                if ($user->last_seen != null) {
                    echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " ";
                } else {
                    echo $user->name . " is offline. Last seen: No data ";
                }
            }
        }
    }
    //
    /**
     * Live status page.
     */
    public function liveStatusPage()
    {
        $users = \App\Models\User::all();
        return view('live', compact('users'));
    }

    /**
     * Live status.
     */
    public function liveStatus($user_id)
    {
        // get user data
        $user = User::find($user_id);

        // check online status
        if (Cache::has('user-is-online-' . $user->id))
            $status = 'Online';
        else
            $status = 'Offline';

        // check last seen
        if ($user->last_seen != null)
            $last_seen = "Active " . Carbon::parse($user->last_seen)->diffForHumans();
        else
            $last_seen = "No data";

        // response
        return response()->json([
            'status' => $status,
            'last_seen' => $last_seen,
        ]);
    }
    //
    public static function LastSaleCounter($id)
    {
        // return $id;
        $active = \App\Models\ActivationForm::select('activation_forms.created_at')
        ->LeftJoin(
            'lead_sales',
            'lead_sales.id',
            'activation_forms.lead_id'
        )
            ->LeftJoin(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->where('activation_forms.status', '1.02')
            ->whereIn('lead_sales.lead_type', ['postpaid', 'HomeWifi'])
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $id)
            ->orderBy('activation_forms.created_at', 'desc')
            ->whereMonth('activation_forms.created_at', Carbon::now()->month)
            ->whereYear('activation_forms.created_at', Carbon::now()->year)
            ->first();
        if ($active) {
            return $active->created_at;
        }
        // ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    //
    public static function MyWhatsAppCount($status,$myid)
    {
    // $myid = auth()->user()->role;
     return   $data = \App\Models\main_data_user_assigner::select('main_data_user_assigners_1.id')
        ->Join(
            'users',
            'users.id',
            'main_data_user_assigners_1.user_id'
        )
        ->where('users.id', $myid)
            // ->where('users.agent_code',auth()->user()->agent_code)
        ->WhereIn('main_data_user_assigners_1.status',['DNC','Follow Up','Call Later','Lead','Already Using DU 5G HW','Already Using Etisalat 5G HW','Already Postpaid','Hard DND','Soft DND','Happy With Prepaid','Bad Experience with Du','Not the Owner','Going on Vacation','Low Usage','Leaving Country','Using Etisalat Prepaid','Hang Up','Not Interested','Arabic','Soft DNC', 'Call Drop by Customer','Customer Disconnecting the Call', 'DNC','TTS'])
            // ->groupby('main_data_user_assigners_1.status')
            // ->Where
        ->when($status, function ($query) use ($status) {
            if ($status == 'Daily') {
                // return $query->where('users.agent_code', auth()->user()->agent_code);
                return $query->whereDate('main_data_user_assigners_1.updated_at',Carbon::today());
            }
            else if($status == 'Weekly'){
                // return $query->whereDate('main_data_user_assigners_1.updated_at',Carbon::today())
                return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::yesterday())
                    ->whereBetween(
                        'main_data_user_assigners_1.updated_at',
                        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                    );
            }
            else if($status == 'Monthly'){
                return $query->whereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                // return $query->where('users.id', auth()->user()->id);
            }
            // else if($myrole == 'KHICordination'){
            //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
            // }
            // else {
            //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
            // }
        })
        ->get()->count();;
    }
    //     //
    //
    public static function MyWhatsAppCountFNE($status,$myid,$type)
    {
    // $myid = auth()->user()->role;
     return   $data = \App\Models\fne_data_user_assigner::select('fne_data_user_assigners.id')
        ->Join(
            'users',
            'users.id',
            'fne_data_user_assigners.user_id'
        )
        ->Join(
            'fne_number_banks',
            'fne_number_banks.id',
            'fne_data_user_assigners.number_id'
        )
        ->where('fne_number_banks.lead_type',$type)
        ->where('users.id', $myid)
            // ->where('users.agent_code',auth()->user()->agent_code)
        ->WhereIn('fne_data_user_assigners.status',['DNC','Follow Up','Call Later','Lead','Already Using DU 5G HW','Already Using Etisalat 5G HW','Already Postpaid','Hard DND','Soft DND','Happy With Prepaid','Bad Experience with Du','Not the Owner','Going on Vacation','Low Usage','Leaving Country','Using Etisalat Prepaid','Hang Up','Not Interested','Arabic','Soft DNC', 'Call Drop by Customer','Customer Disconnecting the Call', 'DNC'])
            // ->groupby('main_data_user_assigners_1.status')
            // ->Where
        ->when($status, function ($query) use ($status) {
            if ($status == 'Daily') {
                // return $query->where('users.agent_code', auth()->user()->agent_code);
                return $query->whereDate('fne_data_user_assigners.updated_at',Carbon::today());
            }
            else if($status == 'Weekly'){
                // return $query->whereDate('main_data_user_assigners_1.updated_at',Carbon::today())
                return $query->whereDate('fne_data_user_assigners.updated_at', Carbon::yesterday())
                    ->whereBetween(
                        'fne_data_user_assigners.updated_at',
                        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                    );
            }
            else if($status == 'Monthly'){
                return $query->whereMonth('fne_data_user_assigners.updated_at', Carbon::now()->month);
                // return $query->where('users.id', auth()->user()->id);
            }
            // else if($myrole == 'KHICordination'){
            //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
            // }
            // else {
            //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
            // }
        })
        ->get()->count();;
    }
    //     //
    public static function MyTotalSale($id)
    {
        // return $id;
       return $active = \App\Models\ActivationForm::select('activation_forms.created_at')
        ->LeftJoin(
            'lead_sales',
            'lead_sales.id',
            'activation_forms.lead_id'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->where('activation_forms.status', '1.02')
            // ->whereIn('lead_sales.lead_type', ['postpaid', 'HomeWifi'])
            // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
            ->where('users.id', $id)
            ->orderBy('activation_forms.created_at', 'desc')
            ->whereMonth('activation_forms.created_at', Carbon::now()->month)
            ->whereYear('activation_forms.created_at', Carbon::now()->year)
            ->get()->count();

        // ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    public static function DateActivation($date,$cc)
    {
        // return $id;
        // return $date;
        // return $date - 1;
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $MyDate = $date->format('d');
        // return $MyDate;
        if($MyDate == 1){
            // return "Google";
            return $active = \App\Models\ActivationForm::select('activation_forms.created_at')
                ->LeftJoin(
                    'lead_sales',
                    'lead_sales.id',
                    'activation_forms.lead_id'
                )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )

                ->where('activation_forms.status', '1.02')
                ->whereIn('lead_sales.lead_type', ['HomeWifi'])
                // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
                // ->where('users.id', $id)
                // ->orderBy('activation_forms.created_at', 'desc')
                // ->where('users.agent_code',$cc)
                // ->whereDate('activation_forms.created_at', $date)
                    ->whereDate('activation_forms.created_at', $date)

                // ->whereYear('activation_forms.created_at', Carbon::now()->year)
                ->get()->count();
            }else{
            // return $date;
            $dating = Carbon::createFromFormat('Y-m-d H:i:s', $date);
            $MyDate = $dating->format('d');
            $current_date = $dating->subDay(1); // Subtracts 1 day
            // return $date;
            // return $current_date;
                        // $startDate = \Carbon\Carbon::now(); //returns current day
            $now = $dating->firstOfMonth();
        // return

     return $active = \App\Models\ActivationForm::select('activation_forms.created_at')
        ->LeftJoin(
            'lead_sales',
            'lead_sales.id',
            'activation_forms.lead_id'
        )
        ->Join(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )

        ->where('activation_forms.status', '1.02')
        ->whereIn('lead_sales.lead_type', ['HomeWifi'])
        ->whereBetween('activation_forms.created_at', [$now,$date])
        ->get()->count();
        // return "Zoogle";
            }


        // ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    public static function DateSubmission($date,$cc)
    {
        // return $id;
        // return $date;
        // return $date - 1;
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $MyDate = $date->format('d');
        // return $MyDate;
        if($MyDate == 1){
            // return "Google";
            return $active = \App\Models\lead_sale::select('lead_sales.created_at')
                // ->LeftJoin(
                //     'lead_sales',
                //     'lead_sales.id',
                //     'activation_forms.lead_id'
                // )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )

        -> whereIn('lead_sales.status', ['1.02', '1.05', '1.08', '1.10'])

                // ->where('lead_sales.status', '1.02')
                ->whereIn('lead_sales.lead_type', ['HomeWifi'])
                // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
                // ->where('users.id', $id)
                // ->orderBy('activation_forms.created_at', 'desc')
                // ->where('users.agent_code',$cc)
                // ->whereDate('activation_forms.created_at', $date)
                    ->whereDate('lead_sales.created_at', $date)

                // ->whereYear('activation_forms.created_at', Carbon::now()->year)
                ->get()->count();
            }else{
            // return $date;
            $dating = Carbon::createFromFormat('Y-m-d H:i:s', $date);
            $MyDate = $dating->format('d');
            $current_date = $dating->subDay(1); // Subtracts 1 day
            // return $date;
            // return $current_date;
                        // $startDate = \Carbon\Carbon::now(); //returns current day
            $now = $dating->firstOfMonth();
        // return

     return $active = \App\Models\lead_sale::select('lead_sales.created_at')
        // ->LeftJoin(
        //     'lead_sales',
        //     'lead_sales.id',
        //     'activation_forms.lead_id'
        // )
        ->Join(
            'users',
            'users.id',
            'lead_sales.saler_id'
        )

        ->whereIn('lead_sales.status', ['1.02','1.05','1.08','1.10'])
        ->whereIn('lead_sales.lead_type', ['HomeWifi'])
                ->whereDate('lead_sales.created_at', $date)

        // ->whereBetween('lead_sales.created_at', [$now,$date])
        ->get()->count();
        // return "Zoogle";
            }


        // ->count();
        // ->whereIn('lead_sales.channel_type', ['TTF','ExpressDial','MWH','Ideacorp'])
        // ->whereBetween('date_time', [$today->startOfMonth(), $today->endOfMonth])
        // ->where('users.id', $id)
    }
    //
    public function RequestFNE(Request $request){
        // return $request;
        // $plan = Plan::where('status', '1')->get();
        // $country = country_phone_code::select('name')->get();
        // $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New FNE Request"]
        ];
        // $type = 'Vocus';
        $planwifi = \App\Models\HomeWifiPlan::where('status', '1')->whereIn('id', ['5', '6', '7'])->get();

        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.new-fne-request', compact('breadcrumbs', 'planwifi'));
    }
    //
    public static function WhatsAppFNERequest($details)
    {
        // return $details;
        // $token = env('FACEBOOK_TOKEN');
        $token = '
        ';
        foreach (explode(',', $details['numbers']) as $nm) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "fne_template",
                    "language": {
                        "code": "en_US"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "' . auth()->user()->name . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['building'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['unit'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['address'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['google_location'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['customer_number'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['5g_number'] . '"
                                },

                            ]
                        }
                    ]
                }
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response;
        }

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    //
    //
    public static function WhatsAppFNERequestWorkOrder($details)
    {
        // return "Agni";
        // return $details[];
        // return $details['lead_no'];
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        foreach (explode(',', $details['numbers']) as $nm) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "work_order_fne",
                    "language": {
                        "code": "en_US"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "' . $details['lead_no'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['customer_name'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['customer_number'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['plan'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['activity'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['activity_date'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['work_order'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['work_order_date'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['visit_date'] . '"
                                },

                            ]
                        }
                    ]
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

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    //
    //
    // public static function WhatsAppFNERequestWorkOrder($details)
    // {
    //     // return "Agni";
    //     // return $details;
    //     // return $details['lead_no'];
    //     // $token = env('FACEBOOK_TOKEN');
    //     $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
    //     foreach (explode(',', $details['numbers']) as $nm) {

    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => '',
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => 'POST',
    //             CURLOPT_POSTFIELDS => '{
    //             "messaging_product": "whatsapp",
    //             "to": "' . $nm . '",
    //             "type": "template",
    //             "template": {
    //                 "name": "work_order_fne",
    //                 "language": {
    //                     "code": "en_US"
    //                 },
    //                 "components": [
    //                     {
    //                         "type": "body",
    //                         "parameters": [
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['lead_no'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['customer_name'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['customer_number'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['plan'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['activity'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['activity_date'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['work_order'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['work_order_date'] . '"
    //                             },
    //                             {
    //                                 "type": "text",
    //                                 "text": "' . $details['visit_date'] . '"
    //                             },

    //                         ]
    //                     }
    //                 ]
    //             }
    //             }',
    //             CURLOPT_HTTPHEADER => array(
    //                 'Content-Type: application/json',
    //                 'Authorization: Bearer ' . $token
    //             ),
    //         ));

    //         $response = curl_exec($curl);

    //         curl_close($curl);
    //         echo $response;
    //     }

    //     // return "zoom";
    //     // return back()->with('success', 'Add successfully.');
    //     // return redirect(route('add.dnc.number.agent'));
    // }
    //
    //
    public static function WhatsAppFNERequestUpdate($details)
    {
        // return $details;
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        foreach (explode(',', $details['numbers']) as $nm) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "fne_update",
                    "language": {
                        "code": "en_US"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "' . $details['id'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['agent_name'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['building'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['is_status'] . '"
                                }
                                    ,
                                {
                                    "type": "text",
                                    "text": "' . $details['customer_name'] . '"
                                }

                            ]
                        }
                    ]
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

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    //
    //
    public function RequestFNESubmit(Request $request){
        //
        $validatedData = Validator::make($request->all(), [
            'address' => 'required|string',
            'building' => 'required|string',
            'customer_name' => 'required',
            'plans' => 'required',
            'building' => 'required|string',
            'unit' => 'required',
            'google_location' => 'required|string|url',
            'customer_number' => 'required|string',
            'fiveg_number' => 'required|string',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        $ddm = fne_data::where('google_location', $request->google_location)->first();
        if ($ddm) {
            return response()->json(['error' => ['Documents' => ['Request Already Proceed']]], 200);
        }
        if ($request->customer_number === $request->fiveg_number) {
            return response()->json(['error' => ['Documents' => ['5G and Customer Number Need to Be Unique']]], 200);
        }
        if ($request->plans == 6 || $request->plans == 7) {
            if($request->expiry == ''){
                return response()->json(['error' => ['Documents' => ['5G Expiry is Mandatory']]], 200);
            }
        }
        $data = fne_data::create([
            'customer_name' => $request->customer_name,
            'plan' => $request->plans,
            'expiry' => $request->expiry,
            'address' => $request->address,
            'building' => $request->building,
            'unit' => $request->unit,
            'google_location' => $request->google_location,
            'customer_number' => $request->customer_number,
            '5g_number' => $request->fiveg_number,
            'user_id' => auth()->user()->id,
            'is_status' => 'Pending',
        ]);
        $MyData = [
            'address' => $request->address,
            'building' => $request->building,
            'unit' => $request->unit,
            'google_location' => $request->google_location,
            '5g_number' => $request->fiveg_number,
            'customer_number' => $request->customer_number,
            'numbers'=> '923121337222,923453598420'
        ];
        \App\Http\Controllers\FunctionController::WhatsAppFNERequest($MyData);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);


    }
    //
    public function RequestFNEUpdate(Request $request){
        //
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'is_status' => 'required',
            // 'zone' => 'required',
            'giad' => 'required',
            'project_type' => 'required',
            'building' => 'required|string',
            'customer_name' => 'required|string',
            'fiveg_number' => 'required',
            'account_id' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if ($request->plans == 5 || $request->plans == 7) {
            if($request->expiry == ''){
                return response()->json(['error' => ['Documents' => ['5G Expiry is Mandatory']]], 200);
            }
        }
        if ($request->is_status == 'not_eligible') {
            if($request->important_remarks == ''){
                return response()->json(['error' => ['Documents' => ['Kindly Share the Remarks for Not Eligible']]], 200);
            }
        }
        //
        $d = \App\Models\danger_zone::where('number',$request->fiveg_number)->first();
        if($d){
            return response()->json(['error' => ['Documents' => ['5G Not Eligible For FNE']]], 200);
        }
        //
        if ($request->is_status == 'TT_GENERATED') {
            if ($request->tt_number == '') {
                return response()->json(['error' => ['Documents' => ['Kindly Add TT Request for proceeding lead ']]], 200);
            }
            //
            $data = fne_data::where('id', $request->id)
            ->update([
                'is_status' => $request->is_status,
                'zone' => $request->is_status,
                'tt_number' => $request->tt_number,
                'customer_name' => $request->customer_name,
                'plan' => $request->plans,
                'giad' => $request->giad,
                'project_type' => $request->project_type,
                'customer_number' => $request->customer_number,
                'expiry' => $request->expiry,
                'account_id' => $request->account_id,
                '5g_number' => $request->fiveg_number,
                'building' => $request->building,
                'address' => $request->address,
            ]);
            $data = fne_data::findorfail($request->id);
            // $data->is_status = $request->is_status;
            // $data->zone = $request->zone;
            // $data->tt_number = $request->tt_number;
            // $data->customer_name = $request->customer_name;
            // $data->plan = $request->plans;
            // $data->zone = $request->zone;
            // $data->giad = $request->giad;
            // $data->project_type = $request->project_type;
            // $data->expiry = $request->expiry;
            // $data->account_id = $request->account_id;
            // $data->5g_number = $request->fiveg_number;
            // $data->save();
            // return "error";
        }
        else{

            //
            // $data->is_status = $request->is_status;
            // $data->zone = $request->zone;
            // // $data->tt_number = $request->tt_number;
            // $data->customer_name = $request->customer_name;
            // $data->plan = $request->plans;
            // $data->zone = $request->zone;
            // $data->giad = $request->giad;
            // $data->project_type = $request->project_type;
            // $data->expiry = $request->expiry;
            // $data->account_id = $request->account_id;
            // $data->5g_number = $request->fiveg_number;

            // $data->save();
            $data = fne_data::where('id', $request->id)
            ->update([
                'is_status' => $request->is_status,
                'zone' => $request->is_status,
                // 'tt_number' => $request->tt_number,
                'customer_name' => $request->customer_name,
                'customer_number' => $request->customer_number,
                'plan' => $request->plans,
                'giad' => $request->giad,
                'project_type' => $request->project_type,
                'expiry' => $request->expiry,
                'account_id' => $request->account_id,
                '5g_number' => $request->fiveg_number,
                'building' => $request->building,
                'address' => $request->address,
            ]);
            $data = fne_data::findorfail($request->id);


            \App\Models\remarks_fne::create([
                'remarks' => $request->important_remarks,
                // 'lead_status' => '0',
                'lead_id' => $data->id,
                'source' => 'FNE',
                // 'lead_no' => $request->id,
                'user_name' => auth()->user()->name,
                'user_id' => auth()->user()->id,
            ]);

            // return $request->zone;
            if($request->is_status == 'OutZone' || $request->is_status == 'Invalid' || $request->is_status == 'Commercial' || $request->is_status == 'not_eligible'){
                // return $request;
                $lead=  lead_sale::where('lead_reff',$request->id)->first();
                if($lead){
                    $lead->status = '1.14';
                    $lead->emirate_id = $request->emirate_id;
                    $lead->dob = $request->dob;
                    $lead->nationality = $request->nationality;
                    $lead->save();
                    //
                    \App\Models\remark::create([
                        'remarks' => $request->important_remarks,
                        'lead_status' => '1.13',
                        'lead_id' => $lead->id,
                        'lead_no' => $lead->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                        'user_agent' => 'Sale',
                        'user_agent_id' => auth()->user()->id,
                    ]);
                }
            }
            else{
                // return $request->emirate_id;
                $lead=  lead_sale::where('lead_reff',$request->id)->first();
                if($lead){
                    $lead->status = $request->uniquestatus;
                    $lead->emirate_id = $request->emirate_id;
                    $lead->dob = $request->dob;
                    $lead->nationality = $request->nationality;
                    $lead->save();
                    //
                    \App\Models\remark::create([
                        'remarks' => $request->important_remarks,
                        'lead_status' => '1.13',
                        'lead_id' => $lead->id,
                        'lead_no' => $lead->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                        'user_agent' => 'Sale',
                        'user_agent_id' => auth()->user()->id,
                    ]);
                }

            }
        }
        // $data = fne_data::create([
        //     'address' => $request->address,
        //     'building' => $request->building,
        //     'unit' => $request->unit,
        //     'google_location' => $request->google_location,
        //     'customer_number' => $request->customer_number,
        //     '5g_number' => $request->fiveg_number,
        //     'user_id' => auth()->user()->id,
        //     'is_status' => 'Pending',
        // ]);
        $data2 = user::select('email','teamleader')->where('id',$data->user_id)->first();

        // $ntc = lead_sale::select('call_centers.notify_email', 'users.secondary_email', 'users.agent_code', 'call_centers.numbers', 'users.teamleader')
        // ->Join(
        //     'users',
        //     'users.id',
        //     'lead_sales.saler_id'
        // )
        // ->Join(
        //     'call_centers',
        //     'call_centers.call_center_code',
        //     'users.agent_code'
        // )
        // ->where('lead_sales.id', $lead->id)->first();
        //
        $tl = User::where('id', $data2->teamleader)->first();
        if ($tl) {
            $wapnumber = '923121337222';

            // $wapnumber = $tl->phone .','. '923121337222,923453598420';
        // } else {
            // $wapnumber = $ntc->numbers;
        }
        else{
            $wapnumber = '923121337222,923453598420';
        }

        $MyData = [
            'agent_name' => $data2->email,
            'id' => $data->id,
            'building' => $request->building,
            'is_status' => $request->is_status,
            'numbers'=> $wapnumber
        ];
        \App\Http\Controllers\FunctionController::WhatsAppFNERequestUpdate($MyData);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);


    }
    //
    //
    public function AyanFNEUpdate(Request $request){
        //
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'is_status' => 'required',
            // 'zone' => 'required',
            'giad' => 'required',
            'project_type' => 'required',
            'building' => 'required|string',
            'customer_name' => 'required|string',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if ($request->plans == 5 || $request->plans == 7) {
            if($request->expiry == ''){
                return response()->json(['error' => ['Documents' => ['5G Expiry is Mandatory']]], 200);
            }
        }
        if ($request->is_status == 'not_eligible') {
            if($request->important_remarks == ''){
                return response()->json(['error' => ['Documents' => ['Kindly Share the Remarks for Not Eligible']]], 200);
            }
        }
        //
        if ($request->is_status == 'TT_GENERATED') {
            if ($request->tt_number == '') {
                return response()->json(['error' => ['Documents' => ['Kindly Add TT Request for proceeding lead ']]], 200);
            }
            //
            $data = fne_data::findorfail($request->id);
            $data->is_status = $request->is_status;
            $data->zone = $request->zone;
            $data->tt_number = $request->tt_number;
            $data->customer_name = $request->customer_name;
            $data->plan = $request->plans;
            $data->zone = $request->zone;
            $data->giad = $request->giad;
            $data->project_type = $request->project_type;
            $data->expiry = $request->expiry;
            $data->save();
            // return "error";
        }
        else{

            //
            $data = fne_data::findorfail($request->id);
            $data->is_status = $request->is_status;
            $data->zone = $request->zone;
            // $data->tt_number = $request->tt_number;
            $data->customer_name = $request->customer_name;
            $data->plan = $request->plans;
            $data->zone = $request->zone;
            $data->giad = $request->giad;
            $data->project_type = $request->project_type;
            $data->expiry = $request->expiry;

            $data->save();

            \App\Models\remarks_fne::create([
                'remarks' => $request->important_remarks,
                // 'lead_status' => '0',
                'lead_id' => $data->id,
                'source' => 'FNE',
                // 'lead_no' => $request->id,
                'user_name' => auth()->user()->name,
                'user_id' => auth()->user()->id,
            ]);

            // return $request->zone;
            if($request->zone == 'Reject'){
                // return $request;
                $lead=  lead_sale::where('lead_reff',$request->id)->first();
                if($lead){
                    $lead->status = '1.15';
                    $lead->emirate_id = $request->emirate_id;
                    $lead->dob = $request->dob;
                    $lead->nationality = $request->nationality;
                    $lead->save();
                    //
                    \App\Models\remark::create([
                        'remarks' => 'Reject',
                        'lead_status' => '1.15',
                        'lead_id' => $lead->id,
                        'lead_no' => $lead->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                        'user_agent' => 'Sale',
                        'user_agent_id' => auth()->user()->id,
                    ]);
                }
            }
            else{
                $lead=  lead_sale::where('lead_reff',$request->id)->first();
                if($lead){
                    // $lead->status = $request->uniquestatus;
                    $lead->emirate_id = $request->emirate_id;
                    $lead->dob = $request->dob;
                    $lead->nationality = $request->nationality;
                    $lead->status = '1.09';
                    $lead->save();
                    //
                    \App\Models\remark::create([
                        'remarks' => $request->zone,
                        'lead_status' => '1.09',
                        'lead_id' => $lead->id,
                        'lead_no' => $lead->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                        'user_agent' => 'Sale',
                        'user_agent_id' => auth()->user()->id,
                    ]);
                }

            }
        }
        // $data = fne_data::create([
        //     'address' => $request->address,
        //     'building' => $request->building,
        //     'unit' => $request->unit,
        //     'google_location' => $request->google_location,
        //     'customer_number' => $request->customer_number,
        //     '5g_number' => $request->fiveg_number,
        //     'user_id' => auth()->user()->id,
        //     'is_status' => 'Pending',
        // ]);
        $data2 = user::select('email','teamleader')->where('id',$data->user_id)->first();

        // $ntc = lead_sale::select('call_centers.notify_email', 'users.secondary_email', 'users.agent_code', 'call_centers.numbers', 'users.teamleader')
        // ->Join(
        //     'users',
        //     'users.id',
        //     'lead_sales.saler_id'
        // )
        // ->Join(
        //     'call_centers',
        //     'call_centers.call_center_code',
        //     'users.agent_code'
        // )
        // ->where('lead_sales.id', $lead->id)->first();
        //
        $tl = User::where('id', $data2->teamleader)->first();
        if ($tl) {
            $wapnumber = '923121337222';

            // $wapnumber = $tl->phone .','. '923121337222,923211266201,923453598420';
        // } else {
            // $wapnumber = $ntc->numbers;
        }
        else{
            $wapnumber = '923121337222,923453598420';
        }

        $MyData = [
            'agent_name' => $data2->email,
            'id' => $data->id,
            'building' => $request->building,
            'is_status' => $request->is_status,
            'numbers'=> $wapnumber
        ];
        \App\Http\Controllers\FunctionController::WhatsAppFNERequestUpdate($MyData);
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);


    }
    //
    //
    public static function FNEDailYWhatsApp($details)
    {
        // return $details;
        $token = env('FACEBOOK_TOKEN');
        foreach (explode(',', $details['numbers']) as $nm) {

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
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "fne_update_daily",
                    "language": {
                        "code": "en_US"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "' . $details['date'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['pending'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['closed'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['available'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['not_available'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['commercial'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['short_fall'] . '"
                                },

                            ]
                        }
                    ]
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

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    //
    //
    public static function FNEDailYWhatsAppMaster($details)
    {
        // return $details;
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        foreach (explode(',', $details['numbers']) as $nm) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "fne_master_count",
                    "language": {
                        "code": "en_US"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "' . $details['date'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['all'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['pending'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['available_sp'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['not_rfs'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['invalid'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['closed'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['not_closed'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['tt_rfs'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['rejected'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['commercial'] . '"
                                },

                            ]
                        }
                    ]
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

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    //
    //
    public static function FNEMonthlyWhatsAppMaster($details)
    {
        // echo $details['all'] . '<br>';
        // echo $details['pending'] . '<br>';
        // echo $details['closed'] . '<br>';
        // echo $details['not_closed'] . '<br>';
        // echo $details['not_rfs'] . '<br>';
        // echo $details['commercial'] . '<br>';
        // echo $details['tt_rfs'] . '<br>';
        // echo $details['inprocess'] . '<br>';
        // echo $details['active'] . '<br>';
        // echo $details['all'] . '<br>';
        $token = env('FACEBOOK_TOKEN');
        // $token = 'EAAgQb8SiR8UBO7ImaPbHpm27fNFiuOqhxZBNZAvWbdKaZBRoGNgg8f6ywhhoQDR31jZB5yULCI5ZBHlnLdC9k0u4JoZCzw3j6zQpz4E0HYqm41sap6hDXgUBkTD7rdeC3MRbSzryTmECC3f66FCGRmYnWkEubRRjjGDXN8I8x1HVPMtW78QGhVMlb1';
        foreach (explode(',', $details['numbers']) as $nm) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "fne_master_count_monthly_final",
                    "language": {
                        "code": "en_US"
                    },
                    "components": [
                        {
                            "type": "body",
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "' . $details['date'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['all'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['pending'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['monthly_rfs'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['not_rfs'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['invalid'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['commercial'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['closed'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['not_closed'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['tt_rfs'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['rejected'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['new_five_jee'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['carry_available'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['carry_closed'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['carry_rejected'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['carry_tt_rfs'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['inprocess_carry'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['previous_five_jee'] . '"
                                },

                                {
                                    "type": "text",
                                    "text": "' . $details['active'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['inprocess'] . '"
                                },

                                {
                                    "type": "text",
                                    "text": "' . $details['pending_for_installation'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['pending_for_approval'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['e_mnp'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['same_month_closure'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['future_month_closure'] . '"
                                },
                                {
                                    "type": "text",
                                    "text": "' . $details['pending_from_customer'] . '"
                                }
                            ]
                        }
                    ]
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

        // return "zoom";
        // return back()->with('success', 'Add successfully.');
        // return redirect(route('add.dnc.number.agent'));
    }
    //
    public static function FNEDataCount($count){
        if($count == 'ALL'){
            return \App\Models\fne_number_bank::all()->count();

        }else{

            return \App\Models\fne_number_bank::where('lead_type',$count)->count();
        }
    }
    //
    public static function FNEDataCountTL($id,$count){
        // return $count;
        if($count == 'All'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_manager_assigners.manager_id',$id)
            ->get()->count();

        }
        else if($count == 'Assigned'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_manager_assigners.status','1')
            ->where('fne_data_manager_assigners.manager_id',$id)
            ->get()->count();

        }
        else if($count == 'Remaining'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->whereNull('fne_data_manager_assigners.status')
            ->where('fne_data_manager_assigners.manager_id',$id)
            ->get()->count();

        }
        else if($count == 'Used'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->whereNotNull('fne_data_user_assigners.status')
            ->where('fne_data_manager_assigners.manager_id',$id)
            ->get()->count();

        }
        else if($count == 'NotAns'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_user_assigners.status', 'No Answer')
            ->where('fne_data_manager_assigners.manager_id',$id)
            ->get()->count();

        }
        else if($count == 'NotCalled'){
            $notans = \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_user_assigners.status', 'No Answer')
            ->where('fne_data_manager_assigners.manager_id',$id)
            ->get()->count();
            $NotCalled = \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->whereNull('fne_data_user_assigners.status')
            ->where('fne_data_manager_assigners.manager_id',$id)
            ->get()->count();
            return $notans + $NotCalled;

        }
        else{

            return \App\Models\fne_number_bank::where('lead_type',$count)->count();
        }
    }
    //
    public static function FNEDataCountAgent($id,$count){
        // return $count;
        if($count == 'All'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_user_assigners.user_id',$id)
            ->whereMonth('fne_data_user_assigners.created_at', Carbon::now()->month)
            ->whereYear('fne_data_user_assigners.created_at', Carbon::now()->year)
            ->get()->count();

        }
        else if($count == 'Assigned'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_manager_assigners.status','1')
            ->where('fne_data_user_assigners.user_id',$id)
                ->whereMonth('fne_data_user_assigners.created_at', Carbon::now()->month)
                ->whereYear('fne_data_user_assigners.created_at', Carbon::now()->year)
            ->get()->count();

        }
        else if($count == 'Remaining'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->whereNull('fne_data_user_assigners.status')
            ->where('fne_data_user_assigners.user_id',$id)
                ->whereMonth('fne_data_user_assigners.created_at', Carbon::now()->month)
                ->whereYear('fne_data_user_assigners.created_at', Carbon::now()->year)
            ->get()->count();

        }
        else if($count == 'Used'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->whereNotNull('fne_data_user_assigners.status')
            ->where('fne_data_user_assigners.user_id',$id)
                ->whereMonth('fne_data_user_assigners.created_at', Carbon::now()->month)
                ->whereYear('fne_data_user_assigners.created_at', Carbon::now()->year)
            ->get()->count();

        }
        else if($count == 'NotAns'){
            return \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_user_assigners.status', 'No Answer')
            ->where('fne_data_user_assigners.user_id',$id)
                ->whereMonth('fne_data_user_assigners.created_at', Carbon::now()->month)
                ->whereYear('fne_data_user_assigners.created_at', Carbon::now()->year)
            ->get()->count();

        }
        else if($count == 'NotCalled'){
            $notans = \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->where('fne_data_user_assigners.status', 'No Answer')
            ->where('fne_data_user_assigners.user_id',$id)
                ->whereMonth('fne_data_user_assigners.created_at', Carbon::now()->month)
                ->whereYear('fne_data_user_assigners.created_at', Carbon::now()->year)
            ->get()->count();
            $NotCalled = \App\Models\fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_manager_assigners',
                'fne_data_manager_assigners.number_id','fne_number_banks.id'
            )
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id','fne_number_banks.id'
            )
            ->whereNull('fne_data_user_assigners.status')
            ->where('fne_data_user_assigners.user_id',$id)
                ->whereMonth('fne_data_user_assigners.created_at', Carbon::now()->month)
                ->whereYear('fne_data_user_assigners.created_at', Carbon::now()->year)
            ->get()->count();
            return $notans + $NotCalled;

        }
        else{

            return \App\Models\fne_number_bank::where('lead_type',$count)->count();
        }
    }
    //
    public function CheckLogInfo(Request $request){
        // return "Null";
        // return $request;

         $data2 = \App\Models\WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'whats_app_mnp_banks_1.cname')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
            // ->where
            ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('pcat', 'normal')
            ->where('whats_app_mnp_banks_1.number_id',$request->id)
            ->first();
            $num = $data2->number;
            // $num = '0501230579';

     $magicnumber = substr( $num, 0, 2 ) // Get the first two digits
     .str_repeat( '*', ( strlen( $num ) - 4 ) ) // Apply enough asterisks to cover the middle numbers
     .substr( $num, -2 ); // Get the last two digits
            return $data2->cname .'###' . $magicnumber;

        //   $data = \App\Models\fne_number_bank::where('system_id',$request->id)->first();
    }
    //
        public static function AyanCheckup($day,$status){

        $myrole = auth()->user()->role;
        // $status = $request->status;

      return  $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number', 'users.name', 'users.email', 'fne_datas.google_location','fne_datas.zone','fne_datas.created_at','fne_datas.updated_at','home_wifi_plans.name as plan')
        ->Join(
            'users',
            'users.id',
            'fne_datas.user_id'
        )
        ->LeftJoin(
            'home_wifi_plans','home_wifi_plans.id','fne_datas.plan'
        )
        // ->where('fne_datas.is_status',$request->status)
            ->when($status, function ($q) use ($status) {
                if ($status == 'ForClosing') {
                    $q->whereIn('fne_datas.is_status',['ShortFall','Available','RFS']);
                    // $q->where('fne_datas.user_id', auth()->user()->id);
                    // return $q->whereDate('lead_sales.updated_at', Carbon::today())
                    // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($status == 'Closed') {
                    $q->where('fne_datas.is_status','Closed');
                    // return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                    // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                }
            })
            // ->when($day, function ($q) use ($day) {
            //     if ($day == 'Daily') {
            //         return $q->whereDate('fne_datas.updated_at', Carbon::today())
            //             ->whereYear('fne_datas.updated_at', Carbon::now()->year);
            //         // return $q->where('numberdetails.identity', 'EidSpecial');
            //     } elseif ($day == 'Daily') {
            //         return $q->whereMonth('fne_datas.updated_at', Carbon::now()->month)
            //             ->whereYear('fne_datas.updated_at', Carbon::now()->year);
            //     }
            // })
        -> whereMonth('fne_datas.updated_at', Carbon::now()->month)

        // ->where('fne_datas.user_id',auth()->user()->id)
        // ->whereDate('fne_datas.updated_at', Carbon::today())
        // ->whereMonth('fne_datas.updated_at', Carbon::now()->month)
        // ->whereYear('fne_datas.updated_at', Carbon::now()->year)
        ->get()->count();

        // return json_encode($data);
        // return view('admin.lead.all-fne-lead', compact('data'));
    }
    //
    public static function RFSCheckup($day,$status){
        // return "ok";
        $myrole = auth()->user()->role;
        if($status == 'All'){
            return $data = fne_data::select('fne_datas.id', 'fne_datas.address', 'fne_datas.5g_number as fnumber', 'fne_datas.is_status', 'fne_datas.customer_number', 'users.name', 'users.email', 'fne_datas.google_location', 'fne_datas.zone', 'fne_datas.created_at', 'fne_datas.updated_at', 'home_wifi_plans.name as plan')
                ->Join(
                    'users',
                    'users.id',
                    'fne_datas.user_id'
                )
                ->LeftJoin(
                    'home_wifi_plans',
                    'home_wifi_plans.id',
                    'fne_datas.plan'
                )
                ->whereDate('fne_datas.updated_at', Carbon::today())
                ->whereMonth('fne_datas.updated_at', Carbon::now()->month)
                ->when($myrole, function ($q) use ($myrole) {
                    if ($myrole == 'Sale') {
                        $q->where('user_id', auth()->user()->id);
                        // return $q->whereDate('lead_sales.updated_at', Carbon::today())
                            // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($myrole == 'FNEMANAGER') {
                        // return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                            // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })

                // ->whereIn('fne_datas.is_status',['Available','Closed'])
                ->get()->count();

        }
        else{


        return $data = fne_data::select('id')

            // ->when($status, function ($query) use ($status) {
                    ->where('fne_datas.is_status', $status)

                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            // })
            ->when($day, function ($q) use ($day) {
                if ($day == 'Daily') {
                    return $q->whereDate('fne_datas.updated_at', Carbon::today())
                        ->whereYear('fne_datas.updated_at', Carbon::now()->year);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                elseif ($day == 'Monthly') {
                    return $q->whereMonth('fne_datas.updated_at', Carbon::now()->month)
                        ->whereYear('fne_datas.updated_at', Carbon::now()->year);
                }

            })
                ->when($myrole, function ($q) use ($myrole) {
                    if ($myrole == 'Sale') {
                        $q->where('fne_datas.user_id', auth()->user()->id);
                        // return $q->whereDate('lead_sales.updated_at', Carbon::today())
                        // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    } elseif ($myrole == 'FNEMANAGER') {
                        // return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                        // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    }
                })
            // ->where('fne_datas.user_id',auth()->user()->id)
            ->get()
            ->count();
        }
    }
    //
    //
    public static function HWCheckUp($day,$status){
        // return "ok";
        $myrole = auth()->user()->agent_code;
        return $data = lead_sale::select('lead_sales.id')
        // ->Join(
        //     'home_wifi_plans',
        //     'home_wifi_plans.id',
        //     'lead_sales.plans'
        // )
            // ->where('home_wifi_plans.lead_type', 'HomeWifi')
        ->when($status, function ($q) use ($status) {
            if ($status == 'reject') {
                $q->whereIn('lead_sales.status', ['1.05', '1.15']);
            } elseif ($status == 'inprocess') {
                $q->whereIn('lead_sales.status', ['1.10', '1.05', '1.07', '1.08']);
            } elseif ($status == 'pending') {
                $q->whereIn('lead_sales.status', ['1.01','1.12']);
            } elseif ($status == 'active') {
                $q->whereIn('lead_sales.status', ['1.02']);
            }
        })
            // ->whereIn('lead_sales.status', ['1.05', '1.08'])
            ->where('lead_sales.saler_id', auth()->user()->id)
            // ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
            // ->whereYear('lead_sales.updated_at', Carbon::now()->year)

            // ->whereDate('lead_sales.updated_at', Carbon::now()->subDays(2))
            ->get()
            ->count();


    }
    //
    //
    public static function HWPreCheckUp($day,$status){
        // return "ok";
        // return
        $myrole = auth()->user()->agent_code;
        return $data = lead_sale::select('lead_sales.id')
        // ->Join(
        //     'home_wifi_plans',
        //     'home_wifi_plans.id',
        //     'lead_sales.plans'
        // )
            // ->where('home_wifi_plans.lead_type', 'HomeWifi')
        ->when($status, function ($q) use ($status) {
            if ($status == 'reject') {
                $q->whereIn('lead_sales.status', ['1.05', '1.08']);
            } elseif ($status == 'inprocess') {
                $q->whereIn('lead_sales.status', ['1.10', '1.05', '1.07', '1.08']);
            }
            elseif ($status == 'PendingLeads') {
                $q->whereIn('lead_sales.status', ['1.01']);
            } elseif ($status == 'PendingVerificationHw') {
                $q->whereIn('lead_sales.status', ['1.12'])
                ->where('lead_sales.lead_type', 'HomeWifi');
            } elseif ($status == 'PendingVerificationPP') {
                $q->whereIn('lead_sales.status', ['1.01'])
                ->whereIn('lead_sales.lead_type', ['MNP', 'P2P']);
            }
            elseif ($status == 'ActiveLeadsAltID') {
                $q->whereIn('lead_sales.status', ['1.02'])
                ->where('lead_sales.id_type','New')
                ->where('lead_sales.lead_type', 'HomeWifi');

            }
            elseif ($status == 'ActiveLeadsSameID') {
                $q->whereIn('lead_sales.status', ['1.02'])
                    ->where('lead_sales.id_type', 'same_id')
                    ->where('lead_sales.lead_type', 'HomeWifi');
            }
            elseif ($status == 'BC01CancellationPending') {
                $q->whereIn('lead_sales.status', ['1.02'])
                    ->where('lead_sales.old_billing_cycle', 1)
                    ->where('lead_sales.cancel_status', 'Not Cancelled')
                    ->where('lead_sales.lead_type', 'HomeWifi');
            }
            elseif ($status == 'BC07CancellationPending') {
                $q->whereIn('lead_sales.status', ['1.02'])
                    ->where('lead_sales.old_billing_cycle', 7)
                    ->where('lead_sales.cancel_status', 'Not Cancelled')
                    ->where('lead_sales.lead_type', 'HomeWifi');
            }
            elseif ($status == 'BC17CancellationPending') {
                $q->whereIn('lead_sales.status', ['1.02'])
                    ->where('lead_sales.old_billing_cycle', 17)
                    ->where('lead_sales.cancel_status', 'Not Cancelled')
                    ->where('lead_sales.lead_type', 'HomeWifi');
            }
            elseif ($status == 'TotalActive') {
                $q->whereIn('lead_sales.status', ['1.02'])
                ->where('lead_sales.lead_type', 'HomeWifi');
                    // ->where('lead_sales.id_type', 'same_id');
            }
            elseif ($status == 'TotalActivePostpaid') {
                $q->whereIn('lead_sales.status', ['1.02'])
                ->whereIn('lead_sales.lead_type', ['P2P','MNP']);
                    // ->where('lead_sales.id_type', 'same_id');
            }
        })
            // ->whereIn('lead_sales.status', ['1.05', '1.08'])
            // ->where('lead_sales.saler_id', auth()->user()->id)
            // ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
            // ->whereYear('lead_sales.updated_at', Carbon::now()->year)

            // ->whereDate('lead_sales.updated_at', Carbon::now()->subDays(2))
            ->get()
            ->count();


    }
    //
    //
    public static function OtpVocusCode($details)
    {
        // dd($details);
        // Instantiate the WhatsAppCloudApi super class.
        //
        $token = env('FACEBOOK_TOKEN');
        // $details['']


        foreach (explode(',', $details['number']) as $nm) {


            //

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v14.0/414127678450960/messages',
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
                "to": "' . $nm . '",
                "type": "template",
                "template": {
                    "name": "otp_code_vocus",
                    "language": {
                    "code": "en"
                    },
                    "components": [
                    {
                        "type": "body",
                        "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['code'] . '"
                        }
                        ]
                    },
                    {
                        "type": "button",
                        "sub_type": "url",
                        "index": "0",
                        "parameters": [
                        {
                            "type": "text",
                            "text": "' . $details['code'] . '"
                        }
                        ]
                    }
                    ]
                }
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // dd($response);
            // echo $response;
        }
        //

    }
    //
    public function PlanChange(Request $request){
        // return $request;
        if($request->subcase == 'HomeWifi'){
            return $planwifi = \App\Models\HomeWifiPlan::select('id', 'name as plan_name')->where('status', '1')->whereIn('id', ['1', '2', '3','4'])->get();

        }
        else if($request->subcase == 'FNE'){
            return $planwifi = \App\Models\HomeWifiPlan::select('id', 'name as plan_name')->where('status', '1')->whereIn('id', ['5', '6', '7'])->get();

        }
        else{
            return $plan = \App\Models\plan::select('id','plan_name')->where('status',1)->get();
        }
    }
    //
    //
    public function PlanCheck(Request $request){
        // return $request;
        $leadid = $request->leadid;
        $lead = lead_sale::select('plans')->where('id',$leadid)->first();
        if($request->subcase == 'HomeWifi'){
             $plan = \App\Models\HomeWifiPlan::select('id', 'name as plan_name')->where('status', '1')->whereIn('id', ['1', '2', '3','4'])->get();
            return view('load_data.LoadPlan', compact('plan', 'lead'));

        }
        else if($request->subcase == 'FNE'){
             $plan = \App\Models\HomeWifiPlan::select('id', 'name as plan_name')->where('status', '1')->whereIn('id', ['5', '6', '7'])->get();
          return  view('load_data.LoadPlan', compact('plan', 'lead'));

        }
        else{
             $plan = \App\Models\plan::select('id','plan_name')->where('status',1)->get();
           return  view('load_data.LoadPlan', compact('plan', 'lead'));

        }
    }
    //
    public function UnMaskNumber(Request $request){
        if($request->eye == 1){

             $d = lead_sale::select('customer_number','short_code')->where('id',$request->id)->first();
             $m = \App\Models\WhatsAppMnpBank::select('number')->where('number_id',$d->short_code)->first();
             if($m){
                return $m->number;
             }else{
                return $d->customer_number;
             }
        }
        else{
            $d = lead_sale::select('customer_number')->where('id',$request->id)->first()->customer_number;
            return self::MaskMyNum($d);
        }
    }
}

// 0543102000
// 0543000240
// 0567600099
// 0505553365

// CRM Password..

// C6qz6
