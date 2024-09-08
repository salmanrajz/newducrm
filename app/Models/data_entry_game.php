<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_entry_game extends Model
{
    use HasFactory;
    protected $fillable = [
    'cmid','cmstatus','post_or_hw','status','address','ocr','type'
    ];
}
