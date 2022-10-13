<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //*************** ADMIN ROLES ******************
        Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        Role::create(['name' => 'Content Management', 'guard_name' => 'admin']);
        Role::create(['name' => 'HR Management', 'guard_name' => 'admin']);
        //*************** DRIVER ROLES ******************
        Role::create(['name' => 'Driver', 'guard_name' => 'driver']);
    }
}
