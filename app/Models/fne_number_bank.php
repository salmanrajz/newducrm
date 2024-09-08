<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fne_number_bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'system_id','five_jee_number',
        'activation_date',
        'activation_date_full',
        'account_id',
        'customer_number',
        'customer_name',
        'nationality',
        'address',
        'lead_type',
        'status',
        'remarks',
        'soft_dnd',
        'dnd','plan_name'
    ];
}
