<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Major;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school = [
            "id" => 1,
            "name" => "SMK Patriot Nusantara",
            "logo" => "images/2.png",
            "school_master " => 2,
            "street" => "Jl. Sekolah No.26-27 1, RT.1/RW.5, Kamal, Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11810",
            "desc" => "",
            "latitude" => "-6.105245",
            "longitude" => "106.700657",
            "school_start_time" => "07:00:00",
            "status_id" => 1,
        ];
        School::insert($school);

        $major = [
            [
                "id" => 1,
                "name" => "Jaringan Komputer",
                "desc" => "",
                "status_id" => 1,
            ],
            [
                "id" => 2,
                "name" => "Multimedia",
                "desc" => "",
                "status_id" => 1,
            ]
        ];
        Major::insert($major);

        $classroom = [
            [
                'teacher_id' => 2,
                'school_id' => 1,
                'major_id' => 1,
                'level' => '10',
                'classroom_code' => '',
                'desc' => '',
                'status_id' => 1,
            ],
            [
                'teacher_id' => 2,
                'school_id' => 1,
                'major_id' => 1,
                'level' => '11',
                'classroom_code' => '',
                'desc' => '',
                'status_id' => 1,
            ],
            [
                'teacher_id' => 2,
                'school_id' => 1,
                'major_id' => 1,
                'level' => '12',
                'classroom_code' => '',
                'desc' => '',
                'status_id' => 1,
            ]
        ];
        Classroom::insert($classroom);
    }
}
