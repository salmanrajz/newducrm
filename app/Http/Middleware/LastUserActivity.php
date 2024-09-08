<?php

namespace App\Http\Middleware;

use App\Models\theft_zone;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Auth;
use Cache;
use Carbon\Carbon;


class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1); // keep online for 1 min
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);

            // last seen
            User::where('id', Auth::user()->id)->update(['last_seen' => (new \DateTime())->format("Y-m-d H:i:s")]);
            //
            if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {

                $region_name = $_SERVER["HTTP_CF_IPCOUNTRY"];
                $user_country = $_SERVER["HTTP_CF_IPCOUNTRY"];
                $ipaddress = $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                // $details = json_decode(file_get_contents("http://ipinfo.io/{$ipaddress}"));
                $details = $ipaddress;
            } else {
                $ipaddress =   $request->ip();
                $details = $ipaddress;

                // $details = json_decode(file_get_contents("http://ipinfo.io/{$ipaddress}"));
                // $user_country =   $details->country;
                // $region_name =   $details->region;
            }
            $page_name = url()->current();
            // $da = salman::create([])
            $data = theft_zone::create([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'call_center' => Auth::user()->agent_code,
                'ip_address' => $ipaddress,
                'page_name' => $page_name,
                // ''
            ]);
            // \Mail::mailer('smtp')
            //     // ->to(['muhamin@etisalat.ae', 'oabdulla@etisalat.ae'])
            //     ->to(['parhakooo@gmail.com'])
            //     // ->to([''])
            //     // ->cc(['salmanahmed334@gmail.com'])
            //     // ->bcc(['isqintl@gmail.com','salmanahmed334@gmail.com'])
            //     // ->from('crm.riuman.com','riuman')
            //     ->send(new \App\Mail\CatchtheTheft($data));
            //
        }
        return $next($request);
    }
}
