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
                ['item_category' => 'Desktop Computer',
                'post_status_id' => 1,
            ],
                ['item_category' => 'Laptop',
                'post_status_id' => 1,
            ],
                ['item_category' => 'Computer Peripherals',
                'post_status_id' => 1,
            ],
                ['item_category' => 'Computer Tools',
                'post_status_id' => 1,
            ],
                ['item_category' => 'Office Equipment',
                'post_status_id' => 1,
            ],
                ['item_category' => 'Office Furniture',
                'post_status_id' => 1,
            ],
                ['item_category' => 'Tool',
                'post_status_id' => 1,
            ],
                
            ]
      );
    }
}
