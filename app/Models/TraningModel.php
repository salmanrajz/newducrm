<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraningModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_name','description','docs_url','video_url','status'
    ];
}
