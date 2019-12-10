<?php

namespace Core\Controller\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Core\Model\ContactUs;
use Core\Model\ContactUsStoreHours;
use Core\Resources\ContactUs as ContactUsResource;
use Core\Library\Rules;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mod.contactus.list');
    }
    
    public function data()
    {        
        return ContactUsResource::collection(ContactUs::orderBy('id', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->model, Rules::ContactUsInsert());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        $contactus = ContactUs::create(collect($request->model)->only('address', 'contact_person', 'telephone', 'mobile', 'email', 'marker')->toArray());
        
        if($contactus->id > 0) {
            collect($request->model['storehours'])->map(function ($hrs) use($contactus){
                if(!empty($hrs['day'])) {
                    if(isset($hrs['id'])) {
                        if(isset($hrs['isdeleted'])) {
                            ContactUsStoreHours::find($hrs['id'])->delete();
                        } else {
                            ContactUsStoreHours::updateOrCreate(['id' => $hrs['id']], ['day' => $hrs['day'], 'start' => $hrs['start'], 'end' => $hrs['end']]);
                        }
                    } else {
                        ContactUsStoreHours::firstOrCreate(collect($hrs)->put('contact_us_id', $contactus->id)->toArray());
                    }
                }
            });
        }
        
        return response([
            'id'=>$contactus->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'A new contact record has been created <br />', 
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
        return ContactUs::where('id', $id)->with('storehours')->first();
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
        $validation = Validator::make($request->model, Rules::ContactUsUpdate());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        
        $contactus = ContactUs::find($request->model['id']);
        $data = collect($request->model)->only('address', 'contact_person', 'telephone', 'mobile', 'email', 'marker')->toArray();
        $contactus->update($data);
        
        if($contactus->id > 0) {
            collect($request->model['storehours'])->map(function ($hrs) use($contactus){
                if(!empty($hrs['day'])) {
                    if(isset($hrs['id'])) {
                        if(isset($hrs['isdeleted'])) {
                            ContactUsStoreHours::find($hrs['id'])->delete();
                        } else {
                            ContactUsStoreHours::updateOrCreate(['id' => $hrs['id']], ['day' => $hrs['day'], 'start' => $hrs['start'], 'end' => $hrs['end']]);
                        }
                    } else {
                        ContactUsStoreHours::firstOrCreate(collect($hrs)->put('contact_us_id', $contactus->id)->toArray());
                    }
                }
            });
            
            collect($request->removehours)->map(function ($id){
                ContactUsStoreHours::find($id)->delete();
            });
        }
        
        return response([
            'id'=>$contactus->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'Contact id #'.$contactus->id.' has been updated <br />', 
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
        ContactUs::destroy($id);
        
        return response([],204);
    }
}
