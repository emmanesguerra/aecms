<?php

namespace App\Http\Controllers\Sliders\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Model\Slider;
use App\Http\Resources\Slider as SliderResource;
use App\Library\Rules;
use App\Library\Common;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('slider.admin.list');
    }
    
    public function data()
    {        
        return SliderResource::collection(Slider::orderBy('id', 'desc')->get());
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
        $validation = Validator::make($request->all(), Rules::SliderInsert());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        try
        {
            DB::beginTransaction();
            
            $slider = Slider::create($request->only('header', 'description', 'image', 'sequence'));
            
            DB::commit();
            
            return response([
                'id'=>$slider->id, 
                'icon'=> 'icon glyphicon glyphicon-ok-sign',
                'title'=> 'Action Completed',
                'message' => 'A new slider record has been created <br />', 
                'type' => 'success'], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            return response([
                'icon'=> '<i class="material-icons" style="float: left; font-size: 3.5rem; margin: 15px 10px 15px 0;">error</i>',
                'title'=> 'Action Terminated',
                'message' => $ex->getMessage(),  
                'type' => 'danger'], 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Slider::find($id);
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
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), Rules::SliderUpdate());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        $data = collect($request->only('header', 'description', 'image', 'sequence'))->toArray();
        
        $slider = Slider::find($request->id);
        $slider->update($data);
        
        return response([
            'id'=>$slider->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'Slider record #'.$slider->id.' has been updated <br />', 
            'type' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        
        if($slider) {
            Common::DeleteFiles('slider', $slider->image, $slider->year . "/" . $slider->month . "/" . $slider->id);
            Slider::destroy($id);
        }
        
        return response([],204);
    }
    
    public function upload(Request $request)
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
