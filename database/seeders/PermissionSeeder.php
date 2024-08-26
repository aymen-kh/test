<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'user_management_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'ingredient_create',
            'ingredient_edit',
            'ingredient_show',
            'ingredient_delete',
            'ingredient_access',
           // 'meal_create',
            'item_edit',
            'item_create',
            'item_show',
            'item_delete',
            'item_access',
            'reservation_create',
            'reservation_edit',
            'reservation_show',
            'reservation_delete',
            'reservation_access',
            'menu_access',
            'menu_create',
            'menu_show',
            'menu_edit',
            'menu_delete',
            'area_access',
            'area_create',
            'area_show',
            'area_edit',
            'area_delete',
            'table_access',
            'table_create',
            'table_show',
            'table_edit',
            'table_delete',
            'order_access',
            'order_create',
            'order_show',
            'order_edit',
            'order_delete',
            'order_item_access',
            'order_item_create',
            'order_item_show',
            'order_item_edit',
            'order_item_delete',
            'category_access',
            'category_create',
            'category_show',
            'category_edit',
            'category_delete',
            'restaurant_access',
            'restaurant_create',
            'restaurant_show',
            'restaurant_edit',
            'restaurant_delete'
            


            
            
            
        ];

        foreach ($permissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'Admin']);

        $role = Role::create(['name' => 'Client']);

        $userPermissions = [
            'menu_access',
            'menu_show',
            'category_access',
            'category_show',
            'order_access',
            'order_create',
            'order_show',
            'reservation_create',
            'reservation_show',
            'category_show',
            'item_show',
            'item_access',

        ];

        foreach ($userPermissions as $permission)   {
            $role->givePermissionTo($permission);
        }
        
        $role2 = Role::create(['name' => 'Server']);

        $serverPermissions = [
            'category_access',
            'category_create',
            'category_show',
            'table_access',
            'table_create',
            'table_show',
            'table_edit',
            'table_delete',
            'order_access',
            'order_create',
            'order_show',
            'order_edit',
            'order_delete',
            'order_item_access',
            'order_item_create',
            'order_item_show',
            'order_item_edit',
            'order_item_delete',
            'area_show',
            'menu_access',
            'menu_show',
            'item_show',
            'item_edit',
            'item_create',
            'item_access',

        ];

        foreach ($serverPermissions as $permission)   {
            $role2->givePermissionTo($permission);
        }
        $role3 = Role::create(['name' => 'Chef']);

        $ChefPermissions = [
            
            
            'order_access',
            'order_show',
            'order_edit',
            'order_item_access',
            'order_item_show',
            'order_item_edit',
            'menu_access',
            'menu_show',
            'menu_edit',
            'item_show',
            'item_edit',
            'item_access',

        ];

        foreach ($ChefPermissions as $permission)   {
            $role3->givePermissionTo($permission);
        }

        $role4 = Role::create(['name' => 'Deliverer']);

        $deliveryPermissions = [    
            'order_access',
            'order_show',
            'order_edit',
            
        ];

        foreach ($deliveryPermissions as $permission)   {
            $role4->givePermissionTo($permission);
        }

    }
}