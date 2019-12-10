<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Library;

/**
 * Description of Common
 *
 * @author AE
 */
use Illuminate\Support\Facades\Storage;

class Common {
    //put your code here
    public static function MoveFiles($disk, $filename, $path = null)
    {
        $exists = Storage::disk('temporary')->exists($filename);
        if($exists) {                
            Storage::disk($disk)->put($path . '/' . $filename, Storage::disk('temporary')->get($filename));
            Storage::disk('temporary')->delete($filename);
        }
    }
    
    public static function DeleteFiles($disk, $filename, $path = null)
    {
        $exists = Storage::disk($disk)->exists($path . '/' . $filename);
        if($exists) {                
            Storage::disk($disk)->delete($path . '/' . $filename);
        }
    }
}
