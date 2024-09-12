<?php

namespace App\Http\Controllers;

use App\Models\lead_sale;
use App\Models\main_data_user_assigner;
use App\Models\product;
use App\Models\User;
use App\Models\WhatsAppScan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function removeLastThreeChars($str,$value)
    {
        return substr($str, 0, $value);
    }
    //
    public function AgentLoadData(Request $request){
        return view('load_data.agent-dashboard-data');
    }
    //
    public function ActivatorLoadData(Request $request){
        return view('load_data.activator-dashboard-data');
    }
    //
    //
    public function VerificationLoadData(Request $request){
        return view('load_data.verification-dashboard-data');
    }
    //
    //
    public function AdminLoadData(Request $request){
        return view('load_data.admin-dashboard-data');
    }
    //
    //
    public function CancellerLoadData(Request $request){
        return view('load_data.canceller-dashboard-data');
    }
    //
    //
    public function LeadLoadData(Request $request){
        $heading = $request->type;
        $status = $request->type;
        // return auth()->user()->id;
         $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no', 'lead_sales.created_at', 'lead_sales.updated_at', 'lead_sales.reff_id', 'lead_sales.work_order_num', 'users.name as agent_name', 'lead_sales.lead_type','lead_sales.status as status_code')
        // ->where('lead_sales.lead_type', '')
        ->LeftJoin(
            'home_wifi_plans',
            'home_wifi_plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'lead_sales.status'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->when($status, function ($q) use ($status) {
                if ($status == 'ActiveLeads') {
                    $q->where('lead_sales.status', '1.02');
                }
                elseif ($status == 'InProcessLead') {
                    $q->whereIn('lead_sales.status', ['1.10','1.05','1.07','1.08']);
                }
                elseif ($status == 'PendingLeads') {
                    $q->whereIn('lead_sales.status', ['1.01','1.12']);
                }
                elseif ($status == 'RejectLeads') {
                    $q->whereIn('lead_sales.status', ['1.15']);
                }
            })
            ->where('users.id',auth()->user()->id)
            // ->where('users.agent_code', auth()->user()->agent_code)
            ->get();
        return view('load_data.lead-data-load',compact('heading','data'));
    }
    //
    //
    public function ActivatorPreCheckData(Request $request){
        $heading = $request->type;
        $status = $request->type;
        // return auth()->user()->;
         $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'lead_sales.lead_no', 'lead_sales.created_at', 'lead_sales.updated_at', 'lead_sales.reff_id', 'lead_sales.work_order_num', 'users.name as agent_name', 'lead_sales.lead_type','lead_sales.status as status_code')
        // ->where('lead_sales.lead_type', '')
        // ->Join(
        //     'home_wifi_plans',
        //     'home_wifi_plans.id',
        //     'lead_sales.plans'
        // )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'lead_sales.status'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->when($status, function ($q) use ($status) {
                if ($status == 'ActiveLeads') {
                    $q->where('lead_sales.status', '1.02');
                }
                elseif ($status == 'TotalActivePostpaid') {
                    $q->where('lead_sales.status', '1.02')
                    ->whereIn('lead_sales.lead_type',['P2P','MNP']);
                }
                elseif ($status == 'TotalActive') {
                    $q->where('lead_sales.status', '1.02')
                    ->whereIn('lead_sales.lead_type',['HomeWifi']);
                }
                elseif ($status == 'ActiveLeadsSameID') {
                    $q->whereIn('lead_sales.status', ['1.02'])
                    ->where('lead_sales.id_type', 'same_id')
                    ->where('lead_sales.lead_type', 'HomeWifi');
                } elseif ($status == 'ActiveLeadsAltID') {
                $q->whereIn('lead_sales.status', ['1.02'])
                ->where('lead_sales.id_type', 'New')
                ->where('lead_sales.lead_type', 'HomeWifi');
            }
                elseif ($status == 'InProcessLead') {
                    $q->whereIn('lead_sales.status', ['1.10','1.05','1.07','1.08']);
                }
                elseif ($status == 'PendingLeads') {
                    $q->whereIn('lead_sales.status', ['1.01']);
                }
                elseif ($status == 'PendingVerificationHw') {
                    $q->whereIn('lead_sales.status', ['1.12'])
                    ->where('lead_sales.lead_type','HomeWifi');
                }
                elseif ($status == 'PendingVerificationPP') {
                    $q->whereIn('lead_sales.status', ['1.01'])
                    ->whereIn('lead_sales.lead_type', ['MNP','P2P']);
                }
                elseif ($status == 'RejectLeads') {
                    $q->whereIn('lead_sales.status', ['1.15']);
                }
            })
            // ->where('users.id',auth()->user()->id)
            // ->where('users.agent_code', auth()->user()->agent_code)
            ->get();
        return view('load_data.lead-data-load',compact('heading','data'));
    }
    //
    //
    public function CancellationDatas(Request $request){
        $heading = $request->type;
        $status = $request->type;
        // return auth()->user()->;
         $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'lead_sales.lead_no', 'lead_sales.created_at', 'lead_sales.updated_at', 'lead_sales.reff_id', 'lead_sales.work_order_num', 'users.name as agent_name', 'lead_sales.lead_type','lead_sales.status as status_code')
        // ->where('lead_sales.lead_type', '')
        // ->Join(
        //     'home_wifi_plans',
        //     'home_wifi_plans.id',
        //     'lead_sales.plans'
        // )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'lead_sales.status'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->when($status, function ($q) use ($status) {
                if ($status == 'BC01CancellationPending') {
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
            })
            // ->where('users.id',auth()->user()->id)
            // ->where('users.agent_code', auth()->user()->agent_code)
            ->get();
        return view('load_data.lead-data-load',compact('heading','data'));
    }
    //

    public function index(Request $request){
        // return auth()->user()->role;
        if(auth()->user()->role == 'Sale'){
            $heading = 'Agent Dashboard';
        }
        else{
            $heading = 'Admin Dashboard';
        }
        return view('dashboard.index',compact('heading'));
    }
    //
    public function test(){

        ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes

        $duplicates = \DB::table('whats_app_scans')
        ->select('wapnumber', 'start','id', \DB::raw('COUNT(*) as `count`'))
        ->groupBy('start')
        ->havingRaw('COUNT(*) > 1')
        ->limit(10000)
        ->get();

        foreach ($duplicates as $dd) {
            $dz = WhatsAppScan::where('id', $dd->id)->first();
            if ($dz) {
                $dz->delete();
            }
        }

        return "1";


        $numberstart = 971581000001;
        // $first_column = substr($numberstart, 3);
        // $second_column = DashboardController::removeLastThreeChars($first_column,'-7');
        // $third_column = substr($first_column, 3);
        // return $rand = crc32($numberstart);

        // $second_column = substr($first_column, 6);
        // $second_column =  DashboardController::replaceCharsInNumber($first_column, 'xxxxxxx'); //5069xxx

        // $first_column = substr_replace($numberstart,"",3,10);
        // return $second_column;
        //
        $numberstart = WhatsAppScan::orderBy('id', 'desc')->first();
        if (!$numberstart) {
            $numberstart = 971581000000;
        } else {
            $numberstart = $numberstart->wapnumber;
        }
        if ($numberstart === 971589999999 || $numberstart > 971589999999) {
            return "Game Over";
        }
        // $end = $numberstart + 5;
        $end = $numberstart + 1000000;
        // for ($v = $numberstart; $v <= '971583999999'; $v++) {
        for ($v = $numberstart; $v <= $end; $v++) {
            // for($i='971581000000';$i<= '971581001000';$i++){
            //     // return $i;
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
            // \Log::info($i);
            if (preg_match('/(.)\\1{6}/', $v)) {
                $data[] = [
                    'start' => crc32($v),
                    'end' => '0',
                    'wapnumber' => $v,
                    'count_digit' => 7,
                ];
            } elseif (preg_match('/(.)\\1{5}/', $v)) {
                // echo '###' . $i . '<br> => 5 Times Number';
                $data[] = [
                    'start' => crc32($v),
                    'end' => '0',
                    'wapnumber' => $v,
                    'count_digit' => 6,
                ];
            } elseif (preg_match('/(.)\\1{4}/', $v)) {
                // echo '###' . $i . '<br> => 5 Times Number';
                $data[] = [
                    'start' => crc32($v),
                    'end' => '0',
                    'wapnumber' => $v,
                    'count_digit' => 5,
                ];
            } else if (preg_match('/(.)\\1{3}/', $v)) {
                // echo '###' . $i . '<br> => 4 Times Number';
                $data[] = [
                    'start' => crc32($v),
                    'end' => '0',
                    'wapnumber' => $v,
                    'count_digit' => 4,
                ];
            } else if (preg_match('/(.)\\1{2}/', $v)) {
                // echo '###' . $i . '<br> => 3 Times Number';
                $data[] = [
                    'start' => crc32($v),
                    'end' => '0',
                    'wapnumber' => $v,
                    'count_digit' => 3,
                ];
            } else if (preg_match('/(.)\\1{1}/', $v)) {
                // echo '###' . $i . '<br> => 2 Times Number';
                $data[] = [
                    'start' => crc32($v),
                    'end' => '0',
                    'wapnumber' => $v,
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
                    'start' => crc32($v),
                    'end' => '0',
                    'wapnumber' => $v,
                    'count_digit' => 'random',
                ];
            }
        }
        $chunks = array_chunk($data, 5000);
        foreach ($chunks as $chunk) {
            WhatsAppScan::query()->insert($chunk);
        }

    }
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce(Request $request)
  {

        //
    //     if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {

    //         $region_name = $_SERVER["HTTP_CF_IPCOUNTRY"];
    //         $user_country = $_SERVER["HTTP_CF_IPCOUNTRY"];
    //         $ipaddress = $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    //         // $details = json_decode(file_get_contents("http://ipinfo.io/{$ipaddress}"));
    //         $details = $ipaddress;
    //     } else {
    //         $ipaddress =   $request->ip();
    //         $details = $ipaddress;

    //         // $details = json_decode(file_get_contents("http://ipinfo.io/{$ipaddress}"));
    //         // $user_country =   $details->country;
    //         // $region_name =   $details->region;
    //     }
    //     // return $ipaddress;
    // if($ipaddress == '182.184.111.191'){

    //     //
    //     $pageConfigs = ['pageHeader' => false];
    //     $product = product::where('status',1)->get();
    //     $verification = User::where('role','Verification')->get();
    //     return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs,'product' => $product,'verification' => $verification]);
    // }
    // else{
        // $data = [
        //     'name' => auth()->user()->name,
        //     'email' => auth()->user()->email,
        //     'call_center' => auth()->user()->call_center,
        //     'ip_address' => $ipaddress,
        // ];
        // \Mail::mailer('smtp')
        //     // ->to(['muhamin@etisalat.ae', 'oabdulla@etisalat.ae'])
        // ->to(['parhakooo@gmail.com'])
        // // ->to([''])
        // // ->cc(['salmanahmed334@gmail.com'])
        // // ->bcc(['isqintl@gmail.com','salmanahmed334@gmail.com'])
        // // ->from('crm.riuman.com','riuman')
        // ->send(new \App\Mail\CatchtheTheft($data));
        $pageConfigs = ['pageHeader' => false];
        $product = product::where('status',1)->get();
        $verification = User::where('role','Verification')->get();
        return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs,'product' => $product,'verification' => $verification]);
        // return "something wrong 500";
    // }
  }
  // Dashboard - Ecommerce
  public function FNEdashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];
    $product = product::where('status',1)->get();
    $verification = User::where('role','Verification')->get();
    return view('/content/dashboard/fne-dashboard', ['pageConfigs' => $pageConfigs,'product' => $product,'verification' => $verification]);
  }
}
