<?php

namespace Core\Observers;

use Core\Model\Module;
use Illuminate\Support\Facades\Auth;

class ModuleObserver {
    
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(Module $config)
    {
        $config->created_by = Auth::id();
    }
    
    public function created(Module $config)
    {
        $permissions = json_decode($config->permissions);
        $newformat = [];
        foreach($permissions as $permission) {
            $newformat[] = $permission . '-' . preg_replace('/\s+/', '', strtolower($config->module_name));
        }
        $config->permissions = $newformat;
        $config->save();
    }
    
    public function deleting(Module $config)
    {
        $config->deleted_by = Auth::id();
    }
}
