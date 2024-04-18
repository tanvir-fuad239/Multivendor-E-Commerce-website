<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('users')->insert([

            // admin
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'phone' => '+8801409206701',
                'address' => 'Uttara,Dhaka,Bangladesh',
                'role' => 'admin'
            ],

            // vendor 
            [
                'name' => 'vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('vendor'),
                'phone' => '+8801672111566',
                'address' => 'Dhanmondi,Dhaka,Bangladesh',
                'role' => 'vendor'
            ],

             // user 
             [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'phone' => '+8801715579991',
                'address' => 'Mohammadpur,Dhaka,Bangladesh',
                'role' => 'user'
            ]

            ]);
    }
}
