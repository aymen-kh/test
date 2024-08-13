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
            'meal_create',
            'item_edit',
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
            'category_show',
        ];

        foreach ($permissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'Super Admin']);

        $role = Role::create(['name' => 'Client']);

        $userPermissions = [
            'reservation_create',
            'reservation_edit',
            'reservation_show',
            'category_show',
        ];

        foreach ($userPermissions as $permission)   {
            $role->givePermissionTo($permission);
        }
    }
}