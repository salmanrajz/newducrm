<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question_bank_list extends Model
{
    use HasFactory;
    protected $fillable = [
        'question', 'category_id', 'status'
    ];
}
