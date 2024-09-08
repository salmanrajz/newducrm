<?php

namespace App\Imports;

use App\Models\main_data_explorer;
use App\Models\WhatsAppMnpBank;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Upload5gNumber implements ToCollection, WithStartRow
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
        ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
        ini_set('max_file_uploads', '300');
        //
        foreach ($collection as $row) {
            // dd($row[2]);
            // $a = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]));
            // dd($a);
            // $random = mt_rand(13455623, 93455632);
            // $request['password'] = Hash::make($random);
            if (!main_data_explorer::where('number', '=', $row[1])->exists()) {
                main_data_explorer::create([
                    'number' => $row[1],
                    'account_created' => $row[2],
                    'account_id' => $row[3],
                    'contact_number' => $row[4],
                    'customer_name' => $row[5],
                    'status' => $row[6],
                    'nationality' => $row[7],
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
