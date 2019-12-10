<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Panel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'name', 
        'html_template', 
        'type', 
        'module_name', 
        'fn_name'
    ];
    
    public function scopeMain($query) 
    {
        $query->where('type', 'M');
    }
    
    public function scopeRegular($query) 
    {
        $query->where('type', 'P');
    }
    
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_panels')->withPivot('tags');
    }
}