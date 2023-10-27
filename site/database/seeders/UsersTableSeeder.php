<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

            //            Admin
            [
                'user_name'=>'Admin',
                'email'=>'admin@ukr.net',
                'password'=>Hash::make('111111'),
                'role'=>'admin',
                'status'=>'active',
            ],

            //            User
            [
                'user_name'=>'User',
                'email'=>'user@ukr.net',
                'password'=>Hash::make('111111'),
                'role'=>'user',
                'status'=>'active',
            ]
        ]);
    }
}
