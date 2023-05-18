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
                ['status' => 'Good'],
                ['status' => 'Disposed'],
                ['status' => 'For Commissioning'],
                ['status' => 'Need maintenance'],
                ['status' => 'Defective'],
            ]
      );
    }
}
