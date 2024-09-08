<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFaceAi extends Model
{
    use HasFactory;
    protected $fillable = [
        'userid', 'UserImageUrl', 'FaceID', 'persistedFaceId', 'PersonGroupID', 'person_id'
    ];
}
