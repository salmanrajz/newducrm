<?php

namespace App\Imports;

use App\Models\ClawBackTable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClawBackImportExcel implements ToCollection,WithStartRow
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
        // dd($collection);
        ini_set('max_execution_time', '3000'); //300 seconds = 5 minutes
        ini_set('max_file_uploads', '300');
        foreach ($collection as $row) {
            // dd($row[0]);
           $d = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['0'])->format('d/m/Y');
           $fbd_bill_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])->format('d/m/Y');
        //    dd($fbd_bill_date);
        // if($fbd_bill_date == '01/01/1970'){
        //     dd("dom");
        // }
        // else{
        //     dd("home");
        // }
           $sbd_bill_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13])->format('d/m/Y');
           $tbd_bill_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[17])->format('d/m/Y');
           if($fbd_bill_date != '01/01/1970'){
            // dd("zzz");
               $fbd_bill_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])->format('d/m/Y');
           }else{
            $fbd_bill_date=NULL;
           }
           if($sbd_bill_date != '01/01/1970' ){
               $sbd_bill_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13])->format('d/m/Y');
           }else{
                $sbd_bill_date=NULL;
           }
           if($tbd_bill_date != '01/01/1970'){
               $tbd_bill_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[17])->format('d/m/Y');
           }else{
                $tbd_bill_date=NULL;
           }
            // dd($sbd_bill_date);
            ClawBackTable::create([
                'customer_name' => $row[26],
                'alternative_number' => $row[27],
                'remarks' => $row[28],
                'activation_date' => $d,
                'mobile_number' => $row[1],
                'lead_source' => $row[2],
                'account_number' => $row[3],
                'sim_serial_number' => $row[4],
                'contract_id' => $row[5],
                'status' => $row[6],
                'billing_cycle' => $row[7],
                'fbd' => $row[8],
                'fbd_bill_date' => $fbd_bill_date,
                'fbd_21' => $row[10],
                'fbd_90' => $row[11],
                'sbd' => $row[12],
                'sbd_bill_date' => $sbd_bill_date,
                'sbd_21' => $row[14],
                'sbd_90' => $row[15],
                'tbd' => $row[16],
                'tbd_bill_date' => $tbd_bill_date,
                'tbd_21' => $row[18],
                'tbd_90' => $row[19],
                'total_pending' => $row[20],
                'clawback' => $row[21],
                'category' => $row[22],
                'plan_name' => $row[23],
                'agent_name' => $row[24],
                'nationality' => $row[25],
            ]);
        }
    }
}
