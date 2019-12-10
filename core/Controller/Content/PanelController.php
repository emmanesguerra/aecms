<?php

namespace Core\Controller\Content;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Core\Model\Panel;
use Core\Resources\Panel as PanelResource;
use Core\Library\Rules;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mod.panel.list');
    }
    
    public function data()
    {        
        return PanelResource::collection(Panel::where('type', 'P')->whereNull('fn_name')
                ->with('pages')->orderBy('id', 'desc')->get());
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
        $validation = Validator::make($request->all(), Rules::PanelInsert());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        $panel = Panel::create($request->only('html_template', 'name', 'type'));
        
        return response([
            'id'=>$panel->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'A new panel has been created <br />', 
            'type' => 'success'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Panel::find($id);
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
        $validation = Validator::make($request->all(), Rules::PanelUpdate());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        $panel = Panel::find($request->id);
        $data = collect($request->only('html_template', 'name', 'type'))->toArray();
        $panel->update($data);
        
        return response([
            'id'=>$panel->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'Panel id#'.$panel->id.' has been updated.<br />', 
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
        //
    }
}
