<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'add books']);
        Permission::create(['name' => 'edit books']);
        Permission::create(['name' => 'delete books']);
        Permission::create(['name' => 'view books']);

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $adminRole->givePermissionTo(['add books', 'edit books', 'delete books', 'view books']);
        $userRole->givePermissionTo(['view books']);
    }
}
