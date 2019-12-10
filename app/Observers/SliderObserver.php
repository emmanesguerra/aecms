<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Model\Slider;
use App\Library\Common;
use Carbon\Carbon;

class SliderObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(Slider $slider)
    {
        $now = Carbon::now();
        $slider->year = $now->year;
        $slider->month = $now->month;
        $slider->created_by = Auth::id();
    }
    
    public function created (Slider $slider)
    {
        Common::MoveFiles('slider', $slider->image, $slider->year . "/" . $slider->month . "/" . $slider->id);
    }
    
    /**
     * Listen to the User updating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(Slider $slider)
    {
        $slider->updated_by = Auth::id();
        $original = $slider->getOriginal();
        if($slider->image !== $original['image']) {
            Common::DeleteFiles('slider', $original['image'], $slider->year . "/" . $slider->month . "/" . $slider->id);
            Common::MoveFiles('slider', $slider->image, $slider->year . "/" . $slider->month . "/" . $slider->id);
        }
    }
}
