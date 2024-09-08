<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'roleid', 'agent_code', 'role', 'profile', 'emirate', 'phone', 'notify_email', 'jobtype', 'sl', 'cnic_front', 'cnic_back', 'multi_agentcode', 'call_center_ip', 'secondary_ip', 'secondary_email', 'extension', 'business_whatsapp', 'business_whatsapp_undertaking', 'teamleader', 'contact_docs_old', 'cnic_number', 'is_mnp', 'oath_form', 'employment', 'whatsapp_form', 'monthly_commitment'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );

        $receiverNumber = auth()->user()->phone;
        $message = "2FA login code is " . $code;

        $details = [
            'number' => $receiverNumber . ',97144938402',
            'code' => $code,
        ];
        //
        return \App\Http\Controllers\FunctionController::OtpVocusCode($details);
        // \App\Http\Controllers::FunctionController::OtpVocusCode($code);
        //

        // try {

        //     $account_sid = getenv("TWILIO_SID");
        //     $auth_token = getenv("TWILIO_TOKEN");
        //     $twilio_number = getenv("TWILIO_FROM");

        //     $client = new Client($account_sid, $auth_token);
        //     $client->messages->create($receiverNumber, [
        //         'from' => $twilio_number,
        //         'body' => $message
        //     ]);
        // } catch (Exception $e) {
        //     info("Error: " . $e->getMessage());
        // }
    }
}
