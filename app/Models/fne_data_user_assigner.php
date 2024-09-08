<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fne_data_user_assigner extends Model
{
    use HasFactory;
    protected $fillable = [
        'number_id', 'user_id', 'call_center', 'status', 'mark_dnd', 'mark_soft_dnd', 'other_remarks', 'remarks_by_tl'
    ];
}
