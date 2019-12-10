<?php

namespace Core\Controller\Modules;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Core\Resources\Module as ModuleResource;
use Core\Model\Module;
use Core\Library\Rules;
use Core\Model\Panel;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mod.modules.list');
    }
    
    public function data()
    {        
        return ModuleResource::collection(Module::orderBy('id', 'desc')->get());
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
        $validation = Validator::make($request->all(), Rules::ModuleInsert());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        $module = Module::create($request->only('module_name', 'description', 'permissions', 'link', 'icon'));
        
        if($module->id > 0) {
            $modname = str_replace(" ", "", title_case($module->module_name));
            Panel::create([
                'name' => $module->module_name . ' Main',
                'type' => 'M',
                'module_name' => '\App\Http\Controllers\\' . $modname . '\\' . $modname . 'Controller',
                'fn_name' => 'main'
            ]);
            
            if($request->includepanel) {
                Panel::create([
                    'name' => $module->module_name . ' Panel',
                    'type' => 'P',
                    'module_name' => '\App\Http\Controllers\\' . $modname . '\\' . $modname . 'Controller',
                    'fn_name' => 'panel'
                ]);
            }
        }
        
        return response([
            'id'=>$module->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'A new module has been created <br />', 
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
        Module::destroy($id);
        
        return response([],204);
    }
}
