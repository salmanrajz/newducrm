<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courix_data extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','barcode','tracking_no','shipper_name','area','city','customer_name','customer_mobile','location_to','cost_of_goods','description','remarks','date_of_schedule','time_schedule','reasons'
    ];
}
