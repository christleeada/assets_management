<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnitType;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnitType::insert(
            [
                ['unit_type' => 'gram'],
                ['unit_type' => 'grams'],
                ['unit_type' => 'piece'],
                ['unit_type' => 'pieces'],
                ['unit_type' => 'kilogram'],
                ['unit_type' => 'kilograms'],
                ['unit_type' => 'meter'],
                ['unit_type' => 'meters'],
                ['unit_type' => 'inch'],
                ['unit_type' => 'inches'],
                ['unit_type' => 'foot'],
                ['unit_type' => 'feet'],
                ['unit_type' => 'centimeter'],
                ['unit_type' => 'centimeters'],
            ]
      );
    }
}
