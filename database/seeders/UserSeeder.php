<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'address' => 'unknown',
            'contact_no' => '1234567890',
            'department_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'post_status_id' => 1,
        ]);
        
        $user->assignRole('Admin');
        
    }
}
