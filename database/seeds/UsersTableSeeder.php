<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Emmanuelle',
            'middlename' => 'Magtibay',
            'lastname' => 'Esguerra',
            'email' => 'emman.esguerra@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('emman'),
            'usertype' => 'AE Admin',
            'created_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
