<?php

namespace App\Http\Controllers\Sliders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slider;

class SlidersController extends Controller
{
    //
    public function panel()
    {
        $sliders = Slider::all();
        
        $data = [
            'slider' => $sliders
        ];
        
        return view('slider.slider')->with(compact('data'));
    }
}
