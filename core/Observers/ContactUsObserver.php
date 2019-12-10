<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Observers;
use Illuminate\Support\Facades\Auth;
use Core\Model\ContactUs;
/**
 * Description of ContactUsObserver
 *
 * @author ai
 */
class ContactUsObserver {
    /**
     * Listen to the User creating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(ContactUs $contact)
    {
        $contact->created_by = Auth::id();
        if($contact->marker) {
            preg_match('/src="([^"]*)"/', $contact->marker, $match);
            if(isset($match[1])) {
                $contact->marker = $match[1];
            }
        }
    }
    
    /**
     * Listen to the User updating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(ContactUs $contact)
    {
        $contact->updated_by = Auth::id();
        if($contact->marker) {
            preg_match('/src="([^"]*)"/', $contact->marker, $match);
            if(isset($match[1])) {
                $contact->marker = $match[1];
            }
        }
    }
}
