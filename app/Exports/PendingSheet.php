<?php

namespace App\Exports;

use App\Models\lead_sale;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class PendingSheet implements FromCollection, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return lead_sale::where('status','1.01')->get();
        // return User::where('is_admin', true)->get();
    }

    public function title(): string
    {
        return 'Pending Leads';
    }
}
