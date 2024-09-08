<?php

namespace App\Imports;

use App\Models\danger_zone;
use App\Models\data_entry_game;
use App\Models\rfs_matcher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportCMID implements ToCollection,WithStartRow
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
        foreach($collection as $row){
            // dd($row);
            $da = rfs_matcher::where('name',$row[0])->first();
            if($da){

                $da->status = $row[2];
                $da->save();
            }
                    // rfs_matcher::create([
                        // 'serial_id' => $row[0],
                        // 'name' => $row[1],
                    // ]);
        }
    }
}
