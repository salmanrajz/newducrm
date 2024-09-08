<?php

namespace App\Imports;

use App\Models\fetch_data;
use App\Models\fne_data;
use App\Models\fne_number_bank;
use App\Models\WhatsAppMnpBank;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportFNEData implements ToCollection,WithStartRow,
    WithChunkReading,
    ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 2;
    }
    public function collection(Collection $collection)
    {
        //
        foreach($collection as $row){


                    // dd($row[4]);
            $date =
                    // \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]);
                    // dd($date);
                $d = WhatsAppMnpBank::where('number',$row[2])->first();
                    // if($d){
                    //     $d->system_id = $row[0];
                    //     $d->save();
                    // }
                if (!WhatsAppMnpBank::where('number', '=', $row[2])->exists()) {

                        $data = WhatsAppMnpBank::create([
                            'number' => $row['2'],
                            'number_id' => $row['7'],
                            'data_valid_from' => '5GData',
                            'status' => '0',
                            'soft_dnd' => $row['2'],
                            'cname' => $row['1'],
                            'activation_date' => $row[4],
                            'fourjee_number' => $row['5'],
                            'nationality' => $row['6'],
                            'language' => $row['3'],
                        ]);

                }
            }
    }
    //
    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
