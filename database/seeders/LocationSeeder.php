<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Location::insert(
            [
                [
                    'dept_id' => 5,
                    'location_name' => 'CS Laboratory', 
                    'location_address' => 'IT Building',
                    'post_status_id' => 1,
                   
                ],
                [
                    'dept_id' => 5,
                    'location_name' => 'Linux Laboratory',
                    'location_address' => 'IT Building', 
                    'post_status_id' => 1,
                   
                ],
                [
                    'dept_id' => 5,
                    'location_name' => 'Cisco Laboratory',
                    'location_address' => 'IT Building', 
                    'post_status_id' => 1,
                   
                ],
                [
                    'dept_id' => 5,
                    'location_name' => 'AVR Yellow',
                    'location_address' => 'IT Building', 
                    'post_status_id' => 1,
                   
                ],
                
                [
                    'dept_id' => 5,
                    'location_name' => 'AVR Maroon',
                    'location_address' => 'IT Building', 
                    'post_status_id' => 1,
                   
                ],

                [
                    'dept_id' => 5,
                    'location_name' => 'AVR Grey',
                    'location_address' => 'IT Building', 
                    'post_status_id' => 1,
                   
                ],
                [
                    'dept_id' => 5,
                    'location_name' => 'AVR Blue',
                    'location_address' => 'IT Building', 
                    'post_status_id' => 1,
                   
                ],
                [
                    'dept_id' => 5,
                    'location_name' => 'CCS Office',
                    'location_address' => 'IT Building', 
                    'post_status_id' => 1,
                   
                ],
                
            ]
      );
    }
}
