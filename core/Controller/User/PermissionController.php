<?php

namespace Core\Controller\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Core\Model\User;
use Core\Model\Module;
use Core\Model\UserPermission;
use Core\Library\Rules;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all()->map( function ($module) {
            return [
                "name" => $module->module_name, 
                "permissions" => json_decode($module->permissions)
                    
            ];
        });
        
        $data = [
            'users' => User::select(['id', 'email'])->where('usertype', '!=', 'AE Admin')->get(),
            'modules' => $modules
        ];
        
        return view('admin.mod.user.permissions')->with(compact('data'));
    }
    
    private function flatten(array $array)
    {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
    
    public function getPermission($id)
    {
        $permissions = UserPermission::where('user_id', $id)->get(['permission']);
        
        return response([
            'userid'=> $id,
            'perms'=> $permissions->pluck(['permission'])], 200);
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
        $validation = Validator::make($request->all(), Rules::UserPermissionUpdate());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        $id = $request->userid;
        collect($request->perms)->map(function ($perm) use($id) {
            $user_permission = UserPermission::firstOrCreate([
                'user_id' => $id,
                'permission' => $perm
            ]);
        });
        
        return response([
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'User permission have been configured<br />', 
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
        //
    }
}
