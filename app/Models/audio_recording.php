<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audio_recording extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'audio_file','username','lead_no','status'
    ];
}
