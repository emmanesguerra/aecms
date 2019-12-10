<?php

namespace App\Http\Controllers\Products\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function upload (Request $request)
    {
        if($request->hasFile('file')) {
        
            $file = $request->file('file');
            $newname = time() . '_' . strtolower($file->getClientOriginalName());
            Storage::disk('temporary')->put($newname, file_get_contents($file));
        
            return response(['file' => $newname], 200);
        }
        
        return response(['error' => 'Unable to retrieve the file'], 400);
    }
}
