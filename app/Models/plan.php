<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_name',
        'local_minutes',
        'flexible_minutes',
        'data',
        'free_minutes',
        'monthly_payment',
        'duration',
        'number_allowed',
        'revenue',
        'status',
        'plan_category', 'is_uae'
    ];
}
