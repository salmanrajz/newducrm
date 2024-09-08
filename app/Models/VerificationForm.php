<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name', 'customer_number', 'email', 'emirate_id', 'gender', 'nationality', 'address', 'emirate', 'plans', 'emirate_expiry', 'dob', 'status', 'saler_id', 'saler_name', 'lead_date', 'lead_type', 'lead_no', 'language', 'reff_id','verify_agent','lead_id', 'work_order_num'
    ];
}
