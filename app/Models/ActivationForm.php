<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationForm extends Model
{
    use HasFactory;
    protected $table = 'activation_forms';
    protected $fillable = [
        'customer_name', 'customer_number', 'email', 'emirate_id', 'gender', 'nationality', 'address', 'emirate', 'plans', 'emirate_expiry', 'dob', 'status', 'saler_id', 'saler_name', 'lead_date', 'lead_type', 'lead_no', 'language', 'reff_id', 'additional_docs_name', 'front_id', 'back_id', 'additional_docs_photo', 'work_order_num', 'du_lead_no', 'emirate_id_count', 'activation_screenshot','process_screenshot', 'omid', 'shipment','lead_id','channel_partner','billing_date'
    ];
}
