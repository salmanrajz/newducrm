<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class remarks_fne extends Model
{
    use HasFactory;
    protected $table = 'remarks_fne';
    protected $fillable = [
        'remarks',
        'lead_status',
        'lead_id',
        'remarks',
        'lead_no',
        'date_time',
        'user_name',
        'source',
        'user_id',

    ];
}
