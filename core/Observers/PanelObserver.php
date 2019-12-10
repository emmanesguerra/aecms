<?php

namespace Core\Observers;

use Core\Model\Panel;
use Illuminate\Support\Facades\Auth;

class PanelObserver
{
    
    /**
     * Listen to the Panel creating event.
     *
     * @param  \App\Panel  $panel
     * @return void
     */
    public function creating(Panel $panel)
    {
        $panel->created_by = Auth::id();
    }
    
    /**
     * Listen to the Panel updating event.
     *
     * @param  \App\Panel  $panel
     * @return void
     */
    public function updating(Panel $panel)
    {
        $panel->updated_by = Auth::id();
    }
    
    /**
     * Listen to the Panel deleting event.
     *
     * @param  \App\Panel  $panel
     * @return void
     */
    public function deleting(Panel $panel)
    {
        $panel->deleted_by = Auth::id();
    }
}
