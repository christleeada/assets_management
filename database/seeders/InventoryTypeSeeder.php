<?php

namespace Database\Seeders;

use App\Models\InventoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryType::insert(
            [
                [
                    'inventory_type' => 'Office Supplies',
                    'post_status_id' => 1,
                ],
                [
                    'inventory_type' => 'Maintenance Supplies',
                    'post_status_id' => 1,

                ],
                [
                    'inventory_type' => 'Assets',
                    'post_status_id' => 1,
                ]
               
            ]
      );
    }
}
