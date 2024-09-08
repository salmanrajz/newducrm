<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GetEmail implements ToCollection,WithStartRow
{

    /**
    * @param Collection $collection
    */
    //
    public function startRow(): int
    {
        return 2;
    }
    //
    public function collection(Collection $collection)
    {
        //
        foreach ($collection as $row) {
            $data = User::where('email',$row['2'])->first();
            if($data){

                // dd($row['3']);
                // if(!empty($row[])){
                    $data->phone = $row['3'];
                    $data->save();
                }
            // }
        }

    }
}
