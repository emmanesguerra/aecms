<?php

namespace Core\Controller\Uploads;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        
        return view('admin.mod.files.list')->with(compact('data'));
    }
    
    public function filedata($args)
    {
        if($args == 'active') {
            $allFiles = Storage::disk('adminuploadsactive')->files();
        } else {
            $allFiles = Storage::disk('adminuploadsarchived')->files();
        }
        
        $files = array();
        foreach ($allFiles as $file) {
            if($args == 'active') {
                $files[] = $this->fileInfo(pathinfo(storage_path() . '/app/public/adminuploads/actives/' . $file), true);
            } else {
                $files[] = $this->fileInfo(pathinfo(storage_path() . '/app/public/adminuploads/archives/' . $file), false);
            }
        }
        return ['data' => $files];
    }

    public function fileInfo($filePath, $isActive = true)
    {
        $file = array();
        $file['basename'] = $filePath['basename'];
        $file['extension'] = $filePath['extension'];
        if($isActive) {
            $file['path'] = '/storage/adminuploads/actives/'.$filePath['basename'];
        } else {
            $file['path'] = asset('storage/adminuploads/archives/'.$filePath['basename']);
        }
        $file['size'] = number_format(filesize($filePath['dirname'] . '/' . $filePath['basename']) / 1048576, 2) . 'MB';

        return $file;
    }
    
    public function filearchived(Request $request)
    {
        if($request->file) {
        
            $file = $request->file;
            $exists = Storage::disk('adminuploadsactive')->exists($file);
            if($exists) {                
                Storage::disk('adminuploadsarchived')->put('/'.$file, Storage::disk('adminuploadsactive')->get($file));
                Storage::disk('adminuploadsactive')->delete($file);
            }
        
            return response(['file' => $file], 201);
        }
        
        return response(['error' => 'Unable to retrieve the file'], 400);
    }
    
    public function filerestore(Request $request)
    {
        if($request->file) {
        
            $file = $request->file;
            $exists = Storage::disk('adminuploadsarchived')->exists($file);
            if($exists) {                
                Storage::disk('adminuploadsactive')->put('/'.$file, Storage::disk('adminuploadsarchived')->get($file));
                Storage::disk('adminuploadsarchived')->delete($file);
            }
        
            return response(['file' => $file], 200);
        }
        
        return response(['error' => 'Unable to retrieve the file'], 400);
    }
    
    public function filedelete(Request $request)
    {
        if($request->file) {
            $file = $request->file;
            $exists = Storage::disk('adminuploadsarchived')->exists($file);
            if($exists) {                
                Storage::disk('adminuploadsarchived')->delete($file);
            }
        
            return response(['file' => $file], 204);
        }
        
        return response(['error' => 'Unable to retrieve the file'], 400);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
        
            $file = $request->file('file');
            $newname = time() . '_' . strtolower(substr($file->getClientOriginalName(), -15));
            Storage::disk('adminuploadsactive')->put($newname, file_get_contents($file));
        
            return response(['file' => $newname], 200);
        }
        
        return response(['error' => 'Unable to retrieve the file'], 400);
    }
}
