<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'user.active', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.create', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.edit', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.delete', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'user.status', 'guard_name' => 'web', 'group_name' => 'User'],
            ['name' => 'permission.active', 'guard_name' => 'web', 'group_name' => 'Permission'],
            ['name' => 'role.active', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.create', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.edit', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.delete', 'guard_name' => 'web', 'group_name' => 'Role'],
            ['name' => 'role.permission', 'guard_name' => 'web', 'group_name' => 'Role'],

            ['name' => 'unit.active', 'guard_name' => 'web', 'group_name' => 'Unit'],
            ['name' => 'unit.create', 'guard_name' => 'web', 'group_name' => 'Unit'],
            ['name' => 'unit.edit', 'guard_name' => 'web', 'group_name' => 'Unit'],
            ['name' => 'unit.delete', 'guard_name' => 'web', 'group_name' => 'Unit'],

            ['name' => 'type.active', 'guard_name' => 'web', 'group_name' => 'Type'],
            ['name' => 'type.create', 'guard_name' => 'web', 'group_name' => 'Type'],
            ['name' => 'type.edit', 'guard_name' => 'web', 'group_name' => 'Type'],
            ['name' => 'type.delete', 'guard_name' => 'web', 'group_name' => 'Type'],

            ['name' => 'item.active', 'guard_name' => 'web', 'group_name' => 'Item'],
            ['name' => 'item.create', 'guard_name' => 'web', 'group_name' => 'Item'],
            ['name' => 'item.edit', 'guard_name' => 'web', 'group_name' => 'Item'],
            ['name' => 'item.delete', 'guard_name' => 'web', 'group_name' => 'Item'],

            ['name' => 'report.active', 'guard_name' => 'web', 'group_name' => 'Report'],

            ['name' => 'item-transaction.active', 'guard_name' => 'web', 'group_name' => 'Item Transaction'],
            ['name' => 'item-transaction.create', 'guard_name' => 'web', 'group_name' => 'Item Transaction'],
            ['name' => 'item-transaction.edit', 'guard_name' => 'web', 'group_name' => 'Item Transaction'],
            ['name' => 'item-transaction.delete', 'guard_name' => 'web', 'group_name' => 'Item Transaction'],
        ];

        Permission::insert($permissions);
    }
}