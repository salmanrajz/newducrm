<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theft_zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','email','call_center','ip_address','page_name'
    ];
}
