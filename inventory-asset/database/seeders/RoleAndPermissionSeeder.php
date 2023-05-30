<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
           'Add Admin',
           'Edit Admin',
           'Delete Admin',
           'Add Asset',
           'Edit Asset',
           'Delete Asset',
           'Add Location',
           'Edit Location',
           'Delete Location',
           'Add Maintenance',
           'Edit Maintenance',
           'Delete Maintenance',
        ];
             
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'Owner'])->givePermissionTo(Permission::all());
    }
}
