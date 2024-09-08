<?php

namespace App\Imports;

use App\Models\renewal_data;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RenewalData implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        foreach($collection as $row){
            $rd = renewal_data::where('number',$row['1'])->first();
            if($rd){
                $rd = renewal_data::create([
                    'number' => $row[1],
                ]);
            }
        }
    }
}
