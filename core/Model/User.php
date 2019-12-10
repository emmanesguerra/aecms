<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable, Notifiable;
    
    protected $guarded = [
        'created_by', 
        'updated_by'
    ];
    
    protected $hidden = [
        'password'
    ];
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    
    public function permissions()
    {
        return $this->hasMany(UserPermission::class);
    }
    
    public function hasAccess(string $permission) : bool
    {
        if($this->usertype == 'AE Admin') {
            return true;
        }
        
        foreach($this->permissions as $perm) {
            if ($perm->permission == $permission) {
                return true;
            }
        }
        return false;
    }
}

