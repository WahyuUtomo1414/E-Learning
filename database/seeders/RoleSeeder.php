<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            [
                "id" => 1,
                'name' => 'Admin',
                'desc' => "Administrator role",
                'status_id' => 1,
            ],
            [
                "id" => 2,
                'name' => 'Teacher',
                'desc' => "Teacher role",
                'status_id' => 1,
            ],
            [
                "id" => 3,
                'name' => 'Student',
                'desc' => "Student role",
                'status_id' => 1,
            ],
        ];
        Role::insert($role);
    }
}
