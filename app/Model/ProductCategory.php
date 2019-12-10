<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;
    
    protected $fillable = [
        'name', 
        'short_description', 
        'description', 
        'image', 
        'sequence'
    ];
    //
    
    protected $appends = ['full_path'];
    
    public function getFullPathAttribute() {
        return asset('storage/products/category/'.$this->id .'/'.$this->image);
    }
}
