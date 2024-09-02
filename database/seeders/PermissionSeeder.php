<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'create permission', 'guard_name' => 'web'],
            ['name' => 'view permission', 'guard_name' => 'web'],
            ['name' => 'delete permission', 'guard_name' => 'web'],
            ['name' => 'update permission', 'guard_name' => 'web'],
            ['name' => 'create role', 'guard_name' => 'web'],
            ['name' => 'view role', 'guard_name' => 'web'],
            ['name' => 'update role', 'guard_name' => 'web'],
            ['name' => 'delete role', 'guard_name' => 'web'],
            ['name' => 'create user', 'guard_name' => 'web'],
            ['name' => 'view user', 'guard_name' => 'web'],
            ['name' => 'update user', 'guard_name' => 'web'],
            ['name' => 'delete user', 'guard_name' => 'web'],
        ]);
    }
}
