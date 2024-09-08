<?php

namespace App\Http\Controllers;

use App\Models\country_phone_code;
use App\Models\emirate;
use App\Models\lead_sale;
use App\Models\plan;
use App\Models\remark;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function BillingAttempt(Request $request){
        // return $request;
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Billing Attempt | Report"]
        ];
        // $cc = call_center::where('status', 1)->get();
        // $numberOfAgent = \App\Models\User::where('role', 'TeamLeader')->get();
        return view('admin.billing.attempt-card', compact('breadcrumbs'));
    }
    public function AttemptView(Request $request){
        // return $request;
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Billing Attempt | Report"]
        ];
        // $cc = call_center::where('status', 1)->get();
        // $numberOfAgent = \App\Models\User::where('role', 'TeamLeader')->get();
        return view('admin.billing.attempt-view', compact('breadcrumbs'));
    }
    //
    public function TodayBilling(Request $request){
        // $today = 'https://we.tl/t-TGc4EkX19p';
        // $today = Carbon::createFromFormat('d/m/Y H:i:s',  '19/02/2019 00:00:00');
        // $today = Carbon
        $dt = Carbon::now();
         $mdt = $dt->format('d');
         $dm =  str_replace('0', '', $mdt);
        //  $dm = 19;
        // return $dm;
         if($dm <= 7){
            // return "First Bill Date";
            $billing_cycle = 1;
        }
        else if($dm >= 7 && $dm <= 16){
             $billing_cycle = 7;
             // return "Second Bill Date";
            }else{
                $billing_cycle = 17;
                // return "third bill";
         }

        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Billing Lead Data"]
        ];
        // echo $dt->toDateString();
        // return $mdt;
       $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no', 'lead_sales.work_order_num','lead_sales.billing_cycle','lead_sales.contract_id','lead_sales.language','lead_sales.account_id')
        ->whereIn('lead_type', ['HomeWifi'])
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
            ->whereMonth('lead_sales.updated_at', Carbon::now()->submonth())
            ->where('lead_sales.billing_cycle',$billing_cycle)
            ->whereYear('lead_sales.updated_at', Carbon::now()->year)

            ->get();
        return view('admin.lead.all-billing-lead', compact('data', 'breadcrumbs'));

        // $data = lead_sale::where('status','1.02')->where('billing_cycle',$mdt)->get();
    }
    //
    public function checkbill(Request $request){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://myaccount.du.ae/servlet/ContentServer?pagename=MA_QuickPayRedirect&d=back&MSISDN=1.55799486&rechargeType=10&requestType=customerinfo&msisdnSource=1.55799486',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Access-Control-Allow-Origin:  *',
                'Cache-Control:  private',
                'Connection:  Keep-Alive',
                'Content-Encoding:  gzip',
                'Content-Type:  text/html; charset=UTF-8',
                'Date:  Tue, 07 Mar 2023 20:13:39 GMT',
                'device_type:  front',
                'HOST_SERVICE:  FutureTenseContentServer:11.1.1.8.0',
                'Keep-Alive:  timeout=5, max=115',
                'P3P:  CP="NON DSP COR CURa TIA"',
                'Server:  Apache',
                'Set-Cookie:  ADRUM_BTa="ENCAAAAAAWKfxU0xqdf4+O5SvXe7QV9FAgjXu6RbQZCxuNnybzbtZd7XBnPPqapVsnGIHB3vxvZULwgCS6FmtqybU9+UnC7OukvXP6ht82TuMW99ZvQnZ/ppieKOgCPda6dKujop7xcFxs4D51VR/8v9lRbaFyEd8LkZAm3oPQqPKY+T66HxXu26f4OrOfOdkHUQoDusA8="; Expires=Tue, 07-Mar-2023 20:14:10 GMT; Path=/; Secure; HttpOnly',
                'Set-Cookie:  SameSite="ENCAAAAAAXfSt6FNqZZZR5NM9+8gu6PWc0BVEmwPh7p6J6AXimYvoNH/JUhAqIrTUcQNskK8MM="; Expires=Tue, 07-Mar-2023 20:14:10 GMT; Path=/; Secure; HttpOnly',
                'Set-Cookie:  ADRUM_BT1="ENCAAAAAAVuEKsbJvLZt7HJBxjvM4vT0ATwpVn/MVx7Ujftg24y1oEulwBRdF+O8yh/6SDHVNvpPRBhSMRg0yJ8QSX5A0lp"; Expires=Tue, 07-Mar-2023 20:14:10 GMT; Path=/; Secure; HttpOnly',
                'Set-Cookie:  NSC_TFMGDBSF_TTM_443="ENCAAAAAAVahtIZo1CoNdLBJAVDs9wQYE6fz9p3mUG1JxYZyzrdcUmi68Q6HRYV/+92PpmTLBnYO+JQP21yejavK+Jxs1jzGvO3+RtU2sGA2MkWSb1kDU3jwodq66LXxNAQBNDPlQaCegM8OAJSTlTbd+bOIhPt"; Expires=Tue, 07-Mar-2023 20:15:40 GMT; Path=/; Secure; HttpOnly',
                'Vary:  Accept-Encoding,User-Agent',
                'WWW-Authenticate:  Basic realm="CT"',
                'X-Content-Type-Options:  nosniff',
                'X-Frame-Options:  SAMEORIGIN',
                'x-frame-options:  SAMEORIGIN',
                'X-Permitted-Cross-Domain-Policies:  none',
                'X-XSS-Protection:  1; mode=block'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

    }
    //
    public function billing_cycle_view(Request $request)
    {
        // $role =
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no', 'lead_sales.emirate_id', 'lead_sales.nationality', 'lead_sales.dob', 'lead_sales.emirate_expiry', 'lead_sales.emirate', 'lead_sales.additional_docs_name', 'lead_sales.front_id', 'lead_sales.back_id', 'lead_sales.lead_type', 'lead_sales.reff_id as work_order_num', 'lead_sales.work_order_num as reff_id','lead_sales.contract_id','lead_sales.billing_cycle','lead_sales.account_id')
            ->whereIn('lead_type', ['HomeWifi'])
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
            ->where('lead_sales.status', '1.02')
            ->where('lead_sales.id', $request->id)
            ->first();
        if (empty($data)) {
            // return "EM";
            // return redirect(route('home'));
        }
        $plan = plan::where('status', '1')->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "Activate Lead HW"]
        ];
        $remarks = remark::where('lead_no', $request->id)->get();

        return view('admin.lead.bill-lead-hw', compact('data', 'plan', 'country', 'emirate', 'breadcrumbs', 'remarks'));
    }
    //
}
