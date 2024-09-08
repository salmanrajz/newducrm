<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyAch extends Model
{
    use HasFactory;
    protected $fillable = ['userid','week','commitment','status'];
}
