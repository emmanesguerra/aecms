<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Model\ProductCategory;

class ProductCategoryObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(ProductCategory $category)
    {
        $category->created_by = Auth::id();
    }
    
    /**
     * Listen to the User updating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(ProductCategory $category)
    {
        $category->updated_by = Auth::id();
    }
}
