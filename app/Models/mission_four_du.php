<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mission_four_du extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename', 'status', 'json_data', 'last_num'
    ];
}
