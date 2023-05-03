<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemCategory;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemCategory::insert(
            [
                ['item_category' => 'Computer'],
                ['item_category' => 'Computer Peripherals'],
                ['item_category' => 'Computer Tools'],
                ['item_category' => 'Office Equipment'],
                ['item_category' => 'Office Furniture'],
                ['item_category' => 'Tool'],
                
            ]
      );
    }
}
