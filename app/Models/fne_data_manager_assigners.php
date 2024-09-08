<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fne_data_manager_assigners extends Model
{
    use HasFactory;
    protected $fillable = [
        'number_id',
        'manager_id',
        'call_center',
        'status',
    ];
}
