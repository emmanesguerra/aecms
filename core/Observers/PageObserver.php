<?php

namespace Core\Observers;

use Core\Model\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageObserver {
    //put your code here
    
    /**
     * Listen to the Page created event.
     *
     * @param  \App\Page  $page
     * @return void
     */
    public function creating(Page $page)
    {
        $temp = $page->template;
        $file = Storage::disk('templates')->get($page->template);
        $pattern = '{{Main}}';
        $pos1  = stripos($pattern, $file);
        
        $page->type = ($pos1 === false) ? 'Index': 'Main';
        $page->template_html = $file;
        $page->created_by = Auth::id();
    }
    
    /**
     * Listen to the Page created event.
     *
     * @param  \App\Page  $page
     * @return void
     */
    public function updating(Page $page)
    {
        $page->updated_by = Auth::id();
    }
}
