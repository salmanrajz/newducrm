<?php

namespace App\Http\Controllers;

use App\Models\audio_recording;
use App\Models\country_phone_code;
use App\Models\emirate;
use App\Models\HomeWifiPlan;
use App\Models\lead_sale;
use App\Models\plan;
use App\Models\fne_data;
use App\Models\remark;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LeadController extends Controller
{
    //
    public function ViewWifiLead(Request $request){
        $role = auth()->user()->role;

        if (auth()->user()->role == 'Verification') {
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.language','lead_sales.created_at','lead_sales.language')
        ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Verification') {
                    return $q->whereIn('lead_sales.status', ['1.12']);
                }
            })
        ->orderBy('lead_sales.id','asc')
        ->get();
        $mnp = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no','lead_sales.lead_type')
        ->whereIn('lead_sales.lead_type', ['MNP','P2P','New'])
        // ->where('lead_sales.lead_type','HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Verification') {
                return $q->whereIn('lead_sales.status', ['1.01']);
                }
            })
        ->get();

            // return json_encode($data);
            return view('admin.lead.view-verification-lead', compact('data', 'mnp'));
        }else{
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.created_at','lead_sales.updated_at','lead_sales.reff_id','lead_sales.work_order_num', 'lead_sales.language')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Verification') {
                    return $q->where('lead_sales.status', '1.01');
                }
            })
                ->get();
        return view('admin.lead.view-wifi-lead', compact('data'));

        }

    }
    //
    //
    public function ViewWapPending(Request $request){
        $role = auth()->user()->role;


            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.created_at','lead_sales.updated_at','lead_sales.reff_id','lead_sales.work_order_num', 'lead_sales.language')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id)
                        ->where('lead_sales.status', '1.22');
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Verification') {
                    return $q->where('lead_sales.status', '1.22');
                }
            })
                ->get();
        return view('admin.lead.view-wifi-lead', compact('data'));


    }
    //
    //
    public function MyWifiLeadsDaily(Request $request){
            $role = auth()->user()->role;
            $status = $request->status;
            if($status == 'escalation'){

                 $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.created_at','lead_sales.updated_at','lead_sales.reff_id','lead_sales.work_order_num', 'lead_sales.language')
                ->where('lead_sales.lead_type', 'HomeWifi')
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
                ->where('home_wifi_plans.lead_type', 'HomeWifi')

                ->when($role, function ($q) use ($role) {
                    if ($role == 'Sale') {
                        return $q->where('lead_sales.saler_id', auth()->user()->id);
                        // return $q->where('numberdetails.identity', 'EidSpecial');
                    }
                })
                ->whereIn('lead_sales.status', ['1.05', '1.08'])

                ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                ->whereDate('lead_sales.updated_at', Carbon::now()->subDays(2))
                ->get();
            }
            else{


            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.created_at','lead_sales.updated_at','lead_sales.reff_id','lead_sales.work_order_num', 'lead_sales.language')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->where('home_wifi_plans.lead_type', 'HomeWifi')

            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
            })
            ->when($status, function ($q) use ($status) {
                if ($status == 'inprocess') {
                    return $q->whereIn('lead_sales.status', ['1.01','1.05','1.08']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                elseif ($status == 'active') {
                    return $q->whereIn('lead_sales.status', ['1.02']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                elseif ($status == 'reject') {
                    return $q->whereIn('lead_sales.status', ['1.15']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }

            })
            ->whereDate('lead_sales.updated_at', Carbon::today())
            ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
            ->get();
        }

        return view('admin.lead.view-wifi-lead', compact('data'));



    }
    //
    //
    //
    public function MyWifiLeadsMonthly(Request $request){
        $role = auth()->user()->role;
        $status = $request->status;


            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.created_at','lead_sales.updated_at','lead_sales.reff_id','lead_sales.work_order_num', 'lead_sales.language')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->where('home_wifi_plans.lead_type', 'HomeWifi')

            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
            })
            ->when($status, function ($q) use ($status) {
                if ($status == 'inprocess') {
                    return $q->whereIn('lead_sales.status', ['1.01','1.05','1.08']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                elseif ($status == 'active') {
                    return $q->whereIn('lead_sales.status', ['1.02']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                elseif ($status == 'reject') {
                    return $q->whereIn('lead_sales.status', ['1.15']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }

            })
            ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
            ->whereYear('lead_sales.updated_at', Carbon::now()->year)

                ->get();
        return view('admin.lead.view-wifi-lead', compact('data'));



    }
    //
    //
    public function MyWifiCarry(Request $request){
        $role = auth()->user()->role;
        $status = $request->status;


            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.created_at','lead_sales.updated_at','lead_sales.reff_id','lead_sales.work_order_num', 'lead_sales.language')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->where('home_wifi_plans.lead_type', 'HomeWifi')


                ->where('lead_sales.saler_id', auth()->user()->id)
                    // return $q->where('numberdetails.identity', 'EidSpecial');
            ->whereIn('lead_sales.status', ['1.01','1.05','1.08'])
            ->whereMonth('lead_sales.updated_at', Carbon::now()->submonth(1))
            ->whereYear('lead_sales.updated_at', Carbon::now()->year)

                ->get();
        return view('admin.lead.view-wifi-lead', compact('data'));



    }
    //
    //
    public function ViewWifiLeadManager(Request $request){
        $role = auth()->user()->role;

        if (auth()->user()->role == 'TeamLeader') {
            return "0";
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no', 'lead_sales.created_at', 'lead_sales.updated_at', 'lead_sales.reff_id', 'lead_sales.work_order_num','users.name as agent_name')
                ->where('lead_sales.lead_type', 'HomeWifi')
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
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->where('users.agent_code', auth()->user()->agent_code)
                ->where('users.teamleader', auth()->user()->id)
                ->get();
            return view('admin.lead.view-wifi-lead-manager', compact('data'));
        }else{
            // return "0";
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.created_at','lead_sales.updated_at','lead_sales.reff_id','lead_sales.work_order_num','users.name as agent_name')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->where('users.agent_code', auth()->user()->agent_code)
            ->get();
        return view('admin.lead.view-wifi-lead-manager', compact('data'));

        }

    }
    //
    public function ViewInProcessLead(Request $request){
        $role = auth()->user()->role;

        if (auth()->user()->role == 'Activator') {
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.emirate','lead_sales.language','lead_sales.created_at')
        ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Activator') {
                    return $q->whereIn('lead_sales.status', ['1.05','1.22']);
                }
            })
        ->get();
        $mnp = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no','lead_sales.lead_type')
        ->whereIn('lead_type', ['MNP','P2P'])
        // ->where('lead_sales.lead_type','HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Activator') {
                    return $q->where('lead_sales.status', '1.05');
                }
            })
        ->get();

            // return json_encode($data);
            return view('admin.lead.view-verification-lead', compact('data', 'mnp'));
        }else{
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Verification') {
                    return $q->where('lead_sales.status', '1.01');
                }
            })
                ->get();
        return view('admin.lead.view-wifi-lead', compact('data'));

        }

    }
    //
    public function ViewPreCheckLead(Request $request){
        $role = auth()->user()->role;

        if (auth()->user()->role == 'Activator' || auth()->user()->role == 'FNEMANAGER') {
            // return "ok";
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.emirate','lead_sales.language','lead_sales.created_at')
        ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Activator' || $role == 'FNEMANAGER') {
                    return $q->where('lead_sales.status', '1.01');
                }
            })
        ->get();
        $mnp = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no','lead_sales.lead_type')
        ->whereIn('lead_type', ['MNP','P2P'])
        // ->where('lead_sales.lead_type','HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Activator' || $role == 'FNEMANAGER') {
                    return $q->where('lead_sales.status', '1.05');
                }
            })
        ->get();

            // return json_encode($data);
            return view('admin.lead.view-precheck-lead', compact('data', 'mnp'));
        }else{
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Verification') {
                    return $q->where('lead_sales.status', '1.01');
                }
            })
                ->get();
        return view('admin.lead.view-wifi-lead', compact('data'));

        }

    }
    //
    //
    public function ViewPendingApprovalLeads(Request $request){
        $role = auth()->user()->role;

        if (auth()->user()->role == 'Activator') {
        $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no','lead_sales.emirate','lead_sales.language','lead_sales.created_at')
        ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Activator') {
                    return $q->where('lead_sales.status', '1.21');
                }
            })
        ->get();
        $mnp = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no','lead_sales.lead_type')
        ->whereIn('lead_type', ['MNP','P2P'])
        // ->where('lead_sales.lead_type','HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Activator') {
                    return $q->where('lead_sales.status', '1.05');
                }
            })
        ->get();

            // return json_encode($data);
            return view('admin.lead.view-verification-lead', compact('data', 'mnp'));
        }else{
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'home_wifi_plans.name as plan_name', 'lead_sales.lead_no')
            ->where('lead_sales.lead_type', 'HomeWifi')
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
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id', auth()->user()->id);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($role == 'Verification') {
                    return $q->where('lead_sales.status', '1.01');
                }
            })
                ->get();
        return view('admin.lead.view-wifi-lead', compact('data'));

        }

    }
    //
    public function myfne(Request $request){

        $role = auth()->user()->role;

        $data = fne_data::select('fne_datas.id', 'fne_datas.address', 'fne_datas.5g_number as fnumber', 'fne_datas.is_status', 'fne_datas.customer_number', 'users.name', 'users.email','home_wifi_plans.name as plan')
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

        ->where('user_id',auth()->user()->id)
        ->get();

        // return json_encode($data);
        return view('admin.lead.view-fne-lead', compact('data'));
    }
    //
    public function ourfne(Request $request){

        $role = auth()->user()->role;

        $data = fne_data::select('fne_datas.id', 'fne_datas.address', 'fne_datas.5g_number as fnumber', 'fne_datas.is_status', 'fne_datas.customer_number', 'users.name', 'users.email')
        ->Join(
            'users',
            'users.id',
            'fne_datas.user_id'
        )
        ->where('teamleader',auth()->user()->id)
        ->get();

        // return json_encode($data);
        return view('admin.lead.view-fne-lead', compact('data'));
    }
    //
    //
    public function allfne(Request $request){

        $role = auth()->user()->role;

        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number', 'users.name', 'users.email', 'fne_datas.google_location','fne_datas.zone','fne_datas.created_at','fne_datas.updated_at','home_wifi_plans.name as plan','fne_datas.building','fne_datas.unit', 'fne_datas.customer_name','fne_datas.expiry')
        ->Join(
            'users',
            'users.id',
            'fne_datas.user_id'
        )
        ->LeftJoin(
            'home_wifi_plans','home_wifi_plans.id','fne_datas.plan'
        )
        // ->whereIn('fne_datas.is_status',['Available','Closed'])
        // ->where('user_id',auth()->user()->id)
        ->OrderBy('fne_datas.id','desc')
        ->get();

        // return json_encode($data);
        return view('admin.lead.all-fne-lead', compact('data'));
    }
    //
    //
    public function myallfne(Request $request){

        $role = auth()->user()->role;

        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number', 'users.name', 'users.email', 'fne_datas.google_location','fne_datas.zone','fne_datas.created_at','fne_datas.updated_at','home_wifi_plans.name as plan')
        ->Join(
            'users',
            'users.id',
            'fne_datas.user_id'
        )
        ->LeftJoin(
            'home_wifi_plans','home_wifi_plans.id','fne_datas.plan'
        )
        ->whereDate('fne_datas.updated_at', Carbon::today())
        ->whereMonth('fne_datas.updated_at', Carbon::now()->month)
        // ->whereIn('fne_datas.is_status',['Available','Closed'])
        ->where('user_id',auth()->user()->id)
        ->get();

        // return json_encode($data);
        return view('admin.lead.all-fne-lead', compact('data'));
    }
    //
    //
    public function myfnestatus(Request $request){

        $myrole = auth()->user()->role;

        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number', 'users.name', 'users.email', 'fne_datas.google_location','fne_datas.zone','fne_datas.created_at','fne_datas.updated_at','home_wifi_plans.name as plan')
        ->Join(
            'users',
            'users.id',
            'fne_datas.user_id'
        )
        ->LeftJoin(
            'home_wifi_plans','home_wifi_plans.id','fne_datas.plan'
        )
        ->where('fne_datas.is_status',$request->status)
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
        ->whereDate('fne_datas.updated_at', Carbon::today())
        ->whereMonth('fne_datas.updated_at', Carbon::now()->month)
        // ->whereYear('fne_datas.updated_at', Carbon::now()->year)
        ->get();

        // return json_encode($data);
        return view('admin.lead.all-fne-lead', compact('data'));
    }
    //
    //
    public function ayanlead(Request $request){

        $myrole = auth()->user()->role;
        $status = $request->status;

        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number', 'users.name', 'users.email', 'fne_datas.google_location','fne_datas.zone','fne_datas.created_at','fne_datas.updated_at','home_wifi_plans.name as plan')
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
                if ($status == 'pending') {
                    $q->whereIn('fne_datas.is_status',['ShortFall','Available','RFS'])
                        ->whereNot('fne_datas.zone','Closed');
                        // ->orWhereNull('fne_datas.zone');

                    // $q->where('fne_datas.user_id', auth()->user()->id);
                    // return $q->whereDate('lead_sales.updated_at', Carbon::today())
                    // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                } elseif ($status == 'closed') {
                    // $q->where('fne_datas.is_status','Closed')
                $q->where('fne_datas.zone', 'Closed');
                    // return $q->whereMonth('lead_sales.updated_at', Carbon::now()->month)
                    // ->whereYear('lead_sales.updated_at', Carbon::now()->year);
                }
            })
        // ->where('fne_datas.user_id',auth()->user()->id)
        // ->whereDate('fne_datas.updated_at', Carbon::today())
        ->whereMonth('fne_datas.updated_at', Carbon::now()->month)
        ->orderBy('id','desc')
        // ->whereYear('fne_datas.updated_at', Carbon::now()->year)
        ->get();

        // return json_encode($data);
        return view('admin.lead.ayan-fne-lead', compact('data'));
    }
    //
    //
    public function monthlyfnestatus(Request $request){

        $myrole = auth()->user()->role;

        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number', 'users.name', 'users.email', 'fne_datas.google_location','fne_datas.zone','fne_datas.created_at','fne_datas.updated_at','home_wifi_plans.name as plan')
        ->Join(
            'users',
            'users.id',
            'fne_datas.user_id'
        )
        ->LeftJoin(
            'home_wifi_plans','home_wifi_plans.id','fne_datas.plan'
        )
        ->where('fne_datas.is_status',$request->status)
            // ->where('fne_datas.user_id',auth()->user()->id)
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
        ->whereMonth('fne_datas.updated_at', Carbon::now()->month)
        ->whereYear('fne_datas.updated_at', Carbon::now()->year)
        ->get();

        // return json_encode($data);
        return view('admin.lead.all-fne-lead', compact('data'));
    }
    //
    //
    public function fne_status(Request $request)
    {
        // return $request;
        // $plan = Plan::where('status', '1')->get();
        // $country = country_phone_code::select('name')->get();
        // $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        //
        $role = auth()->user()->role;
        if($role == 'Sale'){

        }
        else{


        //
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New FNE Request"]
        ];
            $country = country_phone_code::select('name')->get();

        // $type = 'Vocus';
        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number','fne_datas.building','fne_datas.unit','users.name','users.email', 'fne_datas.google_location', 'fne_datas.customer_name', 'fne_datas.plan', 'fne_datas.giad','fne_datas.zone','fne_datas.expiry','fne_datas.tt_number','fne_datas.project_type','lead_sales.emirate_id','lead_sales.dob','lead_sales.nationality','fne_datas.lat','fne_datas.lng','fne_datas.account_id')
            ->Join(
                'users',
                'users.id',
                'fne_datas.user_id'
            )
            ->LeftJoin(
                'lead_sales','lead_sales.lead_reff','fne_datas.id'
            )
        ->where('fne_datas.id',$request->id)
        ->first();
        }
        $planwifi = HomeWifiPlan::where('status', '1')->whereIn('id',['5','6','7'])->get();


        $remarks = \App\Models\remarks_fne::where('lead_id', $request->id)->get();


        // $data = fne_data::findorfail($request->id);
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.edit-fne-request', compact('breadcrumbs','data', 'remarks','planwifi','country'));
    }
    //
    //
    public function ayan_fne_status(Request $request)
    {
        // return $request;
        // $plan = Plan::where('status', '1')->get();
        // $country = country_phone_code::select('name')->get();
        // $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        //
        $role = auth()->user()->role;
        if($role == 'Sale'){

        }
        else{


        //
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New FNE Request"]
        ];
            $country = country_phone_code::select('name')->get();

        // $type = 'Vocus';
        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number','fne_datas.building','fne_datas.unit','users.name','users.email', 'fne_datas.google_location', 'fne_datas.customer_name', 'fne_datas.plan', 'fne_datas.giad','fne_datas.zone','fne_datas.expiry','fne_datas.tt_number','fne_datas.project_type','lead_sales.emirate_id','lead_sales.dob','lead_sales.nationality','fne_datas.lat','fne_datas.lng','fne_datas.account_id')
            ->Join(
                'users',
                'users.id',
                'fne_datas.user_id'
            )
            ->LeftJoin(
                'lead_sales','lead_sales.lead_reff','fne_datas.id'
            )
        ->where('fne_datas.id',$request->id)
        ->first();
        }
        $planwifi = HomeWifiPlan::where('status', '1')->whereIn('id',['5','6','7'])->get();


        $remarks = \App\Models\remarks_fne::where('lead_id', $request->id)->get();


        // $data = fne_data::findorfail($request->id);
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.ayan-fne-request', compact('breadcrumbs','data', 'remarks','planwifi','country'));
    }
    //
    //
    public function return_fne(Request $request)
    {
        // return $request;
        // $plan = Plan::where('status', '1')->get();
        // $country = country_phone_code::select('name')->get();
        // $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        //
        $role = auth()->user()->role;
        if($role == 'Sale'){

        }
        else{


        //
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New FNE Request"]
        ];
            $country = country_phone_code::select('name')->get();

        // $type = 'Vocus';
        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        $data = fne_data::select('fne_datas.id as fne_id','lead_sales.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number','fne_datas.building','fne_datas.unit','users.name','users.email', 'fne_datas.google_location', 'fne_datas.customer_name', 'fne_datas.plan', 'fne_datas.giad','fne_datas.zone','fne_datas.expiry','fne_datas.tt_number','fne_datas.project_type','lead_sales.emirate_id','lead_sales.dob','lead_sales.nationality','fne_datas.lat','fne_datas.lng','fne_datas.account_id','lead_sales.fne_work_order_num', 'lead_sales.fne_activity_number', 'lead_sales.fne_visit_date', 'lead_sales.activity_date', 'lead_sales.work_order_date')
            ->Join(
                'users',
                'users.id',
                'fne_datas.user_id'
            )
            ->LeftJoin(
                'lead_sales','lead_sales.lead_reff','fne_datas.id'
            )
        ->where('fne_datas.id',$request->id)
        ->first();
        }
        $planwifi = HomeWifiPlan::where('status', '1')->whereIn('id',['5','6','7'])->get();


        $remarks = \App\Models\remarks_fne::where('lead_id', $request->id)->get();


        // $data = fne_data::findorfail($request->id);
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.return-fne', compact('breadcrumbs','data', 'remarks','planwifi','country'));
    }
    //
    //
    public function add_work_order(Request $request)
    {
        // return $request;
        // $plan = Plan::where('status', '1')->get();
        // $country = country_phone_code::select('name')->get();
        // $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        //
        $role = auth()->user()->role;
        if($role == 'Sale'){

        }
        else{


        //
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New FNE Request"]
        ];
            $country = country_phone_code::select('name')->get();

        // $type = 'Vocus';
        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        $data = fne_data::select('fne_datas.id as fne_id','lead_sales.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number','fne_datas.building','fne_datas.unit','users.name','users.email', 'fne_datas.google_location', 'fne_datas.customer_name', 'fne_datas.plan', 'fne_datas.giad','fne_datas.zone','fne_datas.expiry','fne_datas.tt_number','fne_datas.project_type','lead_sales.emirate_id','lead_sales.dob','lead_sales.nationality','fne_datas.lat','fne_datas.lng','fne_datas.account_id','lead_sales.fne_work_order_num', 'lead_sales.fne_activity_number', 'lead_sales.fne_visit_date', 'lead_sales.activity_date', 'lead_sales.work_order_date')
            ->Join(
                'users',
                'users.id',
                'fne_datas.user_id'
            )
            ->LeftJoin(
                'lead_sales','lead_sales.lead_reff','fne_datas.id'
            )
        ->where('fne_datas.id',$request->id)
        ->first();
        }
        $planwifi = HomeWifiPlan::where('status', '1')->whereIn('id',['5','6','7'])->get();


        $remarks = \App\Models\remarks_fne::where('lead_id', $request->id)->get();


        // $data = fne_data::findorfail($request->id);
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.add-work-order', compact('breadcrumbs','data', 'remarks','planwifi','country'));
    }
    //
    public function update_work_order(Request $request){
        // return $request->id;
        $validatedData = Validator::make($request->all(), [
            'fne_activity_number' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $data = lead_sale::findorfail($request->id);
        $data->fne_work_order_num = $request->fne_work_order_num;
        $data->work_order_date = $request->work_order_date;
        $data->activity_date = $request->activity_date;
        $data->fne_activity_number = $request->fne_activity_number;
        $data->fne_visit_date = $request->fne_visit_date;
        $data->status = '1.08';
        $data->save();

         $dam = lead_sale::select('lead_sales.customer_name','lead_sales.customer_number','lead_sales.fne_activity_number', 'lead_sales.activity_date','lead_sales.fne_work_order_num','lead_sales.work_order_date','fne_visit_date', 'home_wifi_plans.name as plan_name','lead_sales.lead_no',
            'call_centers.numbers',
            'users.phone','users.teamleader'
        )
        ->Join(
            'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
            'call_centers',
            'call_centers.call_center_code',
            'users.agent_code'
        )
        ->where('lead_sales.id',$request->id)->first();

        // $ntc = lead_sale::select('call_centers.notify_email', 'users.secondary_email', 'users.agent_code', 'call_centers.numbers', 'users.teamleader', 'users.phone')
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
        // //
        $tl = User::select('phone')->where('id', $dam->teamleader)->first();
            if ($tl) {
            $wapnumber = '923121337222';

                // $wapnumber = $tl->phone . ',' .  $dam->numbers . ',' . $dam->phone;
                // $wapnumber = $tl->phone . ',' .  $ntc->numbers;
            } else {
                $wapnumber = $dam->numbers;
            }
        $MyData = [
            'lead_no' => $dam->lead_no,
            'customer_name' => $dam->customer_name,
            'customer_number' => $dam->customer_number,
            'plan' => $dam->plan_name,
            'activity' => $dam->fne_activity_number,
            'activity_date' => $dam->activity_date,
            'work_order' => $dam->fne_work_order_num,
            'work_order_date' => $dam->work_order_date,
            'visit_date' => $dam->fne_visit_date,
            'numbers' => '923121337222,923453598420' . ','. $wapnumber,
        ];
        // return $MyData;
        // return response()->json(['error' => ['Documents' => [$fnde->id]]], 200);
         \App\Http\Controllers\FunctionController::WhatsAppFNERequestWorkOrder($MyData);
        return "1";

    }
    //
    //
    public function update_return_fne(Request $request){
        // return $request->id;
        $validatedData = Validator::make($request->all(), [
            'return_remarks' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        $data = lead_sale::findorfail($request->id);
        // $data->fne_work_order_num = $request->fne_work_order_num;
        // $data->work_order_date = $request->work_order_date;
        // $data->activity_date = $request->activity_date;
        // $data->fne_activity_number = $request->fne_activity_number;
        // $data->fne_visit_date = $request->fne_visit_date;
        $data->status = '1.04';
        $data->save();

         $dam = lead_sale::select('lead_sales.customer_name','lead_sales.customer_number','lead_sales.fne_activity_number', 'lead_sales.activity_date','lead_sales.fne_work_order_num','lead_sales.work_order_date','fne_visit_date', 'home_wifi_plans.name as plan_name','lead_sales.lead_no',
            'call_centers.numbers',
            'users.phone','users.teamleader','lead_sales.saler_id as user_id','lead_sales.id'
        )
        ->Join(
            'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
            'call_centers',
            'call_centers.call_center_code',
            'users.agent_code'
        )
        ->where('lead_sales.id',$request->id)->first();

        // $ntc = lead_sale::select('call_centers.notify_email', 'users.secondary_email', 'users.agent_code', 'call_centers.numbers', 'users.teamleader', 'users.phone')
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
        // //
        $tl = User::select('phone')->where('id', $dam->teamleader)->first();
            if ($tl) {
            // $wapnumber = '923121337222';

                $wapnumber = $tl->phone . ',' .  $dam->numbers . ',' . $dam->phone;
                // $wapnumber = $tl->phone . ',' .  $ntc->numbers;
            } else {
                $wapnumber = $dam->numbers;
            }

        $data2 = user::select('email', 'teamleader', 'phone as agent_phone')->where('id', $dam->user_id)->first();

        $MyData = [
            'agent_name' => $data2->email,
            'id' => $dam->id,
            'building' => 'FNE BUILDING',
            'is_status' => $request->return_remarks,
            'numbers' => $wapnumber,
            'customer_name' => $dam->customer_name,
        ];
        // return $MyData;
        \App\Http\Controllers\FunctionController::WhatsAppFNERequestUpdate($MyData);
        //
        return "1";

    }
    //
    public function agent_fne_status(Request $request)
    {
        // return $request;
        // $plan = Plan::where('status', '1')->get();
        // $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New FNE Request"]
        ];
        // $type = 'Vocus';
        // $ptype = 'HomeWifi';
        // $last = lead_sale::latest()->first();
        $data = fne_data::select('fne_datas.id','fne_datas.address','fne_datas.5g_number as fnumber','fne_datas.is_status','fne_datas.customer_number','fne_datas.building','fne_datas.unit','users.name','users.email', 'fne_datas.google_location')
            ->Join(
                'users',
                'users.id',
                'fne_datas.user_id'
            )
        ->where('fne_datas.id',$request->id)
        ->first();
        $remarks = \App\Models\remarks_fne::where('lead_id', $request->id)->get();


        // $data = fne_data::findorfail($request->id);
        // $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.candidate.view-fne-request', compact('breadcrumbs','data', 'remarks'));
    }
    //
    //
    public function ViewMNPLead(Request $request){
        $role = auth()->user()->role;

        $data = lead_sale::select('lead_sales.customer_name','lead_sales.id','lead_sales.email','lead_sales.customer_number','status_codes.status_name as status', 'plans.plan_name','lead_sales.lead_no','lead_sales.lead_type','status_codes.status_name as status_name','lead_sales.status','lead_sales.updated_at','lead_sales.created_at')
        ->Join(
            'plans',
            'plans.id','lead_sales.plans'
        )
        ->Join(
            'status_codes',
            'status_codes.status_code','lead_sales.status'
        )
            ->when($role, function ($q) use ($role) {
                if ($role == 'Sale') {
                    return $q->where('lead_sales.saler_id',auth()->user()->id)
                            ->whereIn('lead_sales.lead_type',['MNP','P2P','New']);
                    // return $q->where('numberdetails.identity', 'EidSpecial');
                }
                elseif($role == 'Verification'){
                    return $q->where('lead_sales.status', '1.01');
                }
            })
        ->get();

        // return json_encode($data);
        return view('admin.lead.view-postpaid-lead',compact('data'));
    }
    //
    public function ViewMNPLeadManager(Request $request){
        $role = auth()->user()->role;

       if($role == 'TeamLeader'){
        return "0";
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no', 'lead_sales.lead_type', 'status_codes.status_name as status_name', 'lead_sales.status', 'lead_sales.updated_at', 'lead_sales.created_at','users.name as agent_name')
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
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )

                ->where('users.teamleader', auth()->user()->id)
                ->where('users.agent_code', auth()->user()->agent_code)
                ->get();

            // return json_encode($data);
            return view('admin.lead.view-postpaid-lead-manager', compact('data'));
       }else{
            $data = lead_sale::select('lead_sales.customer_name', 'lead_sales.id', 'lead_sales.email', 'lead_sales.customer_number', 'status_codes.status_name as status', 'plans.plan_name', 'lead_sales.lead_no', 'lead_sales.lead_type', 'status_codes.status_name as status_name', 'lead_sales.status', 'lead_sales.updated_at', 'lead_sales.created_at','users.name as agent_name')
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
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->whereIn('lead_sales.lead_type',['P2P','MNP','New'])
                ->where('users.agent_code', auth()->user()->agent_code)
                ->get();

            // return json_encode($data);
            return view('admin.lead.view-postpaid-lead-manager', compact('data'));
       }
    }
    //
    public function ViewLead(Request $request)
    {
        // $role =
        $data = lead_sale::findorfail($request->id);
        // return auth()->user()->role;
        if(auth()->user()->role != 'MainAdmin'){
            // return "Doom";
            if($data->saler_id != auth()->user()->id){
                return redirect()->route('home');
            }
        }
        $plan = plan::where('status', '1')->get();
        // $plan = plan::where('status', '1')->get();
        $planwifi = HomeWifiPlan::where('status', '1')->get();

        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status', 1)->get();
        $remarks = remark::where('lead_id',$request->id)->get();
        //
        $remarks = remark::where('lead_id', $request->id)->get();
        $audios = audio_recording::wherelead_no($request->id)->get();


        // $plan = \App\Models\plan
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "New Lead Form"]
        ];

        return view('agent.view-lead', compact('data', 'plan', 'country', 'emirate', 'breadcrumbs','planwifi', 'remarks','audios'));
    }
    public function EditLead(Request $request)
    {
        $data = lead_sale::findorfail($request->id);

        if (auth()->user()->role != 'MainAdmin') {
            // return "Doom";
            if ($data->saler_id != auth()->user()->id) {
                return redirect()->route('home');
            }
        }
        // $role =
        $data = lead_sale::findorfail($request->id);
        $plan = plan::where('status', '1')->get();
        $planwifi = HomeWifiPlan::where('status', '1')->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status', 1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            [
                'link' => "/", 'name' => "Home"
            ], ['link' => "javascript:void(0)", 'name' => "New Lead Form"]
        ];

        return view('admin.lead.edit-postpaid-lead', compact('data', 'plan', 'country', 'emirate', 'breadcrumbs', 'planwifi'));
    }
    //
    public function HomeWifiForm(Request $request){
        // return $request;
        $plan = HomeWifiPlan::where('status','1')->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status',1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Home Wifi Lead Form"]
        ];
        $type = 'Vocus';
        $ptype = 'HomeWifi';
        $last = lead_sale::latest()->first();
        $tl = User::where('role','TeamLeader')->get();
        $fne_data = fne_data::where('user_id', auth()->user()->id)->where('is_status', 'Closed')->get();

        return view('admin.lead.add-wifi-lead',compact('plan','country','emirate','breadcrumbs','type','ptype', 'last','tl','fne_data'));
    }
    //
    //
    public function AddDataHW(Request $request){
        // return $request;
        $plan = HomeWifiPlan::where('status','1')->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status',1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Home Wifi Lead Form"]
        ];
        $type = 'Vocus';
        $ptype = 'HomeWifi';
        $last = lead_sale::latest()->first();
        $tl = User::where('role','TeamLeader')->get();
        $fne_data = fne_data::where('user_id', auth()->user()->id)->where('is_status', 'Closed')->get();

        return view('agent.add-new-lead',compact('plan','country','emirate','breadcrumbs','type','ptype', 'last','tl','fne_data'));
    }
    //
    //
    public function FixedForm(Request $request){
        // return $request;
        $plan = HomeWifiPlan::where('status','1')
        ->where('home_wifi_plans.lead_type','HomeWifi')
        ->get();
        $fplan = HomeWifiPlan::where('status','1')
        ->where('home_wifi_plans.lead_type', 'Fixed')
        ->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status',1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Home Wifi Lead Form"]
        ];
        $type = 'Vocus';
        $ptype = 'HomeWifi';
        $last = lead_sale::latest()->first();
        $tl = User::where('role','TeamLeader')->get();
        $fne_data = fne_data::where('user_id', auth()->user()->id)->where('is_status', 'Closed')->get();

        return view('admin.lead.add-fixed-lead',compact('plan','country','emirate','breadcrumbs','type','ptype', 'last','tl','fne_data','fplan'));
    }
    //
    //
    public function SessionFixedForm(Request $request){
        // return $request;
        // $plan = HomeWifiPlan::where('status','1')
        // ->where('home_wifi_plans.lead_type','HomeWifi')
        // ->get();
        $fplan = HomeWifiPlan::where('status','1')
        ->where('home_wifi_plans.lead_type', 'Fixed')
        ->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status',1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Home Wifi Lead Form"]
        ];
        $type = 'Vocus';
        $ptype = 'HomeWifi';
        $last = lead_sale::latest()->first();
        $tl = User::where('role','TeamLeader')->get();
        $fne_data = fne_data::where('user_id', auth()->user()->id)->where('is_status', 'Closed')->get();

        return view('admin.lead.session-fixed-lead',compact('country','emirate','breadcrumbs','type','ptype', 'last','tl','fne_data','fplan'));
    }
    //
    public function FixedSubmit(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'address' => 'required|string',
            'building' => 'required|string',
            // 'customer_name' => 'required',
            'plans' => 'required',
            'building' => 'required|string',
            'unit' => 'required',
            'google_location' => 'required|string|url',
            // 'customer_number' => 'required|string',
            'fiveg_number' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'alternative_number' => 'required',
            // 'emirate_id' => 'required',
            'emirate_id' => 'required_if:leadtype,HomeWifi',
            // "emirate_id" => "required_if:leadtype,HomeWifi",
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'emirate_expiry' => 'required_if:leadtype,HomeWifi',
            'dob' => ['required_if:leadtype,HomeWifi']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if ($request->contact_number === $request->fiveg_number) {
            return response()->json(['error' => ['Documents' => ['5G and Customer Number Need to Be Unique']]], 200);
        }
        if ($request->plans == 6 || $request->plans == 7) {
            if ($request->expiry == '') {
                return response()->json(['error' => ['Documents' => ['5G Expiry is Mandatory']]], 200);
            }
        }
        if($request->leadtype == 'FNE'){
            $ddm = fne_data::where('customer_number', $request->contact_number)
                // ->whereNotIn('status', ['1.15','1.14','1.02'])
                // ->where('is_allowed', 0)
                ->first();

            if ($ddm) {
                return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer Number']]], 200);
            }
            $fned = fne_data::create([
                'customer_name' => $request->full_name,
                'plan' => $request->plans,
                'expiry' => $request->expiry,
                'address' => $request->address,
                'building' => $request->building,
                'unit' => $request->unit,
                'google_location' => $request->google_location,
                'customer_number' => $request->contact_number,
                '5g_number' => $request->fiveg_number,
                'user_id' => auth()->user()->id,
                'is_status' => 'Pending',
                'account_id' => $request->account_id,
                'lat' => $request->lat_final,
                'lng' => $request->lng_final,
            ]);
            $MyData = [
                'address' => $request->address,
                'building' => $request->building,
                'unit' => $request->unit,
                'google_location' => $request->google_location,
                '5g_number' => $request->fiveg_number,
                'customer_number' => $request->customer_number,
                'numbers' => '923121337222,923453598420'
            ];
            // return response()->json(['error' => ['Documents' => [$fnde->id]]], 200);
            \App\Http\Controllers\FunctionController::WhatsAppFNERequest($MyData);

            // if ($request->plans == 1 || $request->plans == 2 || $request->plans == 3) {
            //     if ($request->is_old == '') {
            //         return response()->json(['error' => ['Documents' => ['Lead new h?? ya Old']]], 200);
            //     }
            // } else {
            //     if (empty($request->fne_req)) {
            //         return response()->json(['error' => ['Documents' => ['Kindly Select FNE Request for proceeding lead ']]], 200);
            //     }
            // }

            $ddm = lead_sale::where('customer_number', $request->contact_number)
                ->whereNotIn('status', ['1.15','1.14','1.02'])
                ->where('is_allowed', 0)
                ->first();

            if ($ddm) {

                return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer Number']]], 200);
            }
            // $ddm1 = lead_sale::where('emirate_id', $request->emirate_id)
            // ->where('is_allowed', 0)
            // // ->whereNot('saler_id', auth()->user()->id)
            // ->whereNotIn('status', ['1.15','1.14','1.02'])

            // ->first();
            // if ($ddm1) {
            //     return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer ID']]], 200);
            // }
            //

            //

            // $ddm2 = lead_sale::where('emirate_id', $request->emirate_id)
            // ->where('is_allowed', 0)
            // ->whereNotIn('status', ['1.15','1.14','1.02'])

            // // ->whereNot('saler_id', auth()->user()->id)
            // ->where('nationality', $request->nationality)->first();
            // if ($ddm2) {

            //     return response()->json(['error' => ['Documents' => ['Bola na already proceed']]], 200);
            // }
            //
            // $data = Carbon::
            //
            // return $request->leadnumber;
            $data = lead_sale::create([
                'lead_no' => $request->leadnumber,
                'customer_name' => $request->full_name,
                'email' => $request->email,
                'customer_number' => $request->contact_number,
                'alternative_number' => $request->alternative_number,
                'emirate_id' => $request->emirate_id,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'emirate' => $request->emirate,
                'plans' => $request->plans,
                'language' => $request->language,
                'emirate_expiry' => $request->emirate_expiry,
                'dob' => $request->dob,
                'status' => '1.13',
                'saler_name' => auth()->user()->name,
                'saler_id' => auth()->user()->id,
                'lead_type' => 'HomeWifi',
                'lead_date' => Carbon::now()->toDateTimeString(),
                'remarks' => $request->remarks,
                'shared_with' => $request->shared_with,
                'is_old' => $request->is_old,
                'lead_reff' => $fned->id,
                'data_lead_id' => $request->logsystemid,
                'reff_base' => $request->reff_base,

            ]);

            if ($request->plans == 5 || $request->plans == 6 || $request->plans == 7) {
                $manual_remarks = 'This Lead For Usman ITS FNE BABY !!!!';
            } else if ($request->is_old == 1) {
                $manual_remarks = 'Lead is Old';
            } else if ($request->is_old == 0) {
                $manual_remarks = 'Lead is New';
            } else {
                $manual_remarks = ' ASAP';
            }
            remark::create([
                'remarks' => $request->remarks . ' ' . $manual_remarks,
                'lead_status' => '1.13',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            //
            // $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','home_wifi_plans.name as plan_name','lead_sales.saler_name')
            // ->Join(
            //     'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
            // )
            // ->where('lead_sales.id',$data->id)->first();
            // //
            // $link = route('view.lead', $lead->id);
            // $details = [
            //     'lead_id' => $lead->id,
            //     'lead_no' => $lead->lead_no,
            //     'customer_name' => $lead->customer_name,
            //     'customer_number' => $lead->customer_number,
            //     'selected_number' => 'HomeWifi' .' '. $lead->plan_name,
            //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            //     'saler_name' => $lead->saler_name,
            //     'link' => $link,
            //     'agent_code' => auth()->user()->agent_code,
            //     'number' => 923121337222,
            //     // 'Plan' => $number,
            //     // 'AlternativeNumber' => $alternativeNumber,
            // ];
            // return FunctionController::SendWhatsApp($details);
            $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
            ->Join(
                'home_wifi_plans',
                'home_wifi_plans.id',
                'lead_sales.plans'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
            //
            $link = route('view.lead', $lead->id);
            $details = [
                'lead_id' => $lead->id,
                'lead_no' => $lead->lead_no,
                'customer_name' => $lead->customer_name,
                'customer_number' => $request->logsystemid,
                'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
                'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
                'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
                'saler_name' => $lead->saler_name,
                'link' => $link,
                'agent_code' => auth()->user()->agent_code,
                'number' => $lead->numbers . ',923453598420,923422708646',
                'plan' => $lead->plan_name,
                'sim_type' => $lead->lead_type,
                // 'Plan' => $number,
                // 'AlternativeNumber' => $alternativeNumber,
            ];
            FunctionController::SendWhatsAppVerification($details);


            //
            // $remarks = remark::create
            return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
        }else{
            if ($request->plans == 1 || $request->plans == 2 || $request->plans == 3 || $request->plans == 8) {
                if ($request->is_old == '') {
                    return response()->json(['error' => ['Documents' => ['Lead new h?? ya Old']]], 200);
                }
            }
            // else {
            //     if (empty($request->fne_req)) {
            //         return response()->json(['error' => ['Documents' => ['Kindly Select FNE Request for proceeding lead ']]], 200);
            //     }
            // }

            $ddm = lead_sale::where('customer_number', $request->contact_number)
                // ->whereNotIn('status', ['1.15','1.14','1.02'])
            -> whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001', '1.15', '1.02', '1.15'])

                ->where('is_allowed', 0)
                ->first();

            if ($ddm) {

                return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer Number']]], 200);
            }
            $ddm1 = lead_sale::where('emirate_id', $request->emirate_id)
            ->where('is_allowed', 0)
                // ->whereNot('saler_id', auth()->user()->id)
                ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001', '1.15', '1.02', '1.15'])

            // ->whereNotIn('status', ['1.15','1.14','1.02'])

            ->first();
            if ($ddm1) {
                return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer EID']]], 200);
            }
            //

            //

            $ddm2 = lead_sale::where('emirate_id', $request->emirate_id)
            ->where('is_allowed', 0)
                ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001', '1.15', '1.02', '1.15'])

            // ->whereNotIn('status', ['1.15','1.14','1.02'])

            // ->whereNot('saler_id', auth()->user()->id)
            ->where('nationality', $request->nationality)->first();
            if ($ddm2) {

                return response()->json(['error' => ['Documents' => ['Bola na already proceed']]], 200);
            }
            //
            // $data = Carbon::
            //
            // return $request->leadnumber;
            $data = lead_sale::create([
                'lead_no' => $request->leadnumber,
                'customer_name' => $request->full_name,
                'email' => $request->email,
                'customer_number' => $request->contact_number,
                'alternative_number' => $request->alternative_number,
                'emirate_id' => $request->emirate_id,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'emirate' => $request->emirate,
                'plans' => $request->plans,
                'language' => $request->language,
                'emirate_expiry' => $request->emirate_expiry,
                'dob' => $request->dob,
                'status' => '1.01',
                'saler_name' => auth()->user()->name,
                'saler_id' => auth()->user()->id,
                'lead_type' => 'HomeWifi',
                'lead_date' => Carbon::now()->toDateTimeString(),
                'remarks' => $request->remarks,
                'shared_with' => $request->shared_with,
                'is_old' => $request->is_old,
                'lead_reff' => $request->lead_reff,
                'data_lead_id' => $request->logsystemid,

            ]);

            if ($request->plans == 5 || $request->plans == 6 || $request->plans == 7) {
                $manual_remarks = 'This Lead For Usman ITS FNE BABY !!!!';
            } else if ($request->is_old == 1) {
                $manual_remarks = 'Lead is Old';
            } else if ($request->is_old == 0) {
                $manual_remarks = 'Lead is New';
            } else {
                $manual_remarks = ' ASAP';
            }
            remark::create([
                'remarks' => $request->remarks . ' ' . $manual_remarks,
                'lead_status' => '1.01',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            //
            // $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','home_wifi_plans.name as plan_name','lead_sales.saler_name')
            // ->Join(
            //     'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
            // )
            // ->where('lead_sales.id',$data->id)->first();
            // //
            // $link = route('view.lead', $lead->id);
            // $details = [
            //     'lead_id' => $lead->id,
            //     'lead_no' => $lead->lead_no,
            //     'customer_name' => $lead->customer_name,
            //     'customer_number' => $lead->customer_number,
            //     'selected_number' => 'HomeWifi' .' '. $lead->plan_name,
            //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            //     'saler_name' => $lead->saler_name,
            //     'link' => $link,
            //     'agent_code' => auth()->user()->agent_code,
            //     'number' => 923121337222,
            //     // 'Plan' => $number,
            //     // 'AlternativeNumber' => $alternativeNumber,
            // ];
            // return FunctionController::SendWhatsApp($details);
            $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
            ->Join(
                'home_wifi_plans',
                'home_wifi_plans.id',
                'lead_sales.plans'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
            //
            $link = route('view.lead', $lead->id);
            $details = [
                'lead_id' => $lead->id,
                'lead_no' => $lead->lead_no,
                'customer_name' => $lead->customer_name,
                'customer_number' => $lead->customer_number,
                'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
                'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
                'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
                'saler_name' => $lead->saler_name,
                'link' => $link,
                'agent_code' => auth()->user()->agent_code,
                'number' => $lead->numbers . ',923453598420,923422708646',
                'plan' => $lead->plan_name,
                'sim_type' => $lead->lead_type,
                // 'Plan' => $number,
                // 'AlternativeNumber' => $alternativeNumber,
            ];
            FunctionController::SendWhatsAppVerification($details);


            //
            // $remarks = remark::create
            return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
        }

        // return $data
    }
    //
    public function FNEWifiForm(Request $request){
        // return $request->id;
        $plan = HomeWifiPlan::where('status','1')->whereIn('id',['5','6','7'])->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status',1)->get();
        // $myData = fne_data::where('id',$request->id)->first();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Home Wifi Lead Form"]
        ];
        $type = 'Vocus';
        $ptype = 'FNE';
        $last = lead_sale::latest()->first();
        $tl = User::where('role','TeamLeader')->get();
        $fne_data = fne_data::where('id',$request->id)
        // ->where('is_status', 'Closed')
        ->first();

        return view('admin.lead.add-fne-lead',compact('plan','country','emirate','breadcrumbs','type','ptype', 'last','tl','fne_data'));
    }
    //
    public function AddNewForm(Request $request){
        // return $request;
        $plan = Plan::where('status','1')->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status',1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Home Wifi Lead Form"]
        ];
        $type = 'Vocus';
        $ptype = 'HomeWifi';
        $last = lead_sale::latest()->first();
        $tl = User::where('role', 'TeamLeader')->get();
        return view('admin.lead.add-new-lead',compact('plan','country','emirate','breadcrumbs','type','ptype', 'last','tl'));
    }
    public function MNPForm(Request $request){
        // return $request;
        $plan = plan::where('status','1')->get();
        $country = country_phone_code::select('name')->get();
        $emirate = emirate::select('name')->where('status',1)->get();
        // $plan = \App\Models\plan
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "New Lead Form"]
        ];
        $type = 'Vocus';
        $ptype = 'HomeWifi';
        $last = lead_sale::latest()->first();

        return view('admin.lead.add-mnp-lead',compact('plan','country','emirate','breadcrumbs','type','ptype','last'));
    }
    //
    //
    public function HomeWifiSubmit(Request $request){


        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            // 'email' => 'required|string|email',
            'contact_number' => 'required',
            'logsystemid' => 'required',
            // 'alternative_number' => 'required',
            // 'emirate_id' => 'required',
            // 'gender' => 'required',
            // 'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'front_docs' => 'required_if:CategoryType,==,MNP,P2P',
            'back_docs' => 'required_if:CategoryType,==,MNP,P2P',
            'additional_documents' => 'required_if:CategoryType,==,MNP,P2P',
            // 'emirate_expiry' => 'required|date|after:tomorrow',
            // 'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        // if ($request->plans == 1 || $request->plans == 2 || $request->plans == 3 || $request->plans == 8) {
        //     if ($request->is_old == '') {
        //         return response()->json(['error' => ['Documents' => ['Lead new h?? ya Old']]], 200);
        //     }
        // } else {
        //     if (empty($request->fne_req)) {
        //         return response()->json(['error' => ['Documents' => ['Kindly Select FNE Request for proceeding lead ']]], 200);
        //     }
        // }

        // $ddm = lead_sale::where('customer_number', $request->contact_number)
        //     ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001', '1.15', '1.02', '1.15'])
        //     ->where('is_allowed', 0)
        //     ->first();
        $ddm = \App\Models\WhatsAppMnpBank::where('number_id',$request->logsystemid)->first();
        if (!$ddm) {

            return response()->json(['error' => ['Documents' => ['Short Code Does not belong to US']]], 200);
        }
        $ddm1 = lead_sale::where('emirate_id', $request->emirate_id)
        ->where('is_allowed',0)
        ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001', '1.15', '1.02', '1.14'])
        ->first();
        // if ($ddm1) {
        //     return response()->json(['error' => ['Documents' => ['Sudhar ja :) pehly hi lead bani hwi h behn']]], 200);
        // }
        //

        //
        if ($file = $request->file('front_docs')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_docs')));
            $image2 = file_get_contents($request->file('front_docs'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents/' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $front_id = $originalFileName;
            $file->move('documents', $front_id);
        } else {
            // return response()->json(['error' => ['Documents' => ['there is an issue in Front ID, Contact Team Leader']]], 200);
            $front_id =  '';
        }
        if ($file = $request->file('additional_documents')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('additional_documents')));
            $image2 = file_get_contents($request->file('additional_documents'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $additional_docs_photo = $originalFileName;
            $file->move('documents', $additional_docs_photo);
        } else {
            $additional_docs_photo =  '';

            // return response()->json(['error' => ['Documents' => ['there is an issue in Additional Docs, Contact Team Leader']]], 200);
            // $additional_docs_photo =  $request->additional_docs_photo;
        }
        if ($file = $request->file('back_docs')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('back_docs')));
            $image2 = file_get_contents($request->file('back_docs'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $back_id = $originalFileName;
            $file->move('documents', $back_id);
        } else {

            $back_id =  '';
            // return response()->json(['error' => ['Documents' => ['there is an issue in Back ID, Contact Team Leader']]], 200);
            // $back_id = $request->cnic_back_old;
        }

        // $ddm2 = lead_sale::where('emirate_id', $request->emirate_id)
        //     ->where('is_allowed', 0)
        //     ->whereNotIn('status', ['1.15','1.14','1.02'])

        // // ->whereNot('saler_id', auth()->user()->id)
        // ->where('nationality',$request->nationality)->first();
        // if ($ddm2) {

        //     return response()->json(['error' => ['Documents' => ['Bola na already proceed']]], 200);
        // }
        //
        // $data = Carbon::
        //
        $last = \App\Models\lead_sale::latest()->first();
        $getfirst = $last->id;
        $lead_no = auth()->user()->agent_code . '-' . $getfirst . '-' . Carbon::now()->format('M') . '-' . now()->year;
        // return $request->leadnumber;
        $data = lead_sale::create([
            'lead_no' => $lead_no,
            'customer_name' => $request->full_name,
            'email' => $request->email,
            'customer_number' => $request->contact_number,
            'alternative_number' => $request->alternative_number,
            'emirate_id' => $request->emirate_id,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'emirate' => $request->emirate,
            'plans' => $request->plans,
            'language' => $request->language,
            'emirate_expiry' => $request->emirate_expiry,
            'dob' => $request->dob,
            'status' => '1.01',
            'saler_name' => auth()->user()->name,
            'saler_id' => auth()->user()->id,
            'lead_type' => $request->CategoryType,
            'lead_date' => Carbon::now()->toDateTimeString(),
            'remarks' => $request->remarks,
            'shared_with' => $request->shared_with,
            'is_old' => $request->is_old,
            'lead_reff' => $request->lead_reff,
            'short_code' => $request->logsystemid,
            'id_type' => $request->customer_type,
            'front_id' => $front_id,
            'back_id' => $back_id,
            'additional_docs_photo' => $additional_docs_photo,
        ]);

        if($request->plans == 5 || $request->plans == 6 || $request->plans == 7){
            $manual_remarks = 'This Lead For Usman ITS FNE BABY !!!!';
        }
        else if($request->is_old == 1){
            $manual_remarks = 'Lead is Old';
        }
        else if($request->is_old == 0){
            $manual_remarks = 'Lead is New';
        }
        else{
            $manual_remarks = ' ASAP';
        }
        remark::create([
            'remarks' => $request->remarks .' '. $manual_remarks,
            'lead_status' => '1.01',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        // $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','home_wifi_plans.name as plan_name','lead_sales.saler_name')
        // ->Join(
        //     'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
        // )
        // ->where('lead_sales.id',$data->id)->first();
        // //
        // $link = route('view.lead', $lead->id);
        // $details = [
        //     'lead_id' => $lead->id,
        //     'lead_no' => $lead->lead_no,
        //     'customer_name' => $lead->customer_name,
        //     'customer_number' => $lead->customer_number,
        //     'selected_number' => 'HomeWifi' .' '. $lead->plan_name,
        //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
        //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
        //     'saler_name' => $lead->saler_name,
        //     'link' => $link,
        //     'agent_code' => auth()->user()->agent_code,
        //     'number' => 923121337222,
        //     // 'Plan' => $number,
        //     // 'AlternativeNumber' => $alternativeNumber,
        // ];
        // return FunctionController::SendWhatsApp($details);
        if($request->CategoryType == 'P2P' || $request->CategoryType == 'MNP'){

            $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'plans.plan_name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
            ->Join(
                'plans',
                'plans.id',
                'lead_sales.plans'
            )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'call_centers',
                    'call_centers.call_center_code',
                    'users.agent_code'
                )
                ->where('lead_sales.id', $data->id)->first();
        }
        else{


        $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
        ->Join(
            'home_wifi_plans',
            'home_wifi_plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
        //
        }
        $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
            'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => $lead->numbers . ',923453598420,923422708646',
            'plan' => $lead->plan_name,
            'sim_type' => $lead->lead_type,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppVerification($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    //
    //
    public function HomeWifiSubmitWhatsApp(Request $request){


        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'alternative_number' => 'required',
            'emirate_id' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'emirate_expiry' => 'required|date|after:tomorrow',
            'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        if ($request->plans == 1 || $request->plans == 2 || $request->plans == 3 || $request->plans == 8) {
            if ($request->is_old == '') {
                return response()->json(['error' => ['Documents' => ['Lead new h?? ya Old']]], 200);
            }
        } else {
            if (empty($request->fne_req)) {
                return response()->json(['error' => ['Documents' => ['Kindly Select FNE Request for proceeding lead ']]], 200);
            }
        }

        $ddm = lead_sale::where('customer_number', $request->contact_number)
            // ->whereNotIn('status', ['1.15', '1.02', '1.14'])
            ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001','1.15','1.02','1.15'])

            ->where('is_allowed', 0)
        ->first();

        if ($ddm) {

            return response()->json(['error' => ['Documents' => ['Request Already Proceed for WAP.']]], 200);
        }
        $ddm1 = lead_sale::where('emirate_id', $request->emirate_id)
        ->where('is_allowed',0)
            // ->whereNot('saler_id', auth()->user()->id)
            // ->whereNotIn('status', ['1.15','1.14','1.02'])
            ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001', '1.15', '1.02', '1.15'])


        ->first();
        // if ($ddm1) {
        //     return response()->json(['error' => ['Documents' => ['Sudhar ja :) pehly hi lead bani hwi h bhai']]], 200);
        // }
        //

        //

        $ddm2 = lead_sale::where('emirate_id', $request->emirate_id)
            ->where('is_allowed', 0)
            // ->whereNotIn('status', ['1.15','1.14','1.02'])
            ->whereNotIn('status', ['1.1500000000000001', '1.0200000000000001', '1.1400000000000001', '1.15', '1.02', '1.15'])


        // ->whereNot('saler_id', auth()->user()->id)
        ->where('nationality',$request->nationality)->first();
        if ($ddm2) {

            return response()->json(['error' => ['Documents' => ['Bola na already proceed']]], 200);
        }
        //
        // $data = Carbon::
        //
        // return $request->leadnumber;
        $data = lead_sale::create([
            'lead_no' => $request->leadnumber,
            'customer_name' => $request->full_name,
            'email' => $request->email,
            'customer_number' => $request->contact_number,
            'alternative_number' => $request->alternative_number,
            'emirate_id' => $request->emirate_id,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'emirate' => $request->emirate,
            'plans' => $request->plans,
            'language' => $request->language,
            'emirate_expiry' => $request->emirate_expiry,
            'dob' => $request->dob,
            'status' => '1.22',
            'saler_name' => auth()->user()->name,
            'saler_id' => auth()->user()->id,
            'lead_type' => 'HomeWifi',
            'lead_date' => Carbon::now()->toDateTimeString(),
            'remarks' => $request->remarks,
            'shared_with' => $request->shared_with,
            'is_old' => $request->is_old,
            'lead_reff' => $request->lead_reff,
        ]);

        if($request->plans == 5 || $request->plans == 6 || $request->plans == 7){
            $manual_remarks = 'This Lead For Usman ITS FNE BABY !!!!';
        }
        else if($request->is_old == 1){
            $manual_remarks = 'Lead is Old';
        }
        else if($request->is_old == 0){
            $manual_remarks = 'Lead is New';
        }
        else{
            $manual_remarks = ' ASAP';
        }
        remark::create([
            'remarks' => $request->remarks .' '. $manual_remarks,
            'lead_status' => '1.22',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        // $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','home_wifi_plans.name as plan_name','lead_sales.saler_name')
        // ->Join(
        //     'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
        // )
        // ->where('lead_sales.id',$data->id)->first();
        // //
        // $link = route('view.lead', $lead->id);
        // $details = [
        //     'lead_id' => $lead->id,
        //     'lead_no' => $lead->lead_no,
        //     'customer_name' => $lead->customer_name,
        //     'customer_number' => $lead->customer_number,
        //     'selected_number' => 'HomeWifi' .' '. $lead->plan_name,
        //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
        //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
        //     'saler_name' => $lead->saler_name,
        //     'link' => $link,
        //     'agent_code' => auth()->user()->agent_code,
        //     'number' => 923121337222,
        //     // 'Plan' => $number,
        //     // 'AlternativeNumber' => $alternativeNumber,
        // ];
        // return FunctionController::SendWhatsApp($details);
        $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
        ->Join(
            'home_wifi_plans',
            'home_wifi_plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
        //
        $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
            'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => $lead->numbers . ',923453598420,923422708646',
            'plan' => $lead->plan_name,
            'sim_type' => $lead->lead_type,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        // $mynum = str_replace('1')
        $str_to_replace = '971';

        // $input_str = '9715088880Z9714088880Z8088880Z';

        $l =  $output_str = $str_to_replace . substr(
            $lead->customer_number,
            1
        );
        \App\Http\Controllers\ReportController::InitiateWhatsAppVerification($l);
        FunctionController::SendWhatsAppVerification($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    //
    //
    public function FNESubmit(Request $request){


        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'alternative_number' => 'required',
            'emirate_id' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'emirate_expiry' => 'required|date|after:tomorrow',
            'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        if ($request->plans == 1 || $request->plans == 2 || $request->plans == 3) {
            if ($request->is_old == '') {
                return response()->json(['error' => ['Documents' => ['Lead new h?? ya Old']]], 200);
            }
        } else {
            if (empty($request->fne_req)) {
                return response()->json(['error' => ['Documents' => ['Kindly Select FNE Request for proceeding lead ']]], 200);
            }
        }

        $ddm = lead_sale::where('customer_number', $request->contact_number)
        ->whereNotIn('status',['1.15','1.02','1.14'])
            ->where('is_allowed', 0)
        ->first();

        if ($ddm) {

            return response()->json(['error' => ['Documents' => ['Request Already Proceed']]], 200);
        }
        $ddm1 = lead_sale::where('emirate_id', $request->emirate_id)
        ->where('is_allowed',0)
            // ->whereNot('saler_id', auth()->user()->id)
            ->whereNotIn('status', ['1.15','1.14','1.02'])

        ->first();
        // if ($ddm1) {
        //     return response()->json(['error' => ['Documents' => ['Sudhar ja :) pehly hi lead bani hwi h bhai']]], 200);
        // }
        //

        //

        $ddm2 = lead_sale::where('emirate_id', $request->emirate_id)
            ->where('is_allowed', 0)
            ->whereNotIn('status', ['1.15','1.14','1.02'])

        // ->whereNot('saler_id', auth()->user()->id)
        ->where('nationality',$request->nationality)->first();
        if ($ddm2) {

            return response()->json(['error' => ['Documents' => ['Bola na already proceed']]], 200);
        }
        //
        // $data = Carbon::
        //
        $user = User::where('id',$request->saler_id)->first();
        // return $request->leadnumber;
        $data = lead_sale::create([
            'lead_no' => $request->leadnumber,
            'customer_name' => $request->full_name,
            'email' => $request->email,
            'customer_number' => $request->contact_number,
            'alternative_number' => $request->alternative_number,
            'emirate_id' => $request->emirate_id,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'emirate' => $request->emirate,
            'plans' => $request->plans,
            'language' => $request->language,
            'emirate_expiry' => $request->emirate_expiry,
            'dob' => $request->dob,
            'status' => '1.01',
            'saler_name' => $user->name,
            'saler_id' => $request->saler_id,
            'lead_type' => 'HomeWifi',
            'lead_date' => Carbon::now()->toDateTimeString(),
            'remarks' => $request->remarks,
            'shared_with' => $request->shared_with,
            'is_old' => $request->is_old,
            'lead_reff' => $request->lead_reff,
        ]);

        if($request->plans == 5 || $request->plans == 6){
            $manual_remarks = 'This Lead For Usman ITS FNE BABY !!!!';
        }
        else if($request->is_old == 1){
            $manual_remarks = 'Lead is Old, Kindly check old lead number before verifications';
        }
        else if($request->is_old == 0){
            $manual_remarks = 'Lead is New, Kindly check  before verifications';
        }
        else{
            $manual_remarks = ' ASAP';
        }
        remark::create([
            'remarks' => $request->remarks .' '. $manual_remarks,
            'lead_status' => '1.01',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => $user->name,
            'user_agent_id' => $request->saler_id,
        ]);
        //
        // $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','home_wifi_plans.name as plan_name','lead_sales.saler_name')
        // ->Join(
        //     'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
        // )
        // ->where('lead_sales.id',$data->id)->first();
        // //
        // $link = route('view.lead', $lead->id);
        // $details = [
        //     'lead_id' => $lead->id,
        //     'lead_no' => $lead->lead_no,
        //     'customer_name' => $lead->customer_name,
        //     'customer_number' => $lead->customer_number,
        //     'selected_number' => 'HomeWifi' .' '. $lead->plan_name,
        //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
        //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
        //     'saler_name' => $lead->saler_name,
        //     'link' => $link,
        //     'agent_code' => auth()->user()->agent_code,
        //     'number' => 923121337222,
        //     // 'Plan' => $number,
        //     // 'AlternativeNumber' => $alternativeNumber,
        // ];
        // return FunctionController::SendWhatsApp($details);
        $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
        ->Join(
            'home_wifi_plans',
            'home_wifi_plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
        //
        $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
            'remarks' => $request->remarks . ' ' . ' Remarks By ' . $user->name . ' (' .  $user->email . ')',
            'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . $user->name . ' (' .  $user->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => $lead->numbers,
            'plan' => $lead->plan_name,
            'sim_type' => $lead->lead_type,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppVerification($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    //
    //
    public function NewLeadSubmit(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'alternative_number' => 'required',
            'emirate_id' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'emirate_expiry' => 'required|date|after:tomorrow',
            'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        $ddm = lead_sale::where('customer_number',$request->contact_number)->first();
        if ($ddm) {

            return response()->json(['error' => ['Documents' => ['Request Already Proceed']]], 200);
        }
        // $data = Carbon::
        //
        // return $request->leadnumber;
        $data = lead_sale::create([
            'lead_no' => $request->leadnumber,
            'customer_name' => $request->full_name,
            'email' => $request->email,
            'customer_number' => $request->contact_number,
            'emirate_id' => $request->emirate_id,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'emirate' => $request->emirate,
            'plans' => $request->plans,
            'language' => $request->language,
            'emirate_expiry' => $request->emirate_expiry,
            'dob' => $request->dob,
            'status' => '1.01',
            'saler_name' => auth()->user()->name,
            'saler_id' => auth()->user()->id,
            'lead_type' => 'New',
            'lead_date' => Carbon::now()->toDateTimeString(),
            'remarks' => $request->remarks,
            // 'front_id' => $front_id,
            // 'back_id' => $back_id,
            // 'additional_docs_photo' => $additional_docs_photo,
            // 'additional_docs_name' => $request->additional_docs_name,
            // 'emirate_id_count' => trim($emirate_id_count),
            'shared_with' => $request->shared_with,
        ]);
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '1.01',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'plans.plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
        ->Join(
            'plans',
            'plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
        //
        $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
            'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => $lead->numbers,
            'plan' => $lead->plan_name,
            'sim_type' => $lead->lead_type,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppVerification($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    //
    public function LeadSubmitVerification(Request $request){
        //

        //
        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'emirate_id' => 'required_if:list_type,==,MNP',
            // 'emirate_id' => 'required_if:list_type,==,MNP',
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'front_id' => 'required_if:list_type,==,MNP',
            'back_id' => 'required_if:list_type,==,MNP',
            'additional_docs_name' => 'required',
            'additional_docs_photo' => 'required',
            'lead_type' => 'required',
            'emirate_expiry' => 'required|date|after:tomorrow',
            'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        // return "s";
        // $data = Carbon::
        //
        if ($file = $request->file('front_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_id')));
            $image2 = file_get_contents($request->file('front_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents/' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $front_id = $originalFileName;
            $file->move('documents', $front_id);
        } else {
            // return response()->json(['error' => ['Documents' => ['there is an issue in Front ID, Contact Team Leader']]], 200);
            $front_id =  '';
        }
        if ($file = $request->file('additional_docs_photo')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('additional_docs_photo')));
            $image2 = file_get_contents($request->file('additional_docs_photo'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $additional_docs_photo = $originalFileName;
            $file->move('documents', $additional_docs_photo);
        }
        else {
            return response()->json(['error' => ['Documents' => ['there is an issue in Additional Docs, Contact Team Leader']]], 200);
            // $additional_docs_photo =  $request->additional_docs_photo;
        }
        if ($file = $request->file('back_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('back_id')));
            $image2 = file_get_contents($request->file('back_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $back_id = $originalFileName;
            $file->move('documents', $back_id);
        } else {

            $back_id =  '';
            // return response()->json(['error' => ['Documents' => ['there is an issue in Back ID, Contact Team Leader']]], 200);
            // $back_id = $request->cnic_back_old;
        }
        //
        if ($request->inlineRadioOptions == 'option1' && $request->lead_type == 'P2P') {
            $emirate_id = $request->emirate_id;
            $emirate_id_count = 1;
        }
        elseif ($request->inlineRadioOptions == 'option2' && $request->lead_type == 'P2P') {
            $emirate_id = $request->emirate_id_last_five;
            $emirate_id_count = 0;
        }
        else{
            $emirate_id = $request->emirate_id;
            $emirate_id_count = 1;
        }
        // return $emirat
            // return response()->json(['error' => ['Documents' => [$emirate_id_count]]], 200);


        // return $request->leadnumber;
        $data = lead_sale::create([
            'lead_no' => $request->leadnumber,
            'customer_name' => $request->full_name,
            'email' => $request->email,
            'customer_number' => $request->contact_number,
            'emirate_id' => $emirate_id,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'emirate' => $request->emirate,
            'plans' => $request->plans,
            'language' => $request->language,
            'emirate_expiry' => $request->emirate_expiry,
            'dob' => $request->dob,
            'status' => '1.01',
            'saler_name' => auth()->user()->name,
            'saler_id' => auth()->user()->id,
            'lead_type' => $request->lead_type,
            'lead_date' => Carbon::now()->toDateTimeString(),
            'remarks' => $request->remarks,
            'front_id' => $front_id,
            'back_id' => $back_id,
            'additional_docs_photo' => $additional_docs_photo,
            'additional_docs_name' => $request->additional_docs_name,
            'emirate_id_count' => trim($emirate_id_count),
            'shared_with' => $request->shared_with,
        ]);
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '1.01',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','plans.plan_name','lead_sales.saler_name','lead_sales.lead_type','call_centers.numbers')
        ->Join(
            'plans',
            'plans.id','lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
        ->where('lead_sales.id',$data->id)->first();
        //
        $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $lead->lead_type .' '. $lead->plan_name,
            'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => $lead->numbers,
            'plan' => $lead->plan_name,
            'sim_type' => $lead->lead_type,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppVerification($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    //
    //
    public function ReLeadSubmitVerification(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'emirate_id' => 'required_if:list_type,==,MNP',
            // 'emirate_id' => 'required_if:list_type,==,MNP',
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'front_id' => 'required_if:list_type,==,MNP',
            'back_id' => 'required_if:list_type,==,MNP',
            'additional_docs_name' => 'required',
            'additional_docs_photo' => 'required_if:old_additional_docs_name,==,""',
            'lead_type' => 'required',
            'emirate_expiry' => 'required|date|after:tomorrow',
            'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        // return "s";
        // $data = Carbon::
        //
        if ($file = $request->file('front_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_id')));
            $image2 = file_get_contents($request->file('front_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents/' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $front_id = $originalFileName;
            $file->move('documents', $front_id);
        } else {
            $front_id = $request->old_front_id;
            // return response()->json(['error' => ['Documents' => ['there is an issue in Front ID, Contact Team Leader']]], 200);
            // $cnic_front =  $request->cnic_front_old;
        }
        if ($file = $request->file('additional_docs_photo')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('additional_docs_photo')));
            $image2 = file_get_contents($request->file('additional_docs_photo'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $additional_docs_photo = $originalFileName;
            $file->move('documents', $additional_docs_photo);
        } else {
            $additional_docs_photo = $request->old_additional_docs_name;


            // return response()->json(['error' => ['Documents' => ['there is an issue in Additional Docs, Contact Team Leader']]], 200);
            // $additional_docs_photo =  $request->additional_docs_photo;
        }
        if ($file = $request->file('back_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('back_id')));
            $image2 = file_get_contents($request->file('back_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $back_id = $originalFileName;
            $file->move('documents', $back_id);
        } else {
            $back_id = $request->old_back_id;

            // return response()->json(['error' => ['Documents' => ['there is an issue in Back ID, Contact Team Leader']]], 200);
            // $back_id = $request->cnic_back_old;
        }
        //
        if ($request->inlineRadioOptions == 'option1' && $request->lead_type == 'P2P') {
            $emirate_id = $request->emirate_id;
            $emirate_id_count = 1;
        } elseif ($request->inlineRadioOptions == 'option2' && $request->lead_type == 'P2P') {
            $emirate_id = $request->emirate_id_last_five;
            $emirate_id_count = 0;
        } else {
            $emirate_id = $request->emirate_id;
            $emirate_id_count = 1;
        }
        //
        //
        // return $request->leadnumber;
        $data2 = lead_sale::findorfail($request->lead_id);
        $data2->customer_name = $request->full_name;
        $data2->email = $request->email;
        $data2->customer_number = $request->contact_number;
        $data2->emirate_id = $emirate_id;
        $data2->emirate_id_count = trim($emirate_id_count);
        $data2->gender = $request->gender;
        $data2->nationality = $request->nationality;
        $data2->address = $request->address;
        $data2->emirate = $request->emirate;
        $data2->plans = $request->plans;
        $data2->language = $request->language;
        $data2->emirate_expiry = $request->emirate_expiry;
        $data2->dob = $request->dob;
        $data2->status = '1.12';
        $data2->remarks = $request->remarks;
        $data2->front_id = $front_id;
        $data2->back_id = $back_id;
        $data2->additional_docs_photo = $additional_docs_photo;
        $data2->additional_docs_name = $request->additional_docs_name;
        // $data2->verify_agent = auth()->user()->id;
        $data2->save();
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '1.12',
            'lead_id' => $data2->id,
            'lead_no' => $data2->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'plans.plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
        ->Join(
            'plans',
            'plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data2->id)->first();
        //
        $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
            'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => $lead->numbers,
            'plan' => $lead->plan_name,
            'sim_type' => $lead->lead_type,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppVerification($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    //
    public function DesignerVerification(Request $request){

        $validatedData = Validator::make($request->all(), [
            'additional_docs_photo' => 'required',
            'remarks' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        // return "s";
        // $data = Carbon::
        //

        if ($file = $request->file('additional_docs_photo')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('additional_docs_photo')));
            $image2 = file_get_contents($request->file('additional_docs_photo'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $additional_docs_photo = $originalFileName;
            $file->move('documents', $additional_docs_photo);
        } else {
            return response()->json(['error' => ['Documents' => ['there is an issue in Additional Docs, Contact Team Leader']]], 200);
            // $additional_docs_photo =  $request->additional_docs_photo;
        }

        //
        // return $request->leadnumber;
        $data = lead_sale::findorfail($request->leadid);
        $data->additional_docs_photo = $additional_docs_photo;
        $data->status = '1.01';
        $data->save();
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '1.01',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','plans.plan_name as plan_name','lead_sales.saler_name','lead_sales.lead_type','lead_sales.nationality','lead_sales.emirate','lead_sales.emirate_id')
        ->Join(
            'plans','plans.id','lead_sales.plans'
        )
        ->where('lead_sales.id',$data->id)->first();
        //
        // $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'emirate' => $lead->emirate,
            'emirate_id' => $lead->emirate_id,
            'nationality' => $lead->nationality,
            'selected_number' => $lead->lead_type .' '. $lead->plan_name,
            // 'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            // 'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            // 'saler_name' => $lead->saler_name,
            // 'link' => $link,
            // 'agent_code' => auth()->user()->agent_code,
            'number' => 923121337222,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppDesigner($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    // LeadSubmitProceed
    public function LeadSubmitProceed(Request $request){

        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'emirate_id' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'front_id' => 'required',
            'back_id' => 'required',
            'additional_docs_name' => 'required',
            // 'additional_docs_photo' => 'required',
            'lead_type' => 'required',
            'emirate_expiry' => 'required|date|after:tomorrow',
            'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        // return "s";
        // $data = Carbon::
        //
        if ($file = $request->file('front_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_id')));
            $image2 = file_get_contents($request->file('front_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents/' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $front_id = $originalFileName;
            $file->move('documents', $front_id);
        } else {
            return response()->json(['error' => ['Documents' => ['there is an issue in Front ID, Contact Team Leader']]], 200);
            // $cnic_front =  $request->cnic_front_old;
        }
        // if ($file = $request->file('additional_docs_photo')) {
        //     //convert image to base64
        //     $image = base64_encode(file_get_contents($request->file('additional_docs_photo')));
        //     $image2 = file_get_contents($request->file('additional_docs_photo'));
        //     // AzureCodeStart
        //     $originalFileName = time() . $file->getClientOriginalName();
        //     $multi_filePath = 'documents' . '/' . $originalFileName;
        //     \Storage::disk('azure')->put($multi_filePath, $image2);
        //     // AzureCodeEnd
        //     //prepare request
        //     $mytime = Carbon::now();
        //     $ext =  $mytime->toDateTimeString();
        //     // $name = $ext . '-' . $file->getClientOriginalName();
        //     $additional_docs_photo = $originalFileName;
        //     $file->move('documents', $additional_docs_photo);
        // } else {
        //     return response()->json(['error' => ['Documents' => ['there is an issue in Additional Docs, Contact Team Leader']]], 200);
        //     // $additional_docs_photo =  $request->additional_docs_photo;
        // }
        if ($file = $request->file('back_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('back_id')));
            $image2 = file_get_contents($request->file('back_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $back_id = $originalFileName;
            $file->move('documents', $back_id);
        } else {
            return response()->json(['error' => ['Documents' => ['there is an issue in Back ID, Contact Team Leader']]], 200);
            // $back_id = $request->cnic_back_old;
        }
        //
        // return $request->leadnumber;
        $data = lead_sale::create([
            'lead_no' => $request->leadnumber,
            'customer_name' => $request->full_name,
            'email' => $request->email,
            'customer_number' => $request->contact_number,
            'emirate_id' => $request->emirate_id,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'emirate' => $request->emirate,
            'plans' => $request->plans,
            'language' => $request->language,
            'emirate_expiry' => $request->emirate_expiry,
            'dob' => $request->dob,
            'status' => '1.13',
            'saler_name' => auth()->user()->name,
            'saler_id' => auth()->user()->id,
            'lead_type' => $request->lead_type,
            'lead_date' => Carbon::now()->toDateTimeString(),
            'remarks' => $request->remarks,
            'front_id' => $front_id,
            'back_id' => $back_id,
            // 'additional_docs_photo' => $additional_docs_photo,
            'additional_docs_name' => $request->additional_docs_name,
        ]);
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '1.13',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number', 'plans.plan_name','lead_sales.saler_name','lead_sales.lead_type','lead_sales.emirate_id','lead_sales.emirate','lead_sales.nationality')
        ->Join(
            'plans','plans.id','lead_sales.plans'
        )
        ->where('lead_sales.id',$data->id)->first();
        //
        // $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'emirate' => $lead->emirate,
            'emirate_id' => $lead->emirate_id,
            'nationality' => $lead->nationality,
            // 'selected_number' => $lead->lead_type .' '. $lead->plan_name,
            // 'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            // 'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            // 'saler_name' => $lead->saler_name,
            // 'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => '923121337222,m t',
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppDesigner($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    public function ReLeadSubmitProceed(Request $request){

        $validatedData = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'emirate_id' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            // 'front_id' => 'required',
            // 'back_id' => 'required',
            'additional_docs_name' => 'required',
            // 'additional_docs_photo' => 'required',
            'lead_type' => 'required',
            'emirate_expiry' => 'required|date|after:tomorrow',
            'dob' => ['before:20 years ago']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        //
        // return "s";
        // $data = Carbon::
        //
        if ($file = $request->file('front_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('front_id')));
            $image2 = file_get_contents($request->file('front_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents/' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $front_id = $originalFileName;
            $file->move('documents', $front_id);
        } else {
            $front_id = $request->old_front_id;

            // return response()->json(['error' => ['Documents' => ['there is an issue in Front ID, Contact Team Leader']]], 200);
            // $cnic_front =  $request->cnic_front_old;
        }
        // if ($file = $request->file('additional_docs_photo')) {
        //     //convert image to base64
        //     $image = base64_encode(file_get_contents($request->file('additional_docs_photo')));
        //     $image2 = file_get_contents($request->file('additional_docs_photo'));
        //     // AzureCodeStart
        //     $originalFileName = time() . $file->getClientOriginalName();
        //     $multi_filePath = 'documents' . '/' . $originalFileName;
        //     \Storage::disk('azure')->put($multi_filePath, $image2);
        //     // AzureCodeEnd
        //     //prepare request
        //     $mytime = Carbon::now();
        //     $ext =  $mytime->toDateTimeString();
        //     // $name = $ext . '-' . $file->getClientOriginalName();
        //     $additional_docs_photo = $originalFileName;
        //     $file->move('documents', $additional_docs_photo);
        // } else {
        //     return response()->json(['error' => ['Documents' => ['there is an issue in Additional Docs, Contact Team Leader']]], 200);
        //     // $additional_docs_photo =  $request->additional_docs_photo;
        // }
        if ($file = $request->file('back_id')) {
            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('back_id')));
            $image2 = file_get_contents($request->file('back_id'));
            // AzureCodeStart
            $originalFileName = time() . $file->getClientOriginalName();
            $multi_filePath = 'documents' . '/' . $originalFileName;
            \Storage::disk('azure')->put($multi_filePath, $image2);
            // AzureCodeEnd
            //prepare request
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            // $name = $ext . '-' . $file->getClientOriginalName();
            $back_id = $originalFileName;
            $file->move('documents', $back_id);
        } else {
            $back_id = $request->old_back_id;

            // return response()->json(['error' => ['Documents' => ['there is an issue in Back ID, Contact Team Leader']]], 200);
            // $back_id = $request->cnic_back_old;
        }
        //
        // return $request->leadnumber;
        $data2 = lead_sale::findorfail($request->lead_id);
        $data2->customer_name = $request->full_name;
        $data2->email = $request->email;
        $data2->customer_number = $request->contact_number;
        $data2->emirate_id = $request->emirate_id;
        $data2->gender = $request->gender;
        $data2->nationality = $request->nationality;
        $data2->address = $request->address;
        $data2->emirate = $request->emirate;
        $data2->work_order_num = $request->work_order_num;
        $data2->reff_id = $request->refference_id;
        $data2->plans = $request->plans;
        $data2->language = $request->language;
        $data2->emirate_expiry = $request->emirate_expiry;
        $data2->dob = $request->dob;
        $data2->status = '1.12';
        $data2->remarks = $request->remarks;
        $data2->front_id = $front_id;
        $data2->back_id = $back_id;
        // $data2->additional_docs_photo = $additional_docs_photo;
        $data2->additional_docs_name = $request->additional_docs_name;
        // $data2->verify_agent = auth()->user()->id;
        $data2->save();
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '1.13',
            'lead_id' => $data2->id,
            'lead_no' => $data2->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => 'Sale',
            'user_agent_id' => auth()->user()->id,
        ]);
        //
        //
        $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'plans.plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'lead_sales.emirate_id', 'lead_sales.emirate', 'lead_sales.nationality')
        ->Join(
            'plans',
            'plans.id',
            'lead_sales.plans'
        )
            ->where('lead_sales.id', $data->id)->first();
        //
        // $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'emirate' => $lead->emirate,
            'emirate_id' => $lead->emirate_id,
            'nationality' => $lead->nationality,
            // 'selected_number' => $lead->lead_type .' '. $lead->plan_name,
            // 'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            // 'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            // 'saler_name' => $lead->saler_name,
            // 'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => 923121337222,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        FunctionController::SendWhatsAppDesigner($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

    }
    //
    //
    public function ChatRequest(Request $request)
    {
        // return $request;
        // if($req)
        // $ld = lead_sale::
        // return $data = $request->saler_id;
        remark::create([
            'remarks' => $request->remarks,
            'lead_status' => '0',
            'lead_id' => $request->id,
            'source' => 'Chat Box',
            'lead_no' => $request->id,
            'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => auth()->user()->name,
            'user_agent_id' => auth()->user()->id,
        ]);
         $lead = lead_sale::where('id',$request->id)->first();
        // return
        if($lead->status == '1.15'){
            // return "ok";
            $ddm = lead_sale::where('customer_number', $lead->customer_number)
            ->whereNotIn('status', ['1.15','1.14','1.02'])
                ->where('is_allowed', 0)
                ->first();

            if ($ddm) {
                // return "s";

                return response()->json(['error' => ['Documents' => ['Request Already Proceed']]], 200);
            }
            $ddm1 = lead_sale::where('emirate_id', $lead->emirate_id)
            ->where('is_allowed', 0)
                // ->whereNot('saler_id', auth()->user()->id)
                ->whereNotIn('status', ['1.15','1.14','1.02'])

                ->first();
            if ($ddm1) {
                return response()->json(['error' => ['Documents' => ['Sudhar ja :) pehly hi lead bani hwi h bhai']]], 200);
            }
            $lead->status = '1.12';
            $lead->save();
            // return "ok nahi hwa";
            $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'plans.plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers', 'status_codes.status_name')
            ->Join(
                'plans',
                'plans.id',
                'lead_sales.plans'
            )
                ->Join(
                    'users',
                    'users.id',
                    'lead_sales.saler_id'
                )
                ->Join(
                    'call_centers',
                    'call_centers.call_center_code',
                    'users.agent_code'
                )

                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'lead_sales.status'
                )
                ->where('lead_sales.id', $lead->id)->first();
            //
            $link = route('view.lead', $lead->id);
            $details = [
                'lead_id' => $lead->id,
                'lead_no' => $lead->lead_no,
                'customer_name' => $lead->customer_name,
                'customer_number' => $lead->customer_number,
                'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
                'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
                'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
                'saler_name' => $lead->saler_name,
                'link' => $link,
                'agent_code' => auth()->user()->agent_code,
                'number' => $lead->numbers,
                'plan' => $lead->plan_name,
                'sim_type' => $lead->lead_type,
                // 'Plan' => $number,
                // 'AlternativeNumber' => $alternativeNumber,
            ];
            FunctionController::SendWhatsAppVerification($details);
            // return "Ok0";
            return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);

        }
        else{


        $uk = User::find($lead->saler_id);
        // return auth()->user()->id;
        $data =
            remark::select("remarks.date_time", 'users.name as user_agent', 'remarks.remarks')
            ->Join(
                'users',
                'users.id',
                'remarks.user_agent_id'
            )
            // ->where("remarks.user_agent_id", auth()->user()->id)
            ->where("remarks.lead_id", $request->id)
            ->get();
        if($lead->lead_type == 'HomeWifi'){
            $plan_name = HomeWifiPlan::where('id',$lead->plans)->first()->name;
        }else{
            $plan_name = Plan::where('id',$lead->plans)->first()->plan_name;
        }
        $remarks = 'Lead ID: ' . $request->id . ' => Message: ' . $request->remarks;        // event(new TaskEvent($remarks, $request->saler_id, $request->id, $uk->agent_code));
        // @role('sale')
        // \App\remarks_notification::create([
        //     'leadid' => $request->id,
        //     'userid' => auth()->user()->id,
        //     'remarks' => $request->remarks,
        //     'group_id' => $uk->agent_code,
        //     'notification_type' => 'Chat',
        //     'is_read' => '0',
        // ]);
        //
        // return $lead->id;
       $ntc = lead_sale::select('call_centers.notify_email', 'users.secondary_email', 'users.agent_code', 'call_centers.numbers', 'users.teamleader','users.phone', 'status_codes.status_name')
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
                ->Join(
                    'status_codes',
                    'status_codes.status_code',
                    'lead_sales.status'
                )
            ->where('lead_sales.id', $lead->id)->first();
        //
        $tl = User::where('id', $ntc->teamleader)->first();
        if($ntc->agent_code == 'CL9'){
            if ($tl) {
                    $wapnumber = '923121337222';

                // $wapnumber = $tl->phone . ',' .  $ntc->numbers . ',' .$ntc->phone;
            } else {
                $wapnumber = $ntc->numbers;
            }
        }else{
            if ($tl) {
                    $wapnumber = '923121337222';

                // $wapnumber = $tl->phone . ',' .  $ntc->numbers . ',' . $ntc->phone;
                // $wapnumber = $tl->phone . ',' .  $ntc->numbers;
            } else {
                $wapnumber = $ntc->numbers;
            }
        }

        $link = route('view.lead', $lead->id);
        $agent_code = $ntc->agent_code;
        // if($agent_code == 'CC3')
        //
        if ($lead->sim_type == 'HomeWifi') {
            $selected_number = 'HomeWifi';
        } else {
            $selected_number = $lead->selected_number;
        }
        // $selected_number = 'HomeWifi';

        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $selected_number,
            'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => $agent_code,
            'plan' => $plan_name,
            'sim_type' => $lead->lead_type,
            'number' => $wapnumber,
            'status' => $ntc->status_name,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        // $details = "";
        // return $details;
        $subject = "";
        FunctionController::SendWhatsApp($details);


        // \Mail::to($to)
        // ->cc(['salmanahmed334@gmail.com'])
        // ->queue(new \App\Mail\RemarksUpdate($details, $subject));
        // ChatController::EmailToVerification($lead->id,$details);
        // ChatController::EmailToNewCord($lead->id,$details,$lead->emirates);
        // ChatController::SendToWhatsApp($details);
        // if(auth()->user()->role != 'Emirate Coordinator'){

        // ChatController::SMSToNewCord($lead->id,$details,$lead->emirates,$sms_data);
        // ChatController::MySMSMachine($lead->id,$uk->agent_code, $sms_data);



        // {{route('view.lead',$detail['lead_id'])}}
        // url to open lead";


        // if(auth()->user()->role != 'sale')
        // event(new MyEvent($remarks, $request->saler_id,$request->id,$uk->agent_code));
        // else
        // return "Zoom
        return view('admin.chat.chat-load', compact('data'));
        }
    }
    //
    //
    public function ChatRequestFNE(Request $request)
    {
        // return $request;
        // return $data = $request->saler_id;
        \App\Models\remarks_fne::create([
            'remarks' => $request->remarks,
            // 'lead_status' => '0',
            'lead_id' => $request->id,
            'source' => 'FNE',
            // 'lead_no' => $request->id,
            'user_name' => auth()->user()->name,
            'user_id' => auth()->user()->id,
        ]);
        $lead = fne_data::where('id',$request->id)->first();

        // return
        $uk = User::where('id',$lead->saler_id)->first();
        // return auth()->user()->id;
         $data =
            \App\Models\remarks_fne::select("remarks_fne.created_at as date_time", 'users.name as user_agent', 'remarks_fne.remarks','users.id as user_id')
            ->Join(
                'users',
                'users.id',
                'remarks_fne.user_id'
            )
            // ->where("remarks.user_agent_id", auth()->user()->id)
            ->where("remarks_fne.lead_id", $request->id)
            ->get();

        $remarks = 'Lead ID: ' . $request->id . ' => Message: ' . $request->remarks;        // event(new TaskEvent($remarks, $request->saler_id, $request->id, $uk->agent_code));
        // @role('sale')
        // \App\remarks_notification::create([
        //     'leadid' => $request->id,
        //     'userid' => auth()->user()->id,
        //     'remarks' => $request->remarks,
        //     'group_id' => $uk->agent_code,
        //     'notification_type' => 'Chat',
        //     'is_read' => '0',
        // ]);
        //
        $data2 = user::select('email','teamleader','phone as agent_phone')->where('id', $lead->user_id)->first();

        // return $lead->id;
        $tl = User::where('id', $data2->teamleader)->first();
        if ($tl) {
            $wapnumber = '923121337222';

            // $wapnumber = $tl->phone . ',' . '923121337222,923453598420' . ',' . $data2->agent_phone;
            // } else {
            // $wapnumber = $ntc->numbers;
        } else {
            $wapnumber = '923121337222,923453598420';
        }
        // return $wapnumber;

         $MyData = [
            'agent_name' => $data2->email,
            'id' => $lead->id,
            'building' => $lead->building,
            'is_status' => $request->remarks,
            'numbers' => $wapnumber,
            'customer_name' => $lead->customer_name,
        ];
        \App\Http\Controllers\FunctionController::WhatsAppFNERequestUpdate($MyData);

        // $link = route('view.lead', $lead->id);
        // $agent_code = $ntc->agent_code;
        // if($agent_code == 'CC3')
        //
        // if ($lead->sim_type == 'HomeWifi') {
        //     $selected_number = 'HomeWifi';
        // } else {
        //     $selected_number = $lead->selected_number;
        // }
        // $selected_number = 'HomeWifi';

        // $details = [
        //     'lead_id' => $lead->id,
        //     'lead_no' => $lead->lead_no,
        //     // 'customer_name' => $lead->customer_name,
        //     // 'customer_number' => $lead->customer_number,
        //     // 'selected_number' => $selected_number,
        //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
        //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
        //     'saler_name' => $lead->saler_name,
        //     'link' => $link,
        //     'agent_code' => $agent_code,
        //     'plan' => $plan_name,
        //     'sim_type' => $lead->lead_type,
        //     'number' => $wapnumber,
        //     // 'Plan' => $number,
        //     // 'AlternativeNumber' => $alternativeNumber,
        // ];
        // // $details = "";
        // $subject = "";
        // FunctionController::SendWhatsApp($details);


        // \Mail::to($to)
        // ->cc(['salmanahmed334@gmail.com'])
        // ->queue(new \App\Mail\RemarksUpdate($details, $subject));
        // ChatController::EmailToVerification($lead->id,$details);
        // ChatController::EmailToNewCord($lead->id,$details,$lead->emirates);
        // ChatController::SendToWhatsApp($details);
        // if(auth()->user()->role != 'Emirate Coordinator'){

        // ChatController::SMSToNewCord($lead->id,$details,$lead->emirates,$sms_data);
        // ChatController::MySMSMachine($lead->id,$uk->agent_code, $sms_data);



        // {{route('view.lead',$detail['lead_id'])}}
        // url to open lead";


        // if(auth()->user()->role != 'sale')
        // event(new MyEvent($remarks, $request->saler_id,$request->id,$uk->agent_code));
        // else
        // return "Zoom
        return view('admin.chat.chat-load-fne', compact('data'));
    }
    //

    //
    public function FixedSubmitRFS(Request $request){
        // return $request;
        $validatedData = Validator::make($request->all(), [
            'address' => 'required|string',
            'building' => 'required|string',
            // 'customer_name' => 'required',
            'plans' => 'required',
            'building' => 'required|string',
            'unit' => 'required',
            'google_location' => 'required|string|url',
            // 'customer_number' => 'required|string',
            'fiveg_number' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_number' => 'required|digits_between:6,10|numeric',
            'alternative_number' => 'required',
            // 'emirate_id' => 'required',
            'emirate_id' => 'required_if:leadtype,HomeWifi',
            // "emirate_id" => "required_if:leadtype,HomeWifi",
            'gender' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'language' => 'required',
            'emirate' => 'required',
            'remarks' => 'required',
            'plans' => 'required',
            'emirate_expiry' => 'required_if:leadtype,HomeWifi',
            'dob' => ['required_if:leadtype,HomeWifi']
        ]);
        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()->all()]);
        }
        if ($request->contact_number === $request->fiveg_number) {
            return response()->json(['error' => ['Documents' => ['5G and Customer Number Need to Be Unique']]], 200);
        }
        if ($request->plans == 6 || $request->plans == 7) {
            if ($request->expiry == '') {
                return response()->json(['error' => ['Documents' => ['5G Expiry is Mandatory']]], 200);
            }
        }
        if($request->leadtype == 'FNE'){
            $ddm = fne_data::where('customer_number', $request->contact_number)
                // ->whereNotIn('status', ['1.15','1.14','1.02'])
                // ->where('is_allowed', 0)
                ->first();

            if ($ddm) {
                return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer Number']]], 200);
            }
            $fned = fne_data::create([
                'customer_name' => $request->full_name,
                'plan' => $request->plans,
                'expiry' => $request->expiry,
                'address' => $request->address,
                'building' => $request->building,
                'unit' => $request->unit,
                'google_location' => $request->google_location,
                'customer_number' => $request->contact_number,
                '5g_number' => $request->fiveg_number,
                'user_id' => auth()->user()->id,
                'is_status' => 'Pending',
                'account_id' => $request->account_id,
                'lat' => $request->lat_final,
                'lng' => $request->lng_final,
            ]);
            $MyData = [
                'address' => $request->address,
                'building' => $request->building,
                'unit' => $request->unit,
                'google_location' => $request->google_location,
                '5g_number' => $request->fiveg_number,
                'customer_number' => $request->customer_number,
                'numbers' => '923121337222,923453598420'
            ];
            // return response()->json(['error' => ['Documents' => [$fnde->id]]], 200);
            \App\Http\Controllers\FunctionController::WhatsAppFNERequest($MyData);

            // if ($request->plans == 1 || $request->plans == 2 || $request->plans == 3) {
            //     if ($request->is_old == '') {
            //         return response()->json(['error' => ['Documents' => ['Lead new h?? ya Old']]], 200);
            //     }
            // } else {
            //     if (empty($request->fne_req)) {
            //         return response()->json(['error' => ['Documents' => ['Kindly Select FNE Request for proceeding lead ']]], 200);
            //     }
            // }

            $ddm = lead_sale::where('customer_number', $request->contact_number)
                ->whereNotIn('status', ['1.15','1.14','1.02'])
                ->where('is_allowed', 0)
                ->first();

            if ($ddm) {

                return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer Number']]], 200);
            }
            // $ddm1 = lead_sale::where('emirate_id', $request->emirate_id)
            // ->where('is_allowed', 0)
            // // ->whereNot('saler_id', auth()->user()->id)
            // ->whereNotIn('status', ['1.15','1.14','1.02'])

            // ->first();
            // if ($ddm1) {
            //     return response()->json(['error' => ['Documents' => ['Request Already Proceed, Under Customer ID']]], 200);
            // }
            //

            //

            // $ddm2 = lead_sale::where('emirate_id', $request->emirate_id)
            // ->where('is_allowed', 0)
            // ->whereNotIn('status', ['1.15','1.14','1.02'])

            // // ->whereNot('saler_id', auth()->user()->id)
            // ->where('nationality', $request->nationality)->first();
            // if ($ddm2) {

            //     return response()->json(['error' => ['Documents' => ['Bola na already proceed']]], 200);
            // }
            //
            // $data = Carbon::
            //
            // return $request->leadnumber;
            $data = lead_sale::create([
                'lead_no' => $request->leadnumber,
                'customer_name' => $request->full_name,
                'email' => $request->email,
                'customer_number' => $request->contact_number,
                'alternative_number' => $request->alternative_number,
                'emirate_id' => $request->emirate_id,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'emirate' => $request->emirate,
                'plans' => $request->plans,
                'language' => $request->language,
                'emirate_expiry' => $request->emirate_expiry,
                'dob' => $request->dob,
                'status' => '1.13',
                'saler_name' => auth()->user()->name,
                'saler_id' => auth()->user()->id,
                'lead_type' => 'HomeWifi',
                'lead_date' => Carbon::now()->toDateTimeString(),
                'remarks' => $request->remarks,
                'shared_with' => $request->shared_with,
                'is_old' => $request->is_old,
                'lead_reff' => $fned->id,
                'data_lead_id' => $request->logsystemid,
                'reff_base' => $request->reff_base,
            ]);


            remark::create([
                'remarks' => $request->remarks,
                'lead_status' => '1.13',
                'lead_id' => $data->id,
                'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
                'user_agent' => 'Sale',
                'user_agent_id' => auth()->user()->id,
            ]);
            //
            \App\Models\remarks_fne::create([
                'remarks' => $request->remarks,
                // 'lead_status' => '0',
                'lead_id' => $fned->id,
                'source' => 'FNE',
                // 'lead_no' => $request->id,
                'user_name' => auth()->user()->name,
                'user_id' => auth()->user()->id,
            ]);
            // $lead = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','home_wifi_plans.name as plan_name','lead_sales.saler_name')
            // ->Join(
            //     'home_wifi_plans','home_wifi_plans.id','lead_sales.plans'
            // )
            // ->where('lead_sales.id',$data->id)->first();
            // //
            // $link = route('view.lead', $lead->id);
            // $details = [
            //     'lead_id' => $lead->id,
            //     'lead_no' => $lead->lead_no,
            //     'customer_name' => $lead->customer_name,
            //     'customer_number' => $lead->customer_number,
            //     'selected_number' => 'HomeWifi' .' '. $lead->plan_name,
            //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            //     'saler_name' => $lead->saler_name,
            //     'link' => $link,
            //     'agent_code' => auth()->user()->agent_code,
            //     'number' => 923121337222,
            //     // 'Plan' => $number,
            //     // 'AlternativeNumber' => $alternativeNumber,
            // ];
            // return FunctionController::SendWhatsApp($details);
            $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
            ->Join(
                'home_wifi_plans',
                'home_wifi_plans.id',
                'lead_sales.plans'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
            //
            $link = route('view.lead', $lead->id);
            $details = [
                'lead_id' => $lead->id,
                'lead_no' => $lead->lead_no,
                'customer_name' => $lead->customer_name,
                'customer_number' => $lead->customer_number,
                'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
                'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
                'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
                'saler_name' => $lead->saler_name,
                'link' => $link,
                'agent_code' => auth()->user()->agent_code,
                'number' => $lead->numbers . ',923453598420',
                'plan' => $lead->plan_name,
                'sim_type' => $lead->lead_type,
                // 'Plan' => $number,
                // 'AlternativeNumber' => $alternativeNumber,
            ];
            FunctionController::SendWhatsAppVerification($details);


            //
            // $remarks = remark::create
            return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
        }



    }
    //
    public function WhatsAppProceed(Request $request){
        // return $request;
        $data = lead_sale::findorfail($request->leadid);
        $data->status = '1.05';
        $data->save();
        $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
        ->Join(
            'home_wifi_plans',
            'home_wifi_plans.id',
            'lead_sales.plans'
        )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            ->Join(
                'call_centers',
                'call_centers.call_center_code',
                'users.agent_code'
            )
            ->where('lead_sales.id', $data->id)->first();
        //
        $link = route('view.lead', $lead->id);
        $details = [
            'lead_id' => $lead->id,
            'lead_no' => $lead->lead_no,
            'customer_name' => $lead->customer_name,
            'customer_number' => $lead->customer_number,
            'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
            'remarks' =>  'Lead Verified on WhatsApp Please do Review and Make Tracking ID ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
            'remarks_final' => 'Lead Verified on WhatsApp Please do Review and Make Tracking ID ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
            'saler_name' => $lead->saler_name,
            'link' => $link,
            'agent_code' => auth()->user()->agent_code,
            'number' => $lead->numbers,
            'plan' => $lead->plan_name,
            'sim_type' => $lead->lead_type,
            // 'Plan' => $number,
            // 'AlternativeNumber' => $alternativeNumber,
        ];
        remark::create([
            'remarks' => 'Lead Verified on WhatsApp Please do Review and Make Tracking ID',
            'lead_status' => '1.05',
            'lead_id' => $data->id,
            'lead_no' => $data->id, 'date_time' => $current_date_time = Carbon::now()->toDateTimeString(), // Produces something like "2019-03-11 12:25:00"
            'user_agent' => auth()->user()->name,
            'user_agent_id' => auth()->user()->id,
        ]);
        // \App\Http\Controllers\ReportController::InitiateWhatsAppVerification($l);
        FunctionController::SendWhatsAppVerification($details);


        //
        // $remarks = remark::create
        return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
    public function ResendMessage(Request $request){


        $str_to_replace = '971';

        // $input_str = '9715088880Z9714088880Z8088880Z';

        $l =  $output_str = $str_to_replace . substr(
                $request->contact_number,
                1
            );
        \App\Http\Controllers\ReportController::InitiateWhatsAppVerification($l);
        // $lead = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'home_wifi_plans.name as plan_name', 'lead_sales.saler_name', 'lead_sales.lead_type', 'call_centers.numbers')
        //     ->Join(
        //         'home_wifi_plans',
        //         'home_wifi_plans.id',
        //         'lead_sales.plans'
        //     )
        //     ->Join(
        //         'users',
        //         'users.id',
        //         'lead_sales.saler_id'
        //     )
        //     ->Join(
        //         'call_centers',
        //         'call_centers.call_center_code',
        //         'users.agent_code'
        //     )
        //     ->where('lead_sales.id', $request->id)->first();
        // //
        // $link = route('view.lead', $request->id);
        // $details = [
        //     'lead_id' => $lead->id,
        //     'lead_no' => $lead->lead_no,
        //     'customer_name' => $lead->customer_name,
        //     'customer_number' => $lead->customer_number,
        //     'selected_number' => $lead->lead_type . ' ' . $lead->plan_name,
        //     'remarks' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')',
        //     'remarks_final' => $request->remarks . ' ' . ' Remarks By ' . auth()->user()->name . ' (' .  auth()->user()->email . ')' . ' => Agent Name: ' . $lead->saler_name,
        //     'saler_name' => $lead->saler_name,
        //     'link' => $link,
        //     'agent_code' => auth()->user()->agent_code,
        //     'number' => $lead->numbers . ',923453598420,923422708646',
        //     'plan' => $lead->plan_name,
        //     'sim_type' => $lead->lead_type,
        //     // 'Plan' => $number,
        //     // 'AlternativeNumber' => $alternativeNumber,
        // ];
        // // $mynum = str_replace('1')
        // $str_to_replace = '971';

        // // $input_str = '9715088880Z9714088880Z8088880Z';

        // $l =  $output_str = $str_to_replace . substr(
        //     $lead->customer_number,
        //     1
        // );
        // \App\Http\Controllers\ReportController::InitiateWhatsAppVerification($l);
        // FunctionController::SendWhatsAppVerification($details);


        // //
        // // $remarks = remark::create
        // return response()->json(['success' => 'Added new records, please wait meanwhile we are redirecting you....!!!']);
    }
}
