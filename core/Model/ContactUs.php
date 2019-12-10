<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;
    
    protected $table = 'contact_us';
    
    protected $guarded = [
        'created_by', 
        'deleted_by'
    ];
    
    public function storehours()
    {
        return $this->hasMany(ContactUsStoreHours::class);
    }
}
