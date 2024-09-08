<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fne_data extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','building','unit','address','google_location', '5g_number', 'customer_number','is_status','zone', 'tt_number', 'customer_name','giad','project_type','plan', 'expiry','lat','lng', 'account_id'
    ];
}
