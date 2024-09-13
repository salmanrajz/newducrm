<?php

namespace App\Http\Controllers;

use App\Models\dnclist;
use App\Models\fne_data_manager_assigners;
use App\Models\fne_data_user_assigner;
use App\Models\main_data_manager_assigner;
use App\Models\main_data_user_assigner;
use App\Models\User;
use App\Models\WhatsAppMnpBank;
use App\Models\fne_number_bank;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NumberAssigner extends Controller
{

    //
    public function TransferNumber(Request $request)
    {
       $data = User::select('id','agent_code','email')->whereIn('users.role', ['NumberAdmin', 'sale'])
        ->whereIn('agent_code', ['CL1', 'CL1'])
        ->whereIn('email', ['asadali@cl1.com'])
        // ,'asadali@cl1.com', 'amnaayaz@cl1.com', 'huzaifashahid@cl1.com', 'M.osama@cl1.com','Abdullah@cl1.com','asadarshad@cl1.com', 'ahmedelsheikh@cl1.com'
        ->get();
        if ($data->count() > 0) {
            $ManagerID = User::select('id')->whereIn('users.role', ['Manager'])
            ->whereIn('agent_code', ['CL1', 'CL1'])
            ->first();
            // return $ManagerID;
            $limit = $data->count() * 250;
           $bank = WhatsAppMnpBank::select('id', 'number', 'is_status')->where('is_status',0)->limit($limit)->get();
            foreach ($bank as $k) {
                //
                // return $limit;
                // return $ManagerID;
                $checker = main_data_manager_assigner::where('manager_id', $ManagerID->id)
                    // ->whereNull('status')
                    ->where('status',0)
                    ->whereDate('created_at', Carbon::today())
                    ->get()->count();
                // if($checker > $limit){
                //     return "Checker Bigger than Limit";
                // }else{
                //     return "Bigger Than Checker, am i limit?";
                // }
                if ($checker < $limit) {
                    //
                    // return "D";
                    // $d = dnclist::where('number', '=', $k->number)->first();
                    //
                    // if($)
                    if (!dnclist::where('number', '=', $k->number)->exists()) {
                        //
                        // return "Non Exist";
                        $ks = main_data_manager_assigner::create([
                            'number_id' => $k->id,
                            'manager_id' => $ManagerID->id,
                            'call_center' => $ManagerID->id,
                            // 'status' => '',
                        ]);
                        $kk = WhatsAppMnpBank::where('id', $k->id)->first();
                        if($kk){

                            $kk->is_status = '1';
                            $kk->save();
                        }
                    }
                }
                // else{
                //     return "Limit";
                // }
            }
            // return "Rik";
            foreach ($data as $d) {
                // return $d->id;
                // foreach
                // return $d;
                $checker = main_data_manager_assigner::where('manager_id', $ManagerID->id)->whereNull('status')->get();
                foreach ($checker as $cc) {
                    $csr = main_data_user_assigner::where('user_id', $d->id)->whereNull('status')->get();
                    if ($csr->count() < 100) {
                        // echo "1";
                        $ks = main_data_user_assigner::create([
                            'number_id' => $cc->number_id,
                            'user_id' => $d->id,
                            'call_center' => $d->id,
                            // 'status' => '',
                        ]);
                        //
                        $k = main_data_manager_assigner::where('number_id', $cc->number_id)->where('manager_id', $ManagerID->id)->first();
                        if($k){
                            $k->status = '1';
                            $k->save();
                        }
                    }
                }
            }
            return "Clear";
        }
    }
    //
    public function my_call_log(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'main_data_user_assigners_1.id', 'main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number_id as num_id')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
            // ->where
            ->where('whats_app_mnp_banks_1.data_valid_from', 'AAMTData')
            ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('pcat','normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->whereIn('whats_app_mnp_banks_1.soft_dnd', ['54', '054','056','56','50','050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('main_data_user_assigners_1.status','Follow up')
            ->whereNull('main_data_user_assigners_1.status')
            ->Orderby('main_data_user_assigners_1.id', 'asc')
            ->groupBy('whats_app_mnp_banks_1.number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('agent.add-log', compact('k'));
    }
    //
    //
    public function my_call_log_expired(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'main_data_user_assigners_1.id', 'main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number_id as num_id', 'whats_app_mnp_banks_1.cname', 'whats_app_mnp_banks_1.nationality', 'whats_app_mnp_banks_1.activation_date')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        ->where('whats_app_mnp_banks_1.data_valid_from', '5GData')
            ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('pcat','normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->whereIn('whats_app_mnp_banks_1.soft_dnd', ['54', '054','056','56','50','050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('main_data_user_assigners_1.status','Follow up')
            ->whereNull('main_data_user_assigners_1.status')
            ->Orderby('main_data_user_assigners_1.id', 'asc')
            ->groupBy('whats_app_mnp_banks_1.number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('agent.add-log-expired', compact('k'));
    }
    //
    //
    public function fne_call_log(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = fne_number_bank::select('fne_number_banks.customer_number as number', 'fne_data_user_assigners.id', 'fne_data_user_assigners.number_id', 'fne_data_user_assigners.status', 'fne_number_banks.activation_date', 'fne_number_banks.customer_name as cname', 'fne_number_banks.account_id', 'fne_number_banks.plan_name', 'fne_number_banks.nationality','fne_number_banks.system_id')
        ->Join(
            'fne_data_user_assigners',
            'fne_data_user_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where
            ->where('fne_data_user_assigners.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('fne_number_banks.lead_type', '5G_EXPIRED')

            // ->where('pcat', 'normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('fne_number_banks.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('fne_data_user_assigners.status','Follow up')
            ->whereNull('fne_data_user_assigners.status')
            ->Orderby('fne_data_user_assigners.id', 'asc')
            ->groupBy('fne_number_banks.customer_number')

            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.add-log-fne', compact('k'));
    }
    //
    public function fne_call_log_future(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = fne_number_bank::select('fne_number_banks.customer_number as number', 'fne_data_user_assigners.id', 'fne_data_user_assigners.number_id', 'fne_data_user_assigners.status', 'fne_number_banks.activation_date', 'fne_number_banks.customer_name as cname', 'fne_number_banks.account_id', 'fne_number_banks.plan_name', 'fne_number_banks.nationality','fne_number_banks.system_id')
        ->Join(
            'fne_data_user_assigners',
            'fne_data_user_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where
            ->where('fne_data_user_assigners.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('fne_number_banks.lead_type', '5G_EXPIRED_Future')

            // ->where('pcat', 'normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('fne_number_banks.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('fne_data_user_assigners.status','Follow up')
            ->whereNull('fne_data_user_assigners.status')
            ->Orderby('fne_data_user_assigners.id', 'asc')
            ->groupBy('fne_number_banks.customer_number')

            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.add-log-fne', compact('k'));
    }
    //
    //
    public function used_fne_call_log(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = fne_number_bank::select('fne_number_banks.customer_number as number', 'fne_data_user_assigners.id', 'fne_data_user_assigners.number_id', 'fne_data_user_assigners.status', 'fne_number_banks.activation_date', 'fne_number_banks.customer_name as cname', 'fne_number_banks.account_id', 'fne_number_banks.plan_name', 'fne_number_banks.nationality','fne_number_banks.system_id')
        ->Join(
            'fne_data_user_assigners',
            'fne_data_user_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where
            ->where('fne_data_user_assigners.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->whereIn('fne_number_banks.lead_type', ['5G_EXPIRED', '5G_EXPIRED_Future'])

            // ->where('pcat', 'normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('fne_number_banks.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('fne_data_user_assigners.status','Follow up')
            ->whereNotNull('fne_data_user_assigners.status')
            ->Orderby('fne_data_user_assigners.id', 'asc')
            ->groupBy('fne_number_banks.customer_number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.used-log-fne', compact('k'));
    }
    //
    //
    public function used_work_call_log(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = fne_number_bank::select('fne_number_banks.customer_number as number', 'fne_data_user_assigners.id', 'fne_data_user_assigners.number_id', 'fne_data_user_assigners.status', 'fne_number_banks.activation_date', 'fne_number_banks.customer_name as cname', 'fne_number_banks.account_id', 'fne_number_banks.plan_name', 'fne_number_banks.nationality','fne_number_banks.system_id')
        ->Join(
            'fne_data_user_assigners',
            'fne_data_user_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where
            ->where('fne_data_user_assigners.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('fne_number_banks.lead_type', 'ORDER_READY')

            // ->where('pcat', 'normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('fne_number_banks.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('fne_data_user_assigners.status','Follow up')
            ->whereNotNull('fne_data_user_assigners.status')
            ->Orderby('fne_data_user_assigners.id', 'asc')
            ->groupBy('fne_number_banks.customer_number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.used-log-fne', compact('k'));
    }
    //
    //
    public function order_call_log(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = fne_number_bank::select('fne_number_banks.customer_number as number', 'fne_data_user_assigners.id', 'fne_data_user_assigners.number_id', 'fne_data_user_assigners.status', 'fne_number_banks.activation_date', 'fne_number_banks.customer_name as cname', 'fne_number_banks.account_id', 'fne_number_banks.plan_name', 'fne_number_banks.nationality','fne_number_banks.system_id')
        ->Join(
            'fne_data_user_assigners',
            'fne_data_user_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where
            ->where('fne_data_user_assigners.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('fne_number_banks.lead_type', 'ORDER_READY')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('fne_number_banks.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('fne_data_user_assigners.status','Follow up')
            ->whereNull('fne_data_user_assigners.status')
            ->Orderby('fne_data_user_assigners.id', 'asc')
            ->groupBy('fne_number_banks.customer_number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.add-log-order', compact('k'));
    }
    //
    //
    public function user_order_call_log(Request $request)
    {
        $myrole = auth()->user()->agent_code;
        $k = fne_number_bank::select('fne_number_banks.customer_number as number', 'fne_data_user_assigners.id', 'fne_data_user_assigners.number_id', 'fne_data_user_assigners.status', 'fne_number_banks.activation_date', 'fne_number_banks.customer_name as cname', 'fne_number_banks.account_id', 'fne_number_banks.plan_name', 'fne_number_banks.nationality','fne_number_banks.system_id')
        ->Join(
            'fne_data_user_assigners',
            'fne_data_user_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where
            ->where('fne_data_user_assigners.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('fne_number_banks.lead_type', 'ORDER_READY')

            // ->where('pcat', 'normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('fne_number_banks.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('fne_data_user_assigners.status','Follow up')
            ->whereNotNull('fne_data_user_assigners.status')
            ->Orderby('fne_data_user_assigners.id', 'asc')
            ->groupBy('fne_number_banks.customer_number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.used-log-order', compact('k'));
    }
    //
    //
    public function my_call_log_4g(Request $request)
    {
        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'main_data_user_assigners_1.id', 'main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.account_id', 'whats_app_mnp_banks_1.cname', 'whats_app_mnp_banks_1.activation_date', 'whats_app_mnp_banks_1.nationality')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
            // ->where
            ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('pcat', '4G')
            // ->where('main_data_user_assigners_1.status','Follow up')
            ->whereNull('main_data_user_assigners_1.status')
            ->Orderby('main_data_user_assigners_1.id', 'asc')
            ->groupBy('whats_app_mnp_banks_1.number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.add-log-jee', compact('k'));
    }
    //
    public function admin_dashboard(Request $request){
        $myrole = auth()->user()->role;
        $data = main_data_user_assigner::select(\DB::raw('count(main_data_user_assigners_1.status) as count'), 'main_data_user_assigners_1.status')
            ->Join(
                'users',
                'users.id',
                'main_data_user_assigners_1.user_id'
            )
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'TeamLeader') {
                    return $query->where('users.teamleader', auth()->user()->id);
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                } elseif ($myrole == 'FloorManagerHead') {
                    return $query->where('users.teamleader', auth()->user()->tlid);
                } else if ($myrole == 'FloorManager') {
                    return $query->where('users.agent_code', auth()->user()->agent_code);
                }
            })
            // ->where('users.agent_code',auth()->user()->agent_code)
            ->WhereNotNull('main_data_user_assigners_1.status')
            ->groupby('main_data_user_assigners_1.status')
            ->get();
        //
        return view('admin.lead.mnp-dashboard', compact('data'));

    }
    //
    public function tl_call_log(Request $request)
    {
        $myrole = auth()->user()->role;
        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'main_data_user_assigners_1.id', 'main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'main_data_user_assigners_1.other_remarks','users.name')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        ->Join(
            'users','users.id','main_data_user_assigners_1.user_id'
        )
            ->when(
                $myrole,
                function ($query) use ($myrole) {
                if ($myrole == 'TeamLeader') {
                    return $query->where('users.teamleader', auth()->user()->id);
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                } elseif ($myrole == 'FloorManagerHead') {
                    return $query->where('users.teamleader', auth()->user()->tlid);
                } else if ($myrole == 'FloorManager') {
                    return $query->where('users.agent_code', auth()->user()->agent_code);
                } else {
                    // return $query->where('users.id', auth()->user()->id);
                }
            })
            ->whereNull('main_data_user_assigners_1.remarks_by_tl')
            ->where('is_status', '1')
            ->where('main_data_user_assigners_1.status','Follow up')
        // ->whereMonth
            ->whereDate('main_data_user_assigners_1.updated_at', Carbon::today())
            // ->whereDate('main_data_user_assigners_1.updated_at', Carbon::now()->submonth())
            // ->whereYear('activation_forms.created_at', Carbon::now()->year)
            // ->whereNull('main_data_user_assigners_1.status')
            ->Orderby('id', 'desc')
            ->groupBy('whats_app_mnp_banks_1.number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.tl-add-log', compact('k'));
    }
    //
    //
    public function cancel_call_log(Request $request)
    {
        $myrole = auth()->user()->role;
        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'main_data_user_assigners_1.id', 'main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'main_data_user_assigners_1.other_remarks','users.name', 'main_data_user_assigners_1.remarks_by_tl')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        ->Join(
            'users','users.id','main_data_user_assigners_1.user_id'
        )
            ->when(
                $myrole,
                function ($query) use ($myrole) {
                if ($myrole == 'TeamLeader') {
                    return $query->where('users.teamleader', auth()->user()->id);
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                } elseif ($myrole == 'FloorManagerHead') {
                    return $query->where('users.teamleader', auth()->user()->tlid);
                } else if ($myrole == 'FloorManager') {
                    return $query->where('users.agent_code', auth()->user()->agent_code);
                } else {
                    // return $query->where('users.id', auth()->user()->id);
                }
            })
            // ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('main_data_user_assigners_1.remarks_by_tl','No Need')
        // ->whereMonth
            ->whereDate('main_data_user_assigners_1.updated_at', Carbon::today())
            // ->whereDate('main_data_user_assigners_1.updated_at', Carbon::now()->submonth())
            // ->whereYear('activation_forms.created_at', Carbon::now()->year)
            // ->whereNull('main_data_user_assigners_1.status')
            ->Orderby('id', 'desc')
            ->groupBy('whats_app_mnp_banks_1.number')
            ->paginate();
        // $k =  number_assigner::where('user_id',auth()->user()->id)->paginate();
        return view('admin.call.tl-cancel-log', compact('k'));
    }
    //
    //
    public function submit_feedback_number(Request $request)
    {

        $k = main_data_user_assigner::where('number_id', $request->number_id)->first();
        $k->status = $request->status;
        $k->other_remarks = $request->other_remarks;
        if ($request->status == 'DNC') {
            $k->mark_dnd = 1;
        }
        if ($request->status == 'soft_dnd') {
            $k->mark_soft_dnd = 1;
        }
        $k->user_id = auth()->user()->id;
        $k->save();
        $details = [
            'numbers' => '923121337222,923123500256',
            'dnc_number' => $request->number,
        ];
        if ($request->status == 'DNC') {
            \App\Http\Controllers\FunctionController::DNCWhatsApp($details);
        }
        return 1;
    }
    //
    //
    public function submit_feedback_number_fne(Request $request)
    {
        // return $request;
        // return $request->status;
        // $k->other_remarks = $request->other_remarks;
        if($request->status == 'NewFNELead' || $request->status == 'UpgradeFNELead'){
            // Session::put('systemid', $request->systemid);
            // $request->session()->put('systemid', $request->systemid);
            session()->put('systemid', $request->systemid);
            session()->put('status', $request->status);
            // echo $request->session()->get('systemid');
            // return
            // return "what";

        }
        else{
            // $request->session()->put('systemid', 'Salman');
            session()->put('systemid', 'salman');
        }
         $k = fne_data_user_assigner::where('number_id', $request->number_id)->first();
        $k->status = $request->status;
        if ($request->status == 'DNC') {
            $k->mark_dnd = 1;
        }
        if ($request->status == 'soft_dnd') {
            $k->mark_soft_dnd = 1;
        }
        $k->user_id = auth()->user()->id;
        $k->save();
        $details = [
            'numbers' => '923121337222,923123500256',
            'dnc_number' => $request->number,
        ];
        if ($request->status == 'DNC') {
            \App\Http\Controllers\FunctionController::DNCWhatsApp($details);
        }
        return 1;
    }
    //
    public function submit_feedback_number_tl(Request $request)
    {
        // return $request;
        // $b = uploaderdatabank::select('uploaderdatabank.*')
        // ->Join(
        //     'main_data_manager_assigners_1',
        //     'main_data_manager_assigners_1.number_id',
        //     'uploaderdatabank.id'
        // )
        // ->where('uploaderdatabanks.number',$request->number)
        // // ->where('main_data_manager_assigners_1.manager_id', auth()->user()->id)
        // // ->where('status_1', '1')
        // 050-XXX-XX-312
        // // ->whereNull('main_data_manager_assigners_1.status')
        // // ->Orderby('id', 'desc')
        // ->first();
        // $b
        $k = main_data_user_assigner::where('number_id', $request->number_id)->first();
        $k->remarks_by_tl = $request->status;
        $k->other_remarks = $request->other_remarks;
        // $k->other_remarks = $request->other_remarks;
        if ($request->status == 'DNC') {
            $k->mark_dnd = 1;
        }
        if ($request->status == 'soft_dnd') {
            $k->mark_soft_dnd = 1;
        }
        // $k->user_id = auth()->user()->id;
        $k->save();
        $details = [
            'numbers' => '923121337222,923123500256',
            'dnc_number' => $request->number,
        ];
        if ($request->status == 'DNC') {
            \App\Http\Controllers\FunctionController::DNCWhatsApp($details);
        }
        return 1;
    }
    //
    public function MyLogDashboard(Request $request){
        // return $request;
        $myrole = auth()->user()->role;
        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'main_data_user_assigners_1.id', 'main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number_id as num_id', 'whats_app_mnp_banks_1.cname', 'whats_app_mnp_banks_1.nationality', 'whats_app_mnp_banks_1.activation_date')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        ->where('whats_app_mnp_banks_1.data_valid_from', 'AAMTData')
            ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('pcat', 'normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('whats_app_mnp_banks_1.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('main_data_user_assigners_1.status','Follow up')
            ->whereNotNull('main_data_user_assigners_1.status')
            ->Orderby('main_data_user_assigners_1.id', 'asc')
            ->groupBy('whats_app_mnp_banks_1.number')
            ->paginate();
        return view('admin.lead.mnp-dashboard', compact('k'));
        //
    }
    //
    //
    public function MyLogDashboardExpired(Request $request){
        // return $request;
        $myrole = auth()->user()->role;
        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number', 'main_data_user_assigners_1.id', 'main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number_id as num_id', 'whats_app_mnp_banks_1.cname', 'whats_app_mnp_banks_1.nationality', 'whats_app_mnp_banks_1.activation_date')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        ->where('whats_app_mnp_banks_1.data_valid_from', '5GData')
            ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('pcat', 'normal')
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('whats_app_mnp_banks_1.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })

            // ->where('main_data_user_assigners_1.status','Follow up')
            ->whereNotNull('main_data_user_assigners_1.status')
            ->Orderby('main_data_user_assigners_1.id', 'asc')
            ->groupBy('whats_app_mnp_banks_1.number')
            ->paginate();
        return view('admin.lead.mnp-dashboard', compact('k'));
        //
    }
    //
    public function MyLogDashboard4g(Request $request){
        // return $request;
        $myrole = auth()->user()->role;
        $data = main_data_user_assigner::select(\DB::raw('count(main_data_user_assigners_1.status) as count'), 'main_data_user_assigners_1.status')
        ->Join(
            'users',
            'users.id',
            'main_data_user_assigners_1.user_id'
        )
        ->when($myrole, function ($query) use ($myrole) {
            if ($myrole == 'FloorManager') {
                return $query->where('users.agent_code', auth()->user()->agent_code);
            } else {
                return $query->where('users.id', auth()->user()->id);
            }
            // else if($myrole == 'KHICordination'){
            //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
            // }
            // else {
            //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
            // }
        })
            // ->where('users.agent_code',auth()->user()->agent_code)
            ->WhereNotNull('main_data_user_assigners_1.status')
            ->groupby('main_data_user_assigners_1.status')
            ->get();
        return view('admin.lead.mnp-dashboard', compact('data'));
        //
    }
    //
    public function loadmnpdatacc(Request $request)
    {
        $month = $request->status;
        $cc = $request->cc;
        // $k = explode('-',$sp);
        // $month = $k['0'];
        // $cc = $k['1'];
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin') {
            return view('dashboard.ajax.admin-mnp-dashboard-load', compact('month', 'cc'));
        } else {
            return view('dashboard.ajax.mnp-dashboard-load', compact('month'));
        }
    }
    //
    public static function StatusCampaignCount($status, $month)
    {
        $myrole = auth()->user()->role;
        // $status =
        if ($status == 'data-assigned') {
            return $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
            ->Join(
                'users',
                'users.id',
                'main_data_user_assigners_1.user_id'
            )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })
                ->when($myrole, function ($query) use ($myrole) {
                    if ($myrole == 'TeamLeader') {
                        return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    } elseif ($myrole == 'FloorManagerHead') {
                        return $query->where('users.teamleader', auth()->user()->tlid);
                    } else if ($myrole == 'FloorManager') {
                        return $query->where('users.agent_code', auth()->user()->agent_code);
                    } else {
                        return $query->where('users.id', auth()->user()->id);
                    }
                })
                // ->WhereNotNull('main_data_user_assigners_1.status')
                // ->where('main_data_user_assigners_1.status', $status)
                ->get()->count();
        } elseif ($status == 'data-used') {
            return $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
            ->Join(
                'users',
                'users.id',
                'main_data_user_assigners_1.user_id'
            )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })
                ->when($myrole, function ($query) use ($myrole) {
                    if ($myrole == 'TeamLeader') {
                        return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    } elseif ($myrole == 'FloorManagerHead') {
                        return $query->where('users.teamleader', auth()->user()->tlid);
                    } else if ($myrole == 'FloorManager') {
                        return $query->where('users.agent_code', auth()->user()->agent_code);
                    } else {
                        return $query->where('users.id', auth()->user()->id);
                    }
                })
                ->WhereNotNull('main_data_user_assigners_1.status')
                // ->whereNotNull('main_data_user_assigners_1.status')
                ->get()->count();
        } elseif ($status == 'data-available') {
            return $remaining = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
            ->Join(
                'users',
                'users.id',
                'main_data_user_assigners_1.user_id'
            )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })
                ->when($myrole, function ($query) use ($myrole) {
                    if ($myrole == 'TeamLeader') {
                        return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    } elseif ($myrole == 'FloorManagerHead') {
                        return $query->where('users.teamleader', auth()->user()->tlid);
                    } else if ($myrole == 'FloorManager') {
                        return $query->where('users.agent_code', auth()->user()->agent_code);
                    } else {
                        return $query->where('users.id', auth()->user()->id);
                    }
                })
                ->WhereNull('main_data_user_assigners_1.status')
                // ->whereNotNull('main_data_user_assigners_1.status')
                ->get()->count();
        } else {
            return $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
            ->Join(
                'users',
                'users.id',
                'main_data_user_assigners_1.user_id'
            )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->when($myrole, function ($query) use ($myrole) {
                    if ($myrole == 'TeamLeader') {
                        return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    } elseif ($myrole == 'FloorManagerHead') {
                        return $query->where('users.teamleader', auth()->user()->tlid);
                    } else if ($myrole == 'FloorManager') {
                        return $query->where('users.agent_code', auth()->user()->agent_code);
                    } else {
                        return $query->where('users.id', auth()->user()->id);
                    }
                })
                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })
                ->WhereNotNull('main_data_user_assigners_1.status')
                ->where('main_data_user_assigners_1.status', $status)
                ->get()->count();
        }
    }
    //
    public function dashboard_status(Request $request)
    {
        // return $request->status;
        if ($request->status == 'Follow-up') {
            $status = 'Follow up';
        }
        // else if ($request->status == 'Follow up') {
        //     $status = 'Follow up - Interested';
        // }
        else {
            $status = str_replace('-', ' ', $request->status);
        }
        $myrole = auth()->user()->role;

        $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number', 'users.name as agent_name', 'main_data_user_assigners_1.other_remarks', 'main_data_user_assigners_1.remarks_by_tl')
            ->Join(
                'users',
                'users.id',
                'main_data_user_assigners_1.user_id'
            )
            ->Join(
                'whats_app_mnp_banks_1',
                'whats_app_mnp_banks_1.id',
                'main_data_user_assigners_1.number_id'
            )
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'TeamLeader') {
                    return $query->where('users.teamleader', auth()->user()->id);
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                } elseif ($myrole == 'FloorManagerHead') {
                    return $query->where('users.teamleader', auth()->user()->tlid);
                } else if ($myrole == 'FloorManager') {
                    return $query->where('users.agent_code', auth()->user()->agent_code);
                } else if ($myrole == 'Admin' || $myrole == 'SuperAdmin') {
                } else {
                    return $query->where('users.id', auth()->user()->id);
                }
            })
            // ->where('users.agent_code', auth()->user()->agent_code)
            ->WhereNotNull('main_data_user_assigners_1.status')
            ->where('main_data_user_assigners_1.status', $status)
            // ->groupby('main_data_user_assigners_1.status')
            ->get();
        return view('admin.lead.view-mnp-dashboard', compact('data','status'));
    }
    //
    public function agent_mnp_log(Request $request)
    {
        // return "Zoom"
        $myrole = auth()->user()->role;
        $data = User::select('users.*')
        ->when($myrole, function ($query) use ($myrole) {
            if ($myrole == 'TeamLeader') {
                return $query->where('users.teamleader', auth()->user()->id);
                // return $query->where('users.agent_code', auth()->user()->agent_code);
            } elseif ($myrole == 'FloorManagerHead') {
                return $query->where('users.teamleader', auth()->user()->tlid);
            } else if ($myrole == 'FloorManager') {
                return $query->where('users.agent_code', auth()->user()->agent_code);
            } else {
                // return $query->where('users.id', auth()->user()->id);
            }
        })
        // ->OrderBy('')
            ->get();
        return view('admin.lead.agent-mnp-log', compact('data'));
    }
    //
    //
    public static function SingleCampaignCount($status, $id, $month)
    {
        $myrole = auth()->user()->role;
        // $status =
        if ($status == 'data-assigned') {
            return $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
                ->Join(
                    'users',
                    'users.id',
                    'main_data_user_assigners_1.user_id'
                )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->whereIn('whats_app_mnp_banks_1.data_valid_from',['NewElife2', 'NewElife'])
                ->where('users.id', $id)
                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })
                // ->WhereNotNull('main_data_user_assigners_1.status')
                // ->where('main_data_user_assigners_1.status', $status)
                ->get()->count();
        } elseif ($status == 'data-used') {
            return $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
                ->Join(
                    'users',
                    'users.id',
                    'main_data_user_assigners_1.user_id'
                )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['NewElife2', 'NewElife'])

                ->where('users.id', $id)
                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })

                ->WhereNotNull('main_data_user_assigners_1.status')
                // ->whereNotNull('main_data_user_assigners_1.status')
                ->get()->count();
        } elseif ($status == 'data-available') {
            return $remaining = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
                ->Join(
                    'users',
                    'users.id',
                    'main_data_user_assigners_1.user_id'
                )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['NewElife2', 'NewElife'])

                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })
                ->where('users.id', $id)

                ->WhereNull('main_data_user_assigners_1.status')
                // ->whereNotNull('main_data_user_assigners_1.status')
                ->get()->count();
        } else {
            return $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number')
                ->Join(
                    'users',
                    'users.id',
                    'main_data_user_assigners_1.user_id'
                )
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['NewElife2', 'NewElife'])

                ->when($month, function ($query) use ($month) {
                    if ($month == 'monthly') {
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                        return $query->WhereMonth('main_data_user_assigners_1.updated_at', Carbon::now()->month);
                    } elseif ($month == 'daily') {
                        return $query->whereDate('main_data_user_assigners_1.updated_at', Carbon::today());
                        // return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    }
                })
                ->where('users.id', $id)
                ->WhereNotNull('main_data_user_assigners_1.status')
                ->where('main_data_user_assigners_1.status', $status)
                ->get()->count();
        }
    }
    //
    public function NumberAssignerManager(Request $request)
    {

        // $data = WhatsAppMnpBank::where('is_status','0')->limit(1000)->get();
        // foreach($data as $dd){
        //     // $k = WhatsAppMnpBank::where('id',$dd->id)->first();
        //     // $k->
        //     $z = main_data_manager_assigner::where('number_id',$dd->id)->first();
        //     if($z){
        //         $z->delete();
        //     }
        //     // echo $z->id . ' ' . '<br>';
        // }
        // return "b";
        // $b = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('manager_id')->Orderby('id', 'desc')->take(1000)->get();
        // $NumberCount = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('manager_id')->take(1000)->count();
        $b = WhatsAppMnpBank::select('whats_app_mnp_banks_1.*')->where('is_status', '0')
        // ->whereIn('data_valid_from', ['RegionAUHFriday', 'DNCRP2P','AAMTMarch','19DUDNCAED', 'SeriesThree'])
        // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril', 'DewaApril'])
        // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril', 'DewaApril','GourangDataDU'])
        // ->whereIn('soft_dnd', ['54', '054','056','56','50','050'])
            // ->whereIn('soft_dnd', ['58', '058','055','55','52','052'])

        ->limit(500)->groupby('whats_app_mnp_banks_1.number')
        ->inRandomOrder()->get();

        // ->Orderby('id', 'desc')->get();
        $NumberCount = $b->count();
        $u = User::select('users.*')->whereIn('role', ['Manager', 'Cordination'])->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner', compact('b', 'u', 'NumberCount'));
    }
    //
    //
    public function NumberAssignerManager4g(Request $request)
    {

        // $data = WhatsAppMnpBank::where('is_status','0')->limit(1000)->get();
        // foreach($data as $dd){
        //     // $k = WhatsAppMnpBank::where('id',$dd->id)->first();
        //     // $k->
        //     $z = main_data_manager_assigner::where('number_id',$dd->id)->first();
        //     if($z){
        //         $z->delete();
        //     }
        //     // echo $z->id . ' ' . '<br>';
        // }
        // return "b";
        // $b = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('manager_id')->Orderby('id', 'desc')->take(1000)->get();
        // $NumberCount = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('manager_id')->take(1000)->count();
        $b = WhatsAppMnpBank::select('whats_app_mnp_banks_1.*')->where('is_status', '0')
        // ->whereIn('data_valid_from', ['RegionAUHFriday', 'DNCRP2P','AAMTMarch','19DUDNCAED', 'SeriesThree'])
        // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril', 'DewaApril'])
        // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril', 'DewaApril','GourangDataDU'])
        // ->whereIn('soft_dnd', ['54', '054','056','56','50','050'])
            // ->whereIn('soft_dnd', ['58', '058','055','55','52','052'])
        ->where('data_valid_from','Special4G11K')

        ->limit(500)->groupby('whats_app_mnp_banks_1.number')
        ->inRandomOrder()->get();

        // ->Orderby('id', 'desc')->get();
        $NumberCount = $b->count();
        $u = User::select('users.*')->whereIn('role', ['Manager', 'Cordination'])->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner', compact('b', 'u', 'NumberCount'));
    }
    //
    //
    public function NumberAssignerManagerFNE(Request $request)
    {


        $b = fne_number_bank::select('fne_number_banks.*')->where('is_status', '0')
        ->where('lead_type', '5G_EXPIRED')

        ->limit(500)->groupby('fne_number_banks.customer_number')
        // ->inRandomOrder()
        ->get();

        // ->Orderby('id', 'desc')->get();
        $NumberCount = $b->count();
        $u = User::select('users.*')->whereIn('role', ['TeamLeader'])->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner-fne', compact('b', 'u', 'NumberCount'));
    }
    //
    //
    public function NumberAssignerManagerFNEFuture(Request $request)
    {


        $b = fne_number_bank::select('fne_number_banks.*')->where('is_status', '0')
        ->where('lead_type', '5G_EXPIRED_Future')

        ->limit(500)->groupby('fne_number_banks.customer_number')
        // ->inRandomOrder()
        ->get();

        // ->Orderby('id', 'desc')->get();
        $NumberCount = $b->count();
        $u = User::select('users.*')->whereIn('role', ['TeamLeader'])->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner-fne', compact('b', 'u', 'NumberCount'));
    }
    //
    //
    public function NumberAssignerManagerReady(Request $request)
    {

        // $data = WhatsAppMnpBank::where('is_status','0')->limit(1000)->get();
        // foreach($data as $dd){
        //     // $k = WhatsAppMnpBank::where('id',$dd->id)->first();
        //     // $k->
        //     $z = main_data_manager_assigner::where('number_id',$dd->id)->first();
        //     if($z){
        //         $z->delete();
        //     }
        //     // echo $z->id . ' ' . '<br>';
        // }
        // return "b";
        // $b = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('manager_id')->Orderby('id', 'desc')->take(1000)->get();
        // $NumberCount = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('manager_id')->take(1000)->count();
        $b = fne_number_bank::select('fne_number_banks.*')->where('is_status', '0')
        ->where('lead_type', 'ORDER_READY')

        ->limit(500)->groupby('fne_number_banks.customer_number')
        // ->inRandomOrder()
        ->get();

        // ->Orderby('id', 'desc')->get();
        $NumberCount = $b->count();
        $u = User::select('users.*')->whereIn('role', ['Manager'])->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner-ready', compact('b', 'u', 'NumberCount'));
    }
    //
    public function NumberAssignerUser(Request $request)
    {
        // return "b";
        // $zz = main_data_manager_assigner::where('manager_id', auth()->user()->id)->get();
         $b = WhatsAppMnpBank::select('whats_app_mnp_banks_1.*')
        ->Join(
            'main_data_manager_assigners_1',
            'main_data_manager_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
            // ->where('whats_app_mnp_banks_1.data_valid_from','!=','NewElife2')
            // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['RegionAUHFriday', 'DNCRP2P','AAMTMarch','19DUDNCAED'])
            // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['AAMTMarch','19DUDNCAED'])
            // ->whereIn('data_valid_from', ['RegionAUHFriday', 'DNCRP2P', 'AAMTMarch','19DUDNCAED','SeriesThree'])
            // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril','DewaApril'])

        ->where('main_data_manager_assigners_1.manager_id', auth()->user()->id)
        ->where('is_status', '1')
        ->whereNull('main_data_manager_assigners_1.status')
        // ->Orderby('id', 'desc')
        ->inRandomOrder()
        ->limit(1000)
        ->get();
        $NumberCount = $b->count();
        // $b = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('user_id')->where('manager_id',auth()->user()->id)->Orderby('id', 'desc')->take(1000)->get();
        // $NumberCount = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('user_id')->where('manager_id', auth()->user()->id)->take(1000)->count();
        $u = User::select('users.*')->whereIn('role', ['Sale', 'NumberAdmin'])->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner', compact('b', 'u', 'NumberCount'));
    }
    //
    //
    public function NumberAssignerUserFNE(Request $request)
    {
        // return "b";
        // $zz = main_data_manager_assigner::where('manager_id', auth()->user()->id)->get();
         $b = fne_number_bank::select('fne_number_banks.*')
        ->Join(
            'fne_data_manager_assigners',
            'fne_data_manager_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where('whats_app_mnp_banks_1.data_valid_from','!=','NewElife2')
            // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['RegionAUHFriday', 'DNCRP2P','AAMTMarch','19DUDNCAED'])
            // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['AAMTMarch','19DUDNCAED'])
            // ->whereIn('data_valid_from', ['RegionAUHFriday', 'DNCRP2P', 'AAMTMarch','19DUDNCAED','SeriesThree'])
            // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril','DewaApril'])

        ->where('fne_data_manager_assigners.manager_id', auth()->user()->id)
        ->whereMonth('fne_number_banks.created_at', Carbon::now()->month)
        ->where('is_status', '1')
        ->whereNull('fne_data_manager_assigners.status')
        // ->Orderby('id', 'desc')
        // ->inRandomOrder()
        ->limit(1000)
        ->get();
        $NumberCount = $b->count();
        // $b = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('user_id')->where('manager_id',auth()->user()->id)->Orderby('id', 'desc')->take(1000)->get();
        // $NumberCount = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('user_id')->where('manager_id', auth()->user()->id)->take(1000)->count();
        $u = User::select('users.*')->whereIn('role', ['Sale', 'NumberAdmin'])
        ->where('teamleader',auth()->user()->id)
        ->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner-fne', compact('b', 'u', 'NumberCount'));
    }
    //
    //
    public function NumberAssignerUserOrder(Request $request)
    {
        // return "b";
        // $zz = main_data_manager_assigner::where('manager_id', auth()->user()->id)->get();
         $b = fne_number_bank::select('fne_number_banks.*')
        ->Join(
            'fne_data_manager_assigners',
            'fne_data_manager_assigners.number_id',
            'fne_number_banks.id'
        )
            // ->where('whats_app_mnp_banks_1.data_valid_from','!=','NewElife2')
            // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['RegionAUHFriday', 'DNCRP2P','AAMTMarch','19DUDNCAED'])
            // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['AAMTMarch','19DUDNCAED'])
            // ->whereIn('data_valid_from', ['RegionAUHFriday', 'DNCRP2P', 'AAMTMarch','19DUDNCAED','SeriesThree'])
            // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril','DewaApril'])

        ->where('fne_data_manager_assigners.manager_id', auth()->user()->id)
        ->where('is_status', '1')
        ->whereNull('fne_data_manager_assigners.status')
        // ->Orderby('id', 'desc')
        // ->inRandomOrder()
        ->limit(1000)
        ->get();
        $NumberCount = $b->count();
        // $b = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('user_id')->where('manager_id',auth()->user()->id)->Orderby('id', 'desc')->take(1000)->get();
        // $NumberCount = number_assigner::select('number_assigners.*')->where('status', '0')->whereNull('user_id')->where('manager_id', auth()->user()->id)->take(1000)->count();
        $u = User::select('users.*')->whereIn('role', ['Sale', 'NumberAdmin'])
        // ->where('teamleader',auth()->user()->id)
        ->get();
        // $u = User::select('users.*')->where('role','Sale')->where('agent_code','CL1')->get();
        // ->where('identify','0')->get();
        return view('dashboard.number-assigner-fne', compact('b', 'u', 'NumberCount'));
    }
    //
    public function assigner(Request $request)
    {
        // return $request;
        foreach ($request->number as $k) {
            // return $k;
                //

                //
            if (!empty($request->user)) {
                // return "ye";
                 $zk = main_data_manager_assigner::where('number_id',$k)->first();
                if(!$zk){
                    // return "ZK";
                    $ks = main_data_manager_assigner::create([
                        'number_id' => $k,
                        'manager_id' => $request->user,
                        'call_center' => $request->user,
                        // 'status' => '',
                    ]);
                    $kk = WhatsAppMnpBank::where('id', $k)->first();
                    $kk->is_status = '1';
                    $kk->save();
                    // return "Kamiyabi";
                }
            }
            // echo $k . '<br>';
            // $k = explode('-', $k);
            // return $k['0'];
            // return $k['1'];
            // number_assigner::create([
                //     'number_id' => $k,
                //     'userid' => $request->user,
                //     'status' => ' ',
            // ]);
            // if ($k['1'] == 'Country') {
            // $ks = number_assigner::where('number', $k[0])->update(['manager_id' => $request->user]);
            // } else {
            // $ks = bulknumber::where('number', $k)->update(['identify' => '1']);
            // }
        }
        return "1";
    }
    //
    //
    public function assignerfne(Request $request)
    {
        // return $request;
        foreach ($request->number as $k) {
            // return $k;
                //

                //
            if (!empty($request->user)) {
                $zk = fne_data_manager_assigners::where('number_id',$k)->first();
                if(!$zk){
                    $ks = fne_data_manager_assigners::create([
                        'number_id' => $k,
                        'manager_id' => $request->user,
                        'call_center' => $request->user,
                        // 'status' => '',
                    ]);
                    $kk = fne_number_bank::where('id', $k)->first();
                    $kk->is_status = '1';
                    $kk->save();
                }
            }
            // echo $k . '<br>';
            // $k = explode('-', $k);
            // return $k['0'];
            // return $k['1'];
            // number_assigner::create([
                //     'number_id' => $k,
                //     'userid' => $request->user,
                //     'status' => ' ',
            // ]);
            // if ($k['1'] == 'Country') {
            // $ks = number_assigner::where('number', $k[0])->update(['manager_id' => $request->user]);
            // } else {
            // $ks = bulknumber::where('number', $k)->update(['identify' => '1']);
            // }
        }
        return "1";
    }
    //
    public function assigner_user(Request $request)
    {
        // return $request;
        foreach ($request->number as $k) {
            $ks = main_data_user_assigner::create([
                'number_id' => $k,
                'user_id' => $request->user,
                'call_center' => $request->user,
                // 'status' => '',
            ]);
            //
            $k = main_data_manager_assigner::where('number_id', $k)->where('manager_id', auth()->user()->id)->first();
            $k->status = '1';
            $k->save();
            // echo $k . '<br>';
            // $k = explode('-', $k);
            // return $k['0'];
            // return $k['1'];
            // number_assigner::create([
            //     'number_id' => $k,
            //     'userid' => $request->user,
            //     'status' => ' ',
            // ]);
            // if ($k['1'] == 'Country') {
            // return $k;
            // $ks = main_data_manager_assigner::create([
            //     'number_id' => $k,
            //     'manager_id' => $request->user,
            //     'call_center' => $request->user,
            //     // 'status' => '',
            // ]);
            // $ks = number_assigner::where('number', $k])->update(['user_id' => $request->user]);
            // $ks = main_data_manager_assigner::where('number_id', $k])->update(['user_id' => $request->user]);
            // } else {
            // $ks = bulknumber::where('number', $k)->update(['identify' => '1']);
            // }
        }
        return "1";
    }
    //
    //
    public function assigner_user_fne(Request $request)
    {
        // return $request;
        foreach ($request->number as $k) {
            $ks = fne_data_user_assigner::create([
                'number_id' => $k,
                'user_id' => $request->user,
                'call_center' => $request->user,
                // 'status' => '',
            ]);
            //
            $k = fne_data_manager_assigners::where('number_id', $k)->where('manager_id', auth()->user()->id)->first();
            $k->status = '1';
            $k->save();
            // echo $k . '<br>';
            // $k = explode('-', $k);
            // return $k['0'];
            // return $k['1'];
            // number_assigner::create([
            //     'number_id' => $k,
            //     'userid' => $request->user,
            //     'status' => ' ',
            // ]);
            // if ($k['1'] == 'Country') {
            // return $k;
            // $ks = main_data_manager_assigner::create([
            //     'number_id' => $k,
            //     'manager_id' => $request->user,
            //     'call_center' => $request->user,
            //     // 'status' => '',
            // ]);
            // $ks = number_assigner::where('number', $k])->update(['user_id' => $request->user]);
            // $ks = main_data_manager_assigner::where('number_id', $k])->update(['user_id' => $request->user]);
            // } else {
            // $ks = bulknumber::where('number', $k)->update(['identify' => '1']);
            // }
        }
        return "1";
    }
    //
    public function FollowUpDashboard(Request $request){
        return "Ok";
        $myrole = auth()->user()->role;
        // $data = User::select('users.*')
        //     ->when($myrole, function ($query) use ($myrole) {
        //         if ($myrole == 'TeamLeader') {
        //             return $query->where('users.teamleader', auth()->user()->id);
        //             // return $query->where('users.agent_code', auth()->user()->agent_code);
        //         } elseif ($myrole == 'FloorManagerHead') {
        //             return $query->where('users.teamleader', auth()->user()->tlid);
        //         } else if ($myrole == 'FloorManager') {
        //             return $query->where('users.agent_code', auth()->user()->agent_code);
        //         } else {
        //             // return $query->where('users.id', auth()->user()->id);
        //         }
        //     })
        //     ->get();
        $data = main_data_user_assigner::select('main_data_user_assigners_1.number_id', 'main_data_user_assigners_1.status', 'whats_app_mnp_banks_1.number','users.email', 'main_data_user_assigners_1.other_remarks', 'main_data_user_assigners_1.remarks_by_tl')
        ->Join(
            'users',
            'users.id',
            'main_data_user_assigners_1.user_id'
        )
        ->Join(
            'whats_app_mnp_banks_1',
            'whats_app_mnp_banks_1.id',
            'main_data_user_assigners_1.number_id'
        )
            ->when(
                $myrole,
                function ($query) use ($myrole) {
                    if ($myrole == 'TeamLeader') {
                        return $query->where('users.teamleader', auth()->user()->id);
                        // return $query->where('users.agent_code', auth()->user()->agent_code);
                    } elseif ($myrole == 'FloorManagerHead') {
                        return $query->where('users.teamleader', auth()->user()->tlid);
                    } else if ($myrole == 'FloorManager') {
                        return $query->where('users.agent_code', auth()->user()->agent_code);
                    } else {
                        return $query->where('whats_app_mnp_banks_1.data_valid_from', 'NewElife2');

                        // return $query->where('users.id', auth()->user()->id);
                    }
                })

            // ->WhereNotNull('main_data_user_assigners_1.status')
            // ->where('main_data_user_assigners_1.status', $status)
            ->get();
        return view('admin.lead.agent-follow-log', compact('data'));
    }
    //
    public function GiveMeNewNumber(Request $request){
        // return "Yes";
        // return $request;
        $myrole = auth()->user()->agent_code;

        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
            ->when($myrole, function ($query) use ($myrole) {
                if ($myrole == 'CL7') {
                    // return $query->where('users.agent_code', auth()->user()->agent_code);
                    return $query->whereIn('whats_app_mnp_banks_1.soft_dnd', ['54', '054', '056', '56', '50', '050']);
                }
                // else if($myrole == 'KHICordination'){
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
                // else {
                //     return $query->whereIn('users.agent_code', ['CC1', 'CC4', 'CC5', 'CC7', 'CC8']);
                // }
            })
        // ->where
        ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
        ->where('is_status', '1')
        ->where('pcat','Normal')

        // ->where('main_data_user_assigners_1.status','Follow up')
        ->whereNull('main_data_user_assigners_1.status')
        ->Orderby('main_data_user_assigners_1.id', 'asc')
        ->groupBy('whats_app_mnp_banks_1.number')->get()
        ->count();
        if($k>20){
            return "0";
        }

        //
        if (auth()->user()->agent_code == 'CL3') {
            $myid = '9';
        }
        else {
            $myid = '9';
        }
        //
        $number = WhatsAppMnpBank::select('whats_app_mnp_banks_1.*')
        ->Join(
            'main_data_manager_assigners_1',
            'main_data_manager_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
            ->where('pcat', 'Normal')
        // ->where('whats_app_mnp_banks_1.data_valid_from','!=','NewElife2')
        // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['RegionAUHFriday', 'DNCRP2P','AAMTMarch','19DUDNCAED'])
        // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['AAMTMarch','19DUDNCAED'])
        // ->whereIn('data_valid_from', ['RegionAUHFriday', 'DNCRP2P', 'AAMTMarch','19DUDNCAED','SeriesThree'])
        // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril','DewaApril'])

        ->where('main_data_manager_assigners_1.manager_id', $myid)
        ->where('is_status', '1')
        ->whereNull('main_data_manager_assigners_1.status')
        // ->Orderby('id', 'desc')
        ->inRandomOrder()
        // ->whereMonth('main_data_manager_assigners_1.updated_at', Carbon::now()->month)
        // ->whereYear('main_data_manager_assigners_1.created_at', Carbon::now()->year)
        ->limit(10)
        ->get();

        if($number->count() > 1) {


            foreach ($number as $k) {
                $ks = main_data_user_assigner::create([
                    'number_id' => $k->id,
                    'user_id' => $request->id,
                    'call_center' => $request->id,
                    // 'status' => '',
                ]);
                //
                if(auth()->user()->agent_code == 'CL3'){
                    $myid = '9';
                }
                else{
                    $myid = '9';
                }
                $k = main_data_manager_assigner::where('number_id', $k->id)->where('manager_id', $myid)->first();
                $k->status = '1';
                $k->save();

            }
            return "1";
        }
        else{
            $data = User::whereIn('email', ['salmanahmedrajput@outlook.com'])->get();
            foreach ($data as $d2) {
                $zp = main_data_user_assigner::where('status', 'No Answer')
                ->whereNull('mark_dnd')
                ->whereMonth('created_at', Carbon::now()->month)
                ->OrderBy('id', 'desc')->limit(500)->get();
                foreach ($zp as $zp2) {
                    $zp3 = main_data_manager_assigner::where('number_id', $zp2->number_id)->OrderBy('id', 'asc')->first();
                    if ($zp3) {
                        $zp3->status = NULL;
                        $zp3->save();
                    }
                    //
                    $zp2 = main_data_user_assigner::where('id', $zp2->id)->first();
                    if ($zp2) {
                        $zp2->delete();
                    }
                }
                // $zp->delete();
            }
            return "1";
            // return "Zoom";
            return 0;
        }
    }
    //
    public function ClearDuplicate(Request $request){
        $duplicates = \DB::table('main_data_user_assigners_1')
        ->select('id', 'status', 'number_id', \DB::raw('COUNT(*) as `count`'))
        ->groupBy('number_id')
        ->havingRaw('COUNT(*) > 1')
        ->get();
        foreach ($duplicates as $dd) {
            $dz = main_data_user_assigner::whereNull('status')->where('number_id', $dd->number_id)->first();
            if ($dz) {
                $dz->delete();
            }
        }
        //
        $duplicates2g = \DB::table('main_data_manager_assigners_1')
        ->select('id', 'status', 'number_id', \DB::raw('COUNT(*) as `count`'))
        ->groupBy('number_id')
        ->havingRaw('COUNT(*) > 1')
        ->get();
        foreach ($duplicates2g as $dd2) {
            $dz = main_data_manager_assigner::whereNull('status')->where('number_id', $dd2->number_id)->first();
            if ($dz) {
                $dz->delete();
            }
        }

        return "1";
    }
    //
    public static function MyCount4g(){
       return $k2 = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number')
            ->Join(
                'main_data_user_assigners_1',
                'main_data_user_assigners_1.number_id',
                'whats_app_mnp_banks_1.id'
            )
            // ->where
            ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
            ->where('is_status', '1')
            // ->where('pcat', '4G')
            // ->where('main_data_user_assigners_1.status','Follow up')
            // ->whereNull('main_data_user_assigners_1.status')
            ->whereDate('main_data_user_assigners_1.created_at', Carbon::today())
            ->Orderby('main_data_user_assigners_1.id', 'asc')
            ->groupBy('whats_app_mnp_banks_1.number')->get()->count();
    }
    //
    //
    public static function MyCountFNE($type){
       return $k2 = fne_number_bank::select('fne_number_banks.id')
            ->Join(
                'fne_data_user_assigners',
                'fne_data_user_assigners.number_id',
                'fne_number_banks.id'
            )
            // ->where
            ->where('fne_data_user_assigners.user_id', auth()->user()->id)
            ->where('is_status', '1')
            ->where('fne_number_banks.lead_type',$type)
            // ->where('pcat', '4G')
            // ->where('main_data_user_assigners_1.status','Follow up')
            // ->whereNull('main_data_user_assigners_1.status')
            ->whereDate('fne_data_user_assigners.created_at', Carbon::today())
            ->Orderby('fne_data_user_assigners.id', 'asc')
            ->groupBy('fne_number_banks.id')->get()->count();
    }
    //
    // //
    // public static function MyCountOrder(){
    //    return $k2 = fne_number_bank::select('fne_number_banks.id')
    //         ->Join(
    //             'fne_data_user_assigners',
    //             'fne_data_user_assigners.number_id',
    //             'fne_number_banks.id'
    //         )
    //         // ->where
    //         ->where('fne_data_user_assigners.user_id', auth()->user()->id)
    //         ->where('is_status', '1')
    //         // ->where('pcat', '4G')
    //         // ->where('main_data_user_assigners_1.status','Follow up')
    //         // ->whereNull('main_data_user_assigners_1.status')
    //         ->whereDate('fne_data_user_assigners.created_at', Carbon::today())
    //         ->Orderby('fne_data_user_assigners.id', 'asc')
    //         ->groupBy('fne_number_banks.id')->get()->count();
    // }
    // //
    public function GiveMeNewNumber4g(Request $request){
        // return "Yes";
        // return $request;

        $k = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        // ->where
        ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
        ->where('is_status', '1')
        ->where('pcat','4G')
        // ->where('main_data_user_assigners_1.status','Follow up')
        ->whereNull('main_data_user_assigners_1.status')
        ->Orderby('main_data_user_assigners_1.id', 'asc')
        ->groupBy('whats_app_mnp_banks_1.number')->get()->count();

        $k2 = WhatsAppMnpBank::select('whats_app_mnp_banks_1.number')
        ->Join(
            'main_data_user_assigners_1',
            'main_data_user_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        // ->where
        ->where('main_data_user_assigners_1.user_id', auth()->user()->id)
        ->where('is_status', '1')
        ->where('pcat','4G')
        // ->where('main_data_user_assigners_1.status','Follow up')
        // ->whereNull('main_data_user_assigners_1.status')
        ->whereDate('main_data_user_assigners_1.created_at',Carbon::today())
        ->Orderby('main_data_user_assigners_1.id', 'asc')
        ->groupBy('whats_app_mnp_banks_1.number')->get()->count();
        if($k2>40){
            return "2";
        }
        if($k>5){
            return "0";
        }

        //
        if (auth()->user()->agent_code == 'CL3') {
            $myid = '88';
        } else {
            $myid = '88';
        }
        // return $myid;
        //
       $number = WhatsAppMnpBank::select('whats_app_mnp_banks_1.*')
        ->Join(
            'main_data_manager_assigners_1',
            'main_data_manager_assigners_1.number_id',
            'whats_app_mnp_banks_1.id'
        )
        // ->where('whats_app_mnp_banks_1.data_valid_from','!=','NewElife2')
        // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['RegionAUHFriday', 'DNCRP2P','AAMTMarch','19DUDNCAED'])
        // ->whereIn('whats_app_mnp_banks_1.data_valid_from', ['AAMTMarch','19DUDNCAED'])
        // ->whereIn('data_valid_from', ['RegionAUHFriday', 'DNCRP2P', 'AAMTMarch','19DUDNCAED','SeriesThree'])
        // ->whereIn('data_valid_from', ['AAMTApril', 'April202K', 'SewaApril','DewaApril'])
        ->where('whats_app_mnp_banks_1.pcat', '4G')
        ->where('main_data_manager_assigners_1.manager_id', $myid)
        ->where('is_status', '1')
        ->whereNull('main_data_manager_assigners_1.status')
        // ->Orderby('id', 'desc')
        ->inRandomOrder()
        ->limit(3)
        ->get();


        if($number->count() > 1) {


            foreach ($number as $k) {
                $ks = main_data_user_assigner::create([
                    'number_id' => $k->id,
                    'user_id' => $request->id,
                    'call_center' => $request->id,
                    // 'status' => '',
                ]);
                //
                if(auth()->user()->agent_code == 'CL3'){
                    $myid = '88';
                }else{
                    $myid = '88';
                }
                $k = main_data_manager_assigner::where('number_id', $k->id)->where('manager_id', $myid)->first();
                $k->status = '1';
                $k->save();

            }
            return "1";
        }
        else{
            $data = User::whereIn('email', ['salmanahmedrajput@outlook.com'])->get();
            foreach ($data as $d2) {
                $zp = main_data_user_assigner::select('main_data_user_assigners_1.number_id')->where('main_data_user_assigners_1.status', 'Call Later')->whereNull('mark_dnd')
                ->Join(
                    'whats_app_mnp_banks_1',
                    'whats_app_mnp_banks_1.id',
                    'main_data_user_assigners_1.number_id'
                )
                ->where('whats_app_mnp_banks_1.pcat','4G')
                //  $zp = main_data_user_assigner::whereNull('status')
                // ->whereDate('updated_at', Carbon::yesterday())
                // ->whereBetween(
                //     'main_data_user_assigners_1.created_at',
                //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
                // )
                    // ->whereMonth('created_at', Carbon::now()->submonth())
                    // ->whereBetween(
                    // 'updated_at',
                    //     [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
                    // )

                    // ->whereMonth('created_at', Carbon::now()->month)
                    ->OrderBy('main_data_user_assigners_1.id', 'desc')->limit(500)->get();
                foreach ($zp as $zp2) {
                    $zp3 = main_data_manager_assigner::where('number_id', $zp2->number_id)->OrderBy('id', 'asc')->first();
                    if ($zp3) {
                        $zp3->status = NULL;
                        $zp3->save();
                    }
                    //
                    $zp2 = main_data_user_assigner::where('id', $zp2->id)->first();
                    if ($zp2) {
                        $zp2->delete();
                    }
                }
                // $zp->delete();
            }
            return "1";
            // return "Zoom";
            return 0;
        }
    }
    //
    public function ClearDuplicate4g(Request $request){
        $duplicates = \DB::table('main_data_user_assigners_1')
        ->select('id', 'status', 'number_id', \DB::raw('COUNT(*) as `count`'))
        ->groupBy('number_id')
        ->havingRaw('COUNT(*) > 1')
        ->get();
        foreach ($duplicates as $dd) {
            $dz = main_data_user_assigner::whereNull('status')->where('number_id', $dd->number_id)->first();
            if ($dz) {
                $dz->delete();
            }
        }

        return "1";
    }
    public function ClearDuplicatefne(Request $request){
        return $zp = fne_data_user_assigner::whereNull('status')
            // ->whereNull('mark_dnd')
            ->whereMonth('created_at', Carbon::now()->month)
            ->OrderBy('id', 'desc')
            ->get();
        foreach ($zp as $zp2) {
            $zp3 =fne_data_manager_assigners::where('number_id', $zp2->number_id)->OrderBy('id', 'asc')->first();
            if ($zp3) {
                $zp3->status = NULL;
                // $zp3->manager_id =560;
                $zp3->save();
            }
            //
            $zp2 = fne_data_user_assigner::where('id', $zp2->id)->first();
            if ($zp2) {
                $zp2->delete();
            }
        }
    }
}
