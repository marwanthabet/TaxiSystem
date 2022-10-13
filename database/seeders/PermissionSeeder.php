<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //*************** ADMIN PERMISSIONS ******************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Driver', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Drivers', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Driver', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Driver', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Type', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Types', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Type', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Type', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Type', 'guard_name' => 'admin-api']);
        Permission::create(['name' => 'Read-Types', 'guard_name' => 'admin-api']);
        Permission::create(['name' => 'Update-Type', 'guard_name' => 'admin-api']);
        Permission::create(['name' => 'Delete-Type', 'guard_name' => 'admin-api']);
        //*************** DRIVER PERMISSIONS ******************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'driver']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'driver']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'driver']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'driver']);

        // Permission::create(['name' => 'Create-Type', 'guard_name' => 'driver']);
        Permission::create(['name' => 'Read-Types', 'guard_name' => 'driver']);
        // Permission::create(['name' => 'Update-Type', 'guard_name' => 'driver']);
        // Permission::create(['name' => 'Delete-Type', 'guard_name' => 'driver']);
    }
}
