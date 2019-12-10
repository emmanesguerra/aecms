<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class ContactUsStoreHours extends Model
{
    //
    protected $table = 'contact_us_store_hours';
    
    protected $fillable = [
        'contact_us_id',
        'day',
        'start',
        'end'
    ];
    
    public $timestamps = false;
}
