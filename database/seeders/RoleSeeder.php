<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
          Role::create(['name' => 'Admin']);
         Role::create(['name' => 'Server']);
            Role::create(['name' => 'Deliverer']);
            Role::create(['name' => 'Chef']);
         Role::create(['name' => 'Client ']);
          //  Permission::create(['user' => 'edit articles']);
}
}
