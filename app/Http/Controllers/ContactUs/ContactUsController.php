<?php

namespace App\Http\Controllers\ContactUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AECore\Model\ContactUs;
use App\AECore\Library\Modules\SystemConfigLibrary;

class ContactUsController extends Controller
{
    //
    public function main()
    {
        $contact = ContactUs::with('storehours')->get();
        
        $data = [
            'contacts' => $contact
        ];
        
        return view('contactus.form')->with(compact('data'));
    }
    
    public function post()
    {
        
    }
}
