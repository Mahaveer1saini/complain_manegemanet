<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Array of permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];
        
        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        
        // Retrieve admin role
        $adminRole = Role::where('name', 'admin')->first();
        
        // Attach permissions to admin role
        if ($adminRole) {
            $adminRole->permissions()->attach(Permission::all());
        }
    }
       
}

