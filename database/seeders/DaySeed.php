<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DaySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            ['id' => 1, 'name' => 'Monday', 'status_id' => 1],
            ['id' => 2, 'name' => 'Tuesday', 'status_id' => 1],
            ['id' => 3, 'name' => 'Wednesday', 'status_id' => 1],
            ['id' => 4, 'name' => 'Thursday', 'status_id' => 1],
            ['id' => 5, 'name' => 'Friday', 'status_id' => 1],
            ['id' => 6, 'name' => 'Saturday', 'status_id' => 1],
            ['id' => 7, 'name' => 'Sunday', 'status_id' => 1],
        ];

        DB::table('day')->insert($days);
    }
}
