<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert(
            [
                ['status' => 'Active'],
                ['status' => 'Inactive'],
                ['status' => 'Pending'],
                ['status' => 'Approved'],
                ['status' => 'Cancelled'],
                ['status' => 'Lost'],
                ['status' => 'Used'],
                ['status' => 'Posted'],
                ['status' => 'Unpost'],
                ['status' => 'Yes'],
                ['status' => 'No'],
                ['status' => 'On stock'],
                ['status' => 'Out of stock'],
                ['status' => 'Refill the stock'],
                ['status' => 'Under maintenance'],
                ['status' => 'Need maintenance'],
            ]
      );
    }
}
