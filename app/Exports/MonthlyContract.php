<?php

namespace App\Exports;

use App\Models\lead_sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthlyContract implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        \DB::statement(\DB::raw('set @count=0'));

        return $data = lead_sale::select(
                \DB::raw('(@count:=@count+1) AS serial'),
                \DB::raw("CONCAT('Vocus Electronic Trading LLC') as partner_name"), //title
                'lead_sales.customer_name',
                'lead_sales.contract_id',
                'lead_sales.plans',
                'status_codes.status_name',
                'lead_sales.account_id',
                'lead_sales.lead_type',
                'lead_sales.lead_no','lead_sales.updated_at','lead_sales.customer_number','lead_sales.reff_id','lead_sales.work_order_num','status_codes.status_name'
            )
            ->Join(
                'status_codes',
                'status_codes.status_code',
                'lead_sales.status'
            )
            ->leftJoin(
                'audio_recordings',
                'audio_recordings.lead_no','lead_sales.id'
            )
            ->Join(
                'users',
                'users.id',
                'lead_sales.saler_id'
            )
            // ->where('lead_sales.lead_type', 'HomeWifi')
            // ->where('lead_sales.status', '1.02')
            ->whereMonth('lead_sales.updated_at', Carbon::now()->submonth())
            // ->whereMonth('lead_sales.created_at', Carbon::now()->month)
            ->whereYear('lead_sales.created_at', Carbon::now()->year)
            ->get();
        //
    }
    public function headings(): array
    {
        return [
            'S#',
            'Partner Name',
            'Customer Name',
            'Contract ID',
            'Product Type',
            'Audio',
            'LeadNo',
            'ActivationDate',
            // 'Activation Date',
        ];
    }
}
