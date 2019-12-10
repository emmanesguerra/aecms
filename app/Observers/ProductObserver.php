<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Model\Product;

class ProductObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(Product $product)
    {
        $product->created_by = Auth::id();
    }
    
    /**
     * Listen to the User updating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(Product $product)
    {
        $product->updated_by = Auth::id();
    }
}
