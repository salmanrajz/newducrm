<?php

namespace App\Imports;

use App\Models\EtisalatDataGame;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportEti implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        //
        foreach ($collection as $row) {
            // dd($row[0]);
            // $random = mt_rand(13455623, 93455632);
            // $request['password'] = Hash::make($random);
            if (!EtisalatDataGame::where('number', '=', $row[0])->exists()) {
                EtisalatDataGame::create([
                    'number' => $row['0'],
                    'prefix' => $row['0'],
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
        //
    }
}
