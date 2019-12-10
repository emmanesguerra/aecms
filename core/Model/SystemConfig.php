<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;

class SystemConfig extends Model implements Auditable {

    use \OwenIt\Auditing\Auditable;

    protected $table = 'systemconfig';
    protected $primaryKey = 'keyword';
    public $incrementing = false;
    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'password'
    ];

    public static function scopeDefaults($query, $params) {
        
        return $query->where('keyword', $params)->first();
    }

}
