<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppMnpBank extends Model
{
    use HasFactory;
    protected $table = 'whats_app_mnp_banks_1';
    protected $fillable = [
        'number', 'number_id', 'language', 'status', 'remarks', 'soft_dnd', 'dnd', 'data_valid_from','account_id', 'fourjee_number','pcat','cname','nationality', 'activation_date',
    ];
}
