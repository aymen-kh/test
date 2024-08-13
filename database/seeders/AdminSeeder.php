<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {

       $user= User::create([

            'name' => 'admin',
            'email' => 'a@gmail.com',
            'email_verified_at' => now(),
            'password' => '123',
           
        ])->assignRole('Super Admin');
    }
}
