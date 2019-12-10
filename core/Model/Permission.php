<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'permission', 
        'auto_define'
    ];
    
    public function scopeAutoDefined($query) 
    {
        return $query->where('auto_define', true);
    }
}