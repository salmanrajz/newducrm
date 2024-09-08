<?php

namespace App\Console\Commands;

// use App\Models\MissionDU as ModelsMissionDU;
use App\Models\MissionDuFile;
use Illuminate\Console\Command;

class MissionDU extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MissionDu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // echo "SALMAN";
        // for($i = 1; $i<502; $i++){
        //     echo $i . '<br>';
        //     if($i == 0){
        //         echo $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/bgt-1.csv';
        //         MissionDuFile::create([
        //             'filename' => $url,
        //         ]);
        //     }
        //     // else if($i == 1){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/bgt-1.csv';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 2){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.002';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 3){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.003';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 4){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.004';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 5){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.005';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 7){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.006';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 8){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.007';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 9){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.008';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     // else if($i == 10){
        //     //     $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/BGT.009';
        //     //     MissionDuFile::create([
        //     //         'filename' => $url,
        //     //     ]);
        //     // }
        //     else{
        //         $url = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/bgt-' . $i . '.csv';
        //         MissionDuFile::create([
        //             'filename' => $url,
        //         ]);
        //     }
        //     // echo $url;
        // }

        // return Command::SUCCESS;
        $curl = curl_init();
        $m = MissionDuFile::where('status',0)->first();
        // $m = 1;
if ($m) {
    $link = $m->filename;
    // $link = 'https://salmanrajzzdiag.blob.core.windows.net/callmax/mission/mission/bgt-1.csv';
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://40.83.216.125:3000/allNumber',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('file' => new \CURLFILE($link)),
    ));

    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);
    echo 'HTTP code: ' . $httpcode;
    if ($httpcode == 200) {
        // return "Mission Success";
        $details = [
            'number' => '923121337222',
            'data' => 'Success',
            'link' => $link,
            'time' => \Carbon\Carbon::now(),
        ];
        // \App\Http\Controllers\FunctionController::MissionDU($details);
        $m = MissionDuFile::where('filename', $link)->first();
        $m->status = 1;
        $m->save();
    } else {
        $details = [
            'number' => '923121337222',
            'data' => 'Failed',
            'link' => $link,
            'time' => \Carbon\Carbon::now(),

        ];
                // $m = MissionDuFile::where('filename', $link)->first();
                // $m->status = 2;
                // $m->save();
        // \App\Http\Controllers\FunctionController::MissionDU($details);
        // return "Mission Failed";
    }
}
        // echo $response;https://wifi-helpcenter.nokia.com/hc/en-us/articles/360024363913-Change-Wi-Fi-network-name-and-password-

    }
}
