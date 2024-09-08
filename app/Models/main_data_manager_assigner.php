<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_data_manager_assigner extends Model
{
    use HasFactory;
    protected $table ='main_data_manager_assigners_1';
    protected $fillable = [
        'number_id', 'manager_id', 'call_center','old_position'
    ];
}
