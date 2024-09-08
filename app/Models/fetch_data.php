<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fetch_data extends Model
{
    use HasFactory;
    protected $table = "fetch_datas";

    protected $fillable = ['data','order_status','name','name_two','contact','contact_two','nation','nation_two','address','emirate_id','emirate_id_two','dob','five_jee','five_jee_second','account_id','account_id_second','plan_name','plan_name_second','expiry_data','expiry','data_type','cmid','linked_id','rfs_type'];
}
