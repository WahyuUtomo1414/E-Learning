<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =[
            [
                "id" => 1,
                'name' => 'Admin',
                'email' => "admin@gmail.com",
                'password' => bcrypt('12345678'),
                'phone_number' => '08123456789',
                'avatar_url' => 'default.png',
                'role_id' => 1,
                'school_id' => null,
                'status_id' => 1,         
            ],
            [
                "id" => 2,
                'name' => 'Teacher',
                'email' => "teacher@gmail.com",
                'password' => bcrypt('12345678'),
                'phone_number' => '08123456789',
                'avatar_url' => 'default.png',
                'role_id' => 2,
                'school_id' => null,
                'status_id' => 1,      
            ],
            [
                "id" => 3,
                'name' => 'Student',
                'email' => "student@gmail.com",
                'password' => bcrypt('12345678'),
                'phone_number' => '08123456789',
                'avatar_url' => 'default.png',
                'role_id' => 3,
                'school_id' => null,
                'status_id' => 1,      
            ]
        ];
        User::insert($user);

        $teacher = [
            'user_id' => 2,
            'teacher_number' => '122313',
            'status_id' => 1,
        ];
        Teacher::insert($teacher);
    }
}
