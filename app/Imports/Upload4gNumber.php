<?php

namespace App\Imports;

use App\Models\WhatsAppMnpBank;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Upload4gNumber implements ToCollection, WithStartRow
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
            if (!WhatsAppMnpBank::where('fourjee_number', '=', $row[1])->exists()) {
                WhatsAppMnpBank::create([
                    'number_id' => '0',
                    'fourjee_number' => $row[1],
                    'activation_date' => $row[2],
                    'account_id' => $row[3],
                    'number' => $row[4],
                    'cname' => $row[5],
                    'data_valid_from' => 'Special4G11K',
                    'nationality' => $row[6],
                    'pcat' => '4G',
                    'status' => '0',
                    'soft_dnd' => 0,
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
