<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rules
 *
 * @author ai
 */
namespace Core\Library;

class Rules {
    //put your code here
    public static function UserInsert()
    {
        return [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'middlename' => 'required|max:100',
            'email' => 'required|unique:users,email|max:191',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'usertype' => 'required|max:20'
        ];
    }
    
    public static function UserUpdate($request)
    {        
        return [
            'id' => 'required|exists:users,id',
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'middlename' => 'required|max:100',
            'email' => 'required|max:191|unique:users,email,'.$request->id,
            'password' => 'confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'usertype' => 'required|max:20'
        ];
    }
    
    public static function SettingInsert()
    {
        return [
            'domain_name' => 'required|max:191',
            'website_name' => 'required|max:191',
            'owner' => 'max:191',
            'meta_title' => 'required|max:191',
            'meta_description' => 'required',
            'meta_keywords' => '',
            'timezone' => 'required|max:191',
            'developer' => 'max:191'
        ];
    }
    
    public static function ModuleInsert()
    {
        return [
            'module_name' => 'required|max:50',
            'description' => '',
            'permissions' => 'required|array'
        ];
    }
    
    public static function UserPermissionUpdate()
    {
        return [
            'userid' => 'required|exists:users,id',
            'perms' => 'required'
        ];
    }
    
    public static function PageInsert()
    {
        return [
            'name' => 'required|max:35',
            'url' => 'required|max:100',
            'title' => 'nullable|max:50',
            'description' => '',
            'template' => 'required|max:50'
        ];
    }
    
    public static function PanelsInsert()
    {
        return [
            '*.panel' => 'required',
            '*.html_template' => 'required_if:*.isnew,true',
            '*.name' => 'required',
            '*.isnew' => 'required',  
        ];
    }
    
    public static function PageUpdate()
    {
        return [
            'id' => 'required|exists:pages,id',
            'name' => 'required|max:35',
            'url' => 'required|max:100',
            'title' => 'nullable|max:50',
            'description' => '',
            'template' => 'required|max:50'
        ];
    }
    
    public static function PanelInsert()
    {
        return [
            'html_template' => 'required',
            'name' => 'required', 
            'type' => 'required', 
        ];
    }
    
    public static function PanelUpdate()
    {
        return [
            'id' => 'required|exists:panels,id',
            'html_template' => 'required',
            'name' => 'required', 
            'type' => 'required', 
        ];
    }
    
    public static function ContactUsInsert()
    {
        return [
            'address' => 'required',
            'contact_person' => 'required', 
            'telephone' => 'nullable', 
            'mobile' => 'nullable',
            'email' => 'nullable|email',
            'marker' => 'required'
        ];
    }
    
    public static function ContactUsUpdate()
    {
        return [
            'id' => 'required|exists:contact_us,id',
            'address' => 'required',
            'contact_person' => 'required', 
            'telephone' => 'nullable', 
            'mobile' => 'nullable',
            'email' => 'nullable|email',
            'marker' => 'required'
        ];
    }
}
