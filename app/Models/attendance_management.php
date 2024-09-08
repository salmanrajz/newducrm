<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance_management extends Model
{
    use HasFactory;
    protected $fillable = [
        'userid', 'date', 'timing', 'status', 'created_at', 'mobile_status'
    ];
}
