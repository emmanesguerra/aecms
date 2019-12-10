<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;
    
    protected $fillable = [
        'category_id', 
        'name', 
        'description', 
        'factory_price', 
        'selling_price', 
        'stocks', 
        'is_bestseller', 
        'primary_image', 
        'alternative_image', 
        'sequence'
    ];
    //
    
    protected $appends = ['full_path_primary', 'full_path_alternate'];
    
    public function getFullPathPrimaryAttribute() {
        return asset('storage/products/items/'.$this->id .'/'.$this->primary_image);
    }
    
    public function getFullPathAlternateAttribute() {
        return asset('storage/products/items/'.$this->id .'/'.$this->alternative_image);
    }
    
    public function getIsBestsellerAttribute($value) :bool
    {
        return ($value == 'Y') ? true: false;
    }
    
    public function setIsBestsellerAttribute($value)
    {
        $this->attributes['is_bestseller'] = ($value) ? 'Y': 'N';
    }
    
    public function category () {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }
    
    public function images () {
        return $this->hasMany(ProductImage::class);
    }
}
