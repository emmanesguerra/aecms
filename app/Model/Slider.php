<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;
    
    protected $fillable = [
        'header', 
        'description', 
        'image', 
        'year', 
        'month', 
        'sequence'
    ];
    //
    
    protected $appends = ['full_path'];
    
    public function getFullPathAttribute() {
        return asset('storage/slider/'.$this->year.'/'.$this->month.'/'.$this->id.'/'.$this->image);
    }
}
