<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClawBackTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'alternative_number',
        'remarks',
        'activation_date',
        'mobile_number',
        'lead_source',
        'account_number',
        'sim_serial_number',
        'contract_id',
        'status',
        'billing_cycle',
        'fbd',
        'fbd_bill_date',
        'fbd_21',
        'fbd_90',
        'sbd',
        'sbd_bill_date',
        'sbd_21',
        'sbd_90',
        'tbd',
        'tbd_bill_date',
        'tbd_21',
        'tbd_90',
        'total_pending',
        'clawback',
        'category',
        'plan_name',
        'agent_name',
        'nationality',
    ];
}
