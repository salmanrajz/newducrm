<?php

namespace App\Imports;

use App\Models\courix_data;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CourixData implements ToCollection,WithStartRow
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
            // dd($row);
            // $random = mt_rand(13455623, 93455632);
            // $request['password'] = Hash::make($random);
            if (!courix_data::where('tracking_no', '=', $row[1])->exists()) {
                courix_data::create([
                    'barcode' => $row['0'],
                    'tracking_no' => $row['1'],
                    'shipper_name' => $row['2'],
                    'area' => $row['3'],
                    'city' => $row['8'],
                    'location_to' => $row['3'],
                    'customer_name' => $row['4'],
                    'customer_mobile' => $row['5'],
                    'cost_of_goods' => $row['7'],
                    'description' => $row['9'],
                ]);
                // dd($row);
            } else {
                // bulknumber::create([
                //     'number' => '00000000000',
                //     'type' => 'P2P',
                // //     // 'channel_type' => $row[8],
                // ]);
                // return "soom";
                // dd($row);
            }
        }
        //
    }
}
