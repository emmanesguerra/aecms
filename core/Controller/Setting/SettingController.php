<?php

namespace Core\Controller\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Core\Library\DropdownOptions;
use Core\Library\Rules;
use Core\Library\Common;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        
        $tags = Common::get_settings('meta_keywords');
        $data['tags'] = (!empty($tags)) ? explode(',', $tags): [];
        $data['timezones'] = DropdownOptions::timezones();
        $data['model'] = [
            'developer' => Common::get_settings('developer'),
            'domain_name' => Common::get_settings('domain_name'),
            'meta_description' => Common::get_settings('meta_description'),
            'meta_keywords' => Common::get_settings('meta_keywords'),
            'meta_title' => Common::get_settings('meta_title'),
            'owner' => Common::get_settings('owner'),
            'timezone' => Common::get_settings('timezone'),
            'website_name' => Common::get_settings('website_name'),
            'email_subject' => Common::get_settings('email_subject'),
            'email_recipients' => Common::get_settings('email_recipients'),
            'email_cc' => Common::get_settings('email_cc'),
            'email_bcc' => Common::get_settings('email_bcc'),
        ];
        
        return view('admin.mod.settings.form')->with(compact('data'));
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
        $validation = Validator::make($request->all(), Rules::SettingInsert());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        foreach ($request->all() as $key => $value) {
            if($key == 'meta_keywords') {
                $value = ($value) ? implode(',', $value): $value;
            }
            
            Common::save_settings($key, $value);
        }
        
        return response([
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'System settings have been configured<br />', 
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
