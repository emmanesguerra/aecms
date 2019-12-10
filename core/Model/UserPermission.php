<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    //
    protected $fillable = [
        'user_id', 
        'permission'
    ];
}
