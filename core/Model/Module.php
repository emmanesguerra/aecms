<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;
    
    protected $guarded = [
        'created_by', 
        'deleted_by'
    ];
    
    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = json_encode($value);
    }
}
