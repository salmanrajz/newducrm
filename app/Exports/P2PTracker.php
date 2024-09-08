<?php

namespace App\Exports;

use App\Models\lead_sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class P2PTracker implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        // return $data = lead_sale::select('lead_sales.lea', 'lead_sales.customer_number', 'lead_sales.lead_type', 'lead_sales.nationality','lead_sales.emirate','plans.plan_name','lead_sales.remarks','lead_sales.status','lead_sales.lead_date')
        // ->Join(
        //     'plans','plans.id','lead_sales.plans'
        // )
        // ->get();
        \DB::statement(\DB::raw('set @count=0'));

        return $data = lead_sale::select(
            \DB::raw('(@count:=@count+1) AS serial'),
            'lead_sales.lead_date',
            'lead_sales.lead_no',
            'lead_sales.customer_name',
            'lead_sales.customer_number',
            'plans.plan_name',
            'users.name as agent_name',
            'lead_sales.lead_type',
            'plans.revenue',
            \DB::raw("CONCAT('DU') as verify_by"), //title
            \DB::raw("CONCAT('VOCUS') as partner_name"), //title


            // \DB::raw("CONCAT('Vocus Electronic Trading LLC') as partner_name"), //title
            // \DB::raw("CONCAT('TE151') as dealer_id"), //title
            // 'lead_sales.du_lead_no as du_lead_no',
            // 'users.name as agent_name',
            // 'lead_sales.work_order_num as work_order_num',
            // 'lead_sales.reff_id as reff_id',
            // 'lead_sales.customer_name',
            // 'lead_sales.customer_number',
            // 'lead_sales.emirate',
            // 'lead_sales.lead_date',
            // 'home_wifi_plans.du_wifi_name as order_type',
            // // \DB::raw("CONCAT('Home WiFi 5g Plus') as order_type"), //title
            // \DB::raw("CONCAT('NEW') as order_new"), //title
            // \DB::raw("CONCAT('0%') as discount"), //title
            // 'lead_sales.order_status as status',
            // 'lead_sales.remarks as remarks',
            // 'lead_sales.delivery_date as delivery_date',
            // 'lead_sales.disconnection_date as disconnection_date',
            // 'lead_sales.activation_date as activation_date',

            // \DB::raw("CONCAT(' ') as order_status"), //title
            // \DB::raw("CONCAT(' ') as rejected_reason"), //title
            // \DB::raw("CONCAT(' ') as delivered_on"), //title
            // \DB::raw("CONCAT(' ') as disconnection_date"), //title
            // \DB::raw("CONCAT(' ') as active_date"), //title
        )
        // ->whereMonth('lead_sales.updated_at', Carbon::now()->submonth())
            // ->whereYear('activation_forms.created_at', Carbon::now()->year)
        ->whereMonth('lead_sales.updated_at', Carbon::now()->month)
        ->whereYear('lead_sales.updated_at', Carbon::now()->year)
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
        ->where('lead_sales.lead_type', 'MNP')
        // ->where('lead_sales.status','1.02')
        ->get();
    }
    public function headings(): array
    {
        return [
            'S#',
            'Lead Dates',
            'Lead No',
            'Customer Name',
            'MSISDN',
            'Plan Migrated',
            'Sales Agent Name',
            'Lead Type',
            'Plans Points',
            'Partner Name',
            // 'Activation Date',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                // $event->cells('A1:D1', function ($cells) {
                //     $cells->setBackground('#008686');
                //     $cells->setAlignment('center');
                // });
                $event->sheet->getStyle('A1:R1')->getFill()->applyFromArray(['fillType' => 'solid', 'rotation' => 0, 'color' => ['rgb' => '000000'],]);
                $event->sheet->getStyle('A1:R1')->applyFromArray(array(
                    'font' => array(
                        'type'  => 'solid',
                        'color' => array('rgb' => 'FFFFFF')
                    )
                ));
                // $event->sheet->getDelegate()->getStyle('A1:D1')->setBackground('#008686');
                $event->sheet->getDelegate()->getStyle('A1:A3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B1:B3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                // $event->sheet->getDelegate()->getStyle('B1:B3000')->getAlignment()->setVertical(Alignment::VERTICAL_BOTTOM);
                $event->sheet->getDelegate()->getStyle('C1:C3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('D1:D3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('E1:E3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('F1:F3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('G1:G3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('H1:H3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // $event->sheet->getDelegate()->getStyle('S1:S3000')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
    public function title(): string
    {
        return 'P2P Tracker Sheet';
    }
}
