<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_docs extends Model
{
    use HasFactory;
    protected $fillable = ['userid','docs'];
}
