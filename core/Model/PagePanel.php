<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PagePanel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    //
    protected $fillable = [
        'page_id', 
        'panel_id',
        'tags'
    ];
    
    public $timestamps = false;
}
