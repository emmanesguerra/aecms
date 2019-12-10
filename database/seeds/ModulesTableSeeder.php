<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'module_name' => 'Main Contents',
            'description' => 'Manage the main contents of the website',
            'permissions' => '["create-maincontents","view-maincontents","update-maincontents","delete-maincontents"]',
            'link' => 'maincontents.index',
            'icon' => 'fa-book',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('modules')->insert([
            'module_name' => 'Panels',
            'description' => 'Manage the panels of the website',
            'permissions' => '["create-panels","view-panels","update-panels","delete-panels"]',
            'link' => 'panels.index',
            'icon' => 'fa-sticky-note',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('modules')->insert([
            'module_name' => 'Uploaded Files',
            'description' => 'Manage the uploaded files on the website (except files uploaded thru different modules)',
            'permissions' => '["create-files","view-files","update-panels","delete-files"]',
            'link' => 'files.index',
            'icon' => 'fa-archive',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('modules')->insert([
            'module_name' => 'Contact Us',
            'description' => 'Manage the settings in the Contact Us page',
            'permissions' => '["view-contact","update-contact"]',
            'link' => 'contactus.index',
            'icon' => 'fa-phone-square',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('panels')->insert([
            'name' => 'Contact Us main',
            'type' => 'M',
            'module_name' => '\App\Http\Controllers\ContactUs\ContactUsController',
            'fn_name' => 'main',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('panels')->insert([
            'name' => 'Contact Us Panel',
            'type' => 'P',
            'module_name' => '\App\Http\Controllers\ContactUs\ContactUsController',
            'fn_name' => 'panel',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
