<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dnd_aashir extends Model
{
    use HasFactory;
    protected $fillable = [
        'system_dnd','vicidial_dnd','yeastar_dnd','old_yeastar_dnd','type','userid','username'
    ];
}
