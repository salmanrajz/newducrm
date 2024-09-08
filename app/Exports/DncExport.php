<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class DncExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return $a = \App\Models\dnd_aashir::all();
    }
}
