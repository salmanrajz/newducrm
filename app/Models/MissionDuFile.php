<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionDuFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename','status'
    ];
    // protected $fillable = ['filename','status'];
}
