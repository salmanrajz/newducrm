<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lead_sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name','customer_number','email','emirate_id','gender','nationality','address','emirate','plans','emirate_expiry','dob','status','saler_id','saler_name','lead_date','lead_type','lead_no', 'language','reff_id', 'additional_docs_name','front_id','back_id', 'additional_docs_photo', 'work_order_num','du_lead_no', 'emirate_id_count','activation_screenshot', 'process_screenshot','omid','shipment', 'alternative_number', '4g_id', '4g_account', 'fourjee_id', 'fourjee_account','channel_partner','shared_with','contract_id','billing_cycle','account_id','billing_date','for_tracker', 'appointment_date', 'is_old', 'closing_date', 'lead_reff','fne_account_id', 'five_expiry', 'data_lead_id', 'reff_base', 'fne_work_order_num', 'fne_activity_number', 'fne_visit_date', 'activity_date', 'work_order_date','short_code','id_type','old_billing_cycle','old_account_id','old_account_emirate_id','old_fivejee_number','old_registered_number','old_registered_email','old_expiry_date','old_dob','cancel_status','commision',
        'tt_number'
    ];
}
