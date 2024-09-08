<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class call_center extends Model
{
    use HasFactory;
    protected $fillable = [
        'call_center_name', 'status', 'call_center_code', 'call_center_amount', 'numbers', 'guest_number'
    ];
}
