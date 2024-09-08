<?php

namespace App\Exports;

use App\Models\lead_sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class QualityExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        // return $table = lead_sale::select('lead_sales.id','lead_sales.lead_no','lead_sales.customer_name','lead_sales.customer_number','work_order_num','reff_id')
        // ->where('lead_type','HomeWifi')
        // ->whereIn('plans',['5','6','7'])
        // ->whereIn('status',['1.02'])
        // ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
        // ->whereYear('lead_sales.created_at', Carbon::now()->year)
        // ->get();
        return $inprocess = lead_sale::select('lead_sales.id', 'lead_sales.lead_no', 'lead_sales.customer_name', 'lead_sales.customer_number', 'work_order_num', 'reff_id')->whereIn('plans', ['5', '6', '7'])
        ->whereIn('status', ['1.08', '1.05'])
        ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
            ->whereNot('saler_id', 617)

            ->where('lead_type', 'HomeWifi')->get();
            // ->count();
    }
}
