<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert(
            [
                [
                    'name' => 'Admin',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'Dean',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'Staff',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'Student',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'Encoder',
                    'guard_name' => 'web',
                ],
            ]
      );
    }
}
