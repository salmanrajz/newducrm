<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rfs_matcher extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial_id','name','status'
    ];
}
