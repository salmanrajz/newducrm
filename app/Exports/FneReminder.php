<?php

namespace App\Exports;

use App\Models\lead_sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FneReminder implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $currentTime = Carbon::now();
        return $data = lead_sale::select('id','customer_name','customer_number','email', 'appointment_date','saler_name')
        ->where('status','1.21')
        ->whereBetween('appointment_date',[$currentTime->startOfMonth('Y-m-d'),Carbon::today()])
        // ->whereBetween('appointment_date', (new Carbon)->subDays(30)->startOfDay()->toDateString(), (new Carbon)->now()->endOfDay()->toDateString())
        // ->whereDate('appointment_date', $currentTime->addDays(1))
        ->get();
        //
        // $clientsToNotif = Phonebook::with('client')->whereDate('rememberdate', $currentTime->addDays(1))->get();

        //            ->where( 'created_at', '>', Carbon::now()->subDays(30))

    }
    public function headings(): array
    {
        return [
            'S#',
            'Customer Name',
            'Customer Number',
            'Customer Email',
            'Appoitment Date',
            'Agent Name'
        ];
    }
}
