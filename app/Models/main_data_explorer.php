<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_data_explorer extends Model
{
    use HasFactory;
    protected $fillable = [
        'number','customer_name','contact_number','account_id', 'account_created','status','nationality'
    ];
}
