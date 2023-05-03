<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prefix;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prefix::insert(
            [
                [
                    'prefix' => 'ST',
                    'description' => 'Stock',
                ],
                [
                    'prefix' => 'PR',
                    'description' => 'Purchase Request',
                ],
                [
                    'prefix' => 'PO',
                    'description' => 'Purchase Order',
                ],
                [
                    'prefix' => 'RT',
                    'description' => 'Request Tool',
                ],
                [
                    'prefix' => 'DR-IN',
                    'description' => 'Delivery In',
                ],
                [
                    'prefix' => 'DR-OUT',
                    'description' => 'Delivery Out',
                ],
            ]
      );
    }
}
