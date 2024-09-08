<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class face_group_ai extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'userData', 'personGroupId'
    ];
}
