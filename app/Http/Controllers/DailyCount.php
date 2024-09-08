<?php

namespace App\Console\Commands;

use App\Models\lead_sale;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vocus_daily_count:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $hw = lead_sale::where('lead_type','HomeWifi')->whereIn('status',['1.08','1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        $new_sim = lead_sale::where('lead_type','New')->whereIn('status',['1.08','1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        $p2p= lead_sale::where('lead_type','P2P')->whereIn('status', ['1.08', '1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        $mnp = lead_sale::where('lead_type','MNP')->whereIn('status', ['1.08', '1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        // return $q->whereDate('activation_forms.created_at', Carbon::today())
        $hw_cl1 = lead_sale::where('lead_sales.lead_type','HomeWifi')
        ->Join(
            'users','users.id','lead_sales.saler_id'
        )
            ->where('users.agent_code', 'CL1')

        ->whereIn('lead_sales.status',['1.08','1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        $new_cl1 = lead_sale::where('lead_sales.lead_type','New')
        ->Join(
            'users','users.id','lead_sales.saler_id'
        )
            ->where('users.agent_code', 'CL1')

        ->whereIn('lead_sales.status',['1.08','1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        $p2p_cl1 = lead_sale::where('lead_sales.lead_type','P2P')
        ->Join(
            'users','users.id','lead_sales.saler_id'
        )
            ->where('users.agent_code', 'CL1')

        ->whereIn('lead_sales.status',['1.08','1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        $mnp_cl1 = lead_sale::where('lead_sales.lead_type','MNP')
        ->Join(
            'users','users.id','lead_sales.saler_id'
        )
        ->where('users.agent_code','CL1')
        ->whereIn('lead_sales.status',['1.08','1.02','1.11'])->whereDate('lead_sales.created_at',Carbon::today())->get()->count();
        #
        //
        $date = Carbon::today()->toDateString();
        $details = [
            'wifi_count' => $hw,
            'p2p_count' => $p2p,
            'mnp_count' => $mnp,
            'new_sim' => $new_sim,
            'date' => $date,
            'number' => '971522221220'
            // 'number' => '923121337222,971522221220,971559533110'
        ];
        $details_cl1 = [
            'wifi_count' => $hw_cl1,
            'p2p_count' => $p2p_cl1,
            'mnp_count' => $mnp_cl1,
            'new_sim' => $new_cl1,
            'date' => $date,
            'number' => '971522221220'
        ];
        //
        $cc = \App\Models\call_center::where('status',1)->get();
        foreach($cc as $c){
            $hw_cc_wise = lead_sale::where('lead_sales.lead_type', 'HomeWifi')
            ->Join(
                'users','users.id','lead_sales.saler_id'
            )
            ->where('users.agent_code',$c->call_center_name)
            ->whereIn('lead_sales.status', ['1.08', '1.11'])->whereDate('lead_sales.created_at', Carbon::today())->get()->count();
            $new_cc_wise = lead_sale::where('lead_sales.lead_type', 'New')
            ->Join(
                'users','users.id','lead_sales.saler_id'
            )
            ->where('users.agent_code',$c->call_center_name)
            ->whereIn('lead_sales.status', ['1.08','1.11'])->whereDate('lead_sales.created_at', Carbon::today())->get()->count();
            $p2p_cc_wise = lead_sale::where('lead_sales.lead_type', 'P2P')
            ->Join(
                'users','users.id','lead_sales.saler_id'
            )
            ->where('users.agent_code',$c->call_center_name)
            ->whereIn('lead_sales.status', ['1.08','1.11'])->whereDate('lead_sales.created_at', Carbon::today())->get()->count();
            $mnp_cc_wise = lead_sale::where('lead_sales.lead_type', 'MNP')
            ->Join(
                'users','users.id','lead_sales.saler_id'
            )
            ->where('users.agent_code',$c->call_center_name)
            ->whereIn('lead_sales.status', ['1.08', '1.11'])->whereDate('lead_sales.created_at', Carbon::today())->get()->count();
            // $p2p = lead_sale::where('lead_type', 'P2P')->whereIn('status', ['1.08', '1.02', '1.11'])->whereDate('lead_sales.created_at', Carbon::today())->get()->count();
            // $mnp = lead_sale::where('lead_type', 'MNP')->whereIn('status', ['1.08', '1.02', '1.11'])->whereDate('lead_sales.created_at', Carbon::today())->get()->count();
            $details_cccwise = [
                'wifi_count' => $hw_cc_wise,
                'p2p_count' => $p2p_cc_wise,
                'mnp_count' => $mnp_cc_wise,
                'new_sim' => $new_cc_wise,
                'date' => $date,
                'number' => '97144938402',
                'cc_name' => $c->call_center_name,
            ];
            \App\Http\Controllers\FunctionController::SendWhatsAppDailyUpdateCCWise($details_cccwise);
        }
        //
        //
        \App\Http\Controllers\FunctionController::SendWhatsAppDailyUpdate($details);
        \App\Http\Controllers\FunctionController::SendWhatsAppDailyUpdate($details_cl1);
    }
}
