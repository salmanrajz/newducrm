<?php

namespace App\Exports;

use App\Models\ActivationForm;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivationSheet implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        //
        return $data = ActivationForm::select('activation_forms.customer_name', 'activation_forms.lead_no', 'activation_forms.customer_number', 'users.name as agent_name', 'users.agent_code','activation_forms.gender', 'activation_forms.nationality', 'activation_forms.lead_type', 'home_wifi_plans.name',  'activation_forms.lead_date', 'activation_forms.omid', 'activation_forms.status', 'activation_forms.language','activation_forms.updated_at')
        // return $data = activation_form::select(\DB::raw("YEAR(activation_forms.created_at) year"), \DB::raw("MONTH(activation_forms.created_at) month"),'activation_forms.activation_date', 'activation_forms.activation_sr_no','activation_forms.customer_name','plans.plan_name', 'activation_forms.activation_selected_no','activation_forms.channel_type')
        ->LeftJoin(
            'lead_sales','lead_sales.id','activation_forms.lead_id'
        )
        ->LeftJoin(
            'home_wifi_plans',
            'home_wifi_plans.id',
            'lead_sales.plans'
        )
            ->LeftJoin(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            // ->LeftJoin(
            //     'audio_recordings','audio_recordings.lead_no','activation_forms.lead_id'
            // )
            // ->LeftJoin(
            //     'numberdetails',
            //     'numberdetails.number',
            //     'activation_forms.activation_selected_no'
            // )
            // ->whereIn('activation_forms.channel_type', ['TTF', 'ExpressDial', 'MWH', 'IdeaCorp'])
            // ->whereIn('activation_forms.channel_type', ['TTF'])
            // ->whereIn('activation_forms.channel_type', ['MWH'])
            // ->whereIn('activation_forms.status',['1.02','1.11','1.08'])
            // ->where('users.agent_code','AAMT')
            // ->where('is_prepaid','1')
            // ->where('users.agent_code','CC2')
            // ->get();
            // ->wherein('users.agent_code',['CC11'])
            // ->whereMonth('activation_forms.created_at', Carbon::now()->submonth())
            // ->get();
            ->where('lead_sales.lead_type','HomeWifi')

            ->whereMonth('activation_forms.created_at', Carbon::now()->month)
            ->whereYear('activation_forms.created_at', Carbon::now()->year)
            ->get();
    }
    public function headings(): array
    {
        return [
            // 'S#',
            'Customer Name',
            'Lead No',
            'Customer Number',
            'Agent Name',
            'Call Center',
            'Gender',
            'Nationality',
            'Sim Type',
            'Plan Name',
            'Activation Date', 'OMID Number', 'status', 'Number Type', 'Created Date'
        ];
    }
}
