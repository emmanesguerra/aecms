<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Page extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'name',
        'url',
        'title',
        'description',
        'javascripts',
        'css',
        'template',
        'template_html'
    ];
    
    protected $guarded = [
        'created_by', 
        'updated_by'
    ];
    
    public function getCssAttribute($value)
    {
        if(!empty($value)) {
            return explode(',', $value);
        }
    }
    
    public function setCssAttribute($value)
    {
        if(!empty($value)) {
            $this->attributes['css'] = implode(',', $value);
        }
    }
    
    public function getJavascriptsAttribute($value)
    {
        if(!empty($value)) {
            return explode(',', $value);
        }
    }
    
    public function setJavascriptsAttribute($value)
    {
        if(!empty($value)) {
            $this->attributes['javascripts'] = implode(',', $value);
        } 
    }
    
    public function panels()
    {
        return $this->belongsToMany(Panel::class, 'page_panels')->withPivot('tags');
    }
}
