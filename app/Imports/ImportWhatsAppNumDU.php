<?php

namespace App\Imports;

use App\Models\WhatsAppMnpBank;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportWhatsAppNumDU implements
    ToCollection,
    WithStartRow,
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
        foreach ($collection as $row) {
            // dd($row[0]);
            // $random = mt_rand(13455623, 93455632);
            // $request['password'] = Hash::make($random);
            if (!WhatsAppMnpBank::where('number', '=', $row[1])->exists()) {
                WhatsAppMnpBank::create([
                    'number_id' => '0',
                    'number' => $row['1'],
                    'data_valid_from' => $row['3'],
                    'status' => '0',
                    'soft_dnd' => $row['2'],
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
    public function batchSize(): int
    {
        return 5000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
