<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mission_du_second extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename','status','json_data','last_num'
    ];
}
