<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert(
            [
                [
                    'department' => 'Admin',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Agriculture',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Arts and Sciences',
                    'post_status_id' => 1,

                ],
                [
                    'department' => 'College of Business and Administration',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Computer Studies',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Criminology',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Education',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Law and Jurisprudence',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Hospitality Management',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'College of Nursing',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'Department of Architecture and Fine Arts',
                    'post_status_id' => 1,
                ],
                [
                    'department' => 'School of Industrial Engineering',
                    'post_status_id' => 1,
                ],
               
            ]
      );
    }
}
