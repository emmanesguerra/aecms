<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('systemconfig')->insert([
            'keyword' => 'developer',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('systemconfig')->insert([
            'keyword' => 'domain_name',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('systemconfig')->insert([
            'keyword' => 'meta_description',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('systemconfig')->insert([
            'keyword' => 'meta_keywords',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('systemconfig')->insert([
            'keyword' => 'meta_title',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('systemconfig')->insert([
            'keyword' => 'owner',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('systemconfig')->insert([
            'keyword' => 'timezone',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('systemconfig')->insert([
            'keyword' => 'website_name',
            'keyvalue' => '',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
