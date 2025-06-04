<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            'Bahasa Indonesia',
            'Matematika',
            'Bahasa Inggris',
            'Seni Budaya',
            'Pendidijan Jasmani, Olahraga dan Kesehatan',
            'Pendidikan Kewarganegaraan',
            'Pendidikan Agama dan Budi Pekerti',
            'IPA',
            'IPS',
            'Pendidikan Lingkungan Budaya Jakarta',
        ];

        foreach ($courses as $course) {
            [$checkIn, $checkOut] = $this->generateValidTimeRange();

            DB::table('course')->insert([
                'teacher_id' => 1,
                'classroom_id' => 1,
                'name' => $course,
                'desc' => '',
                'learning_materials' => '',
                'day_id' => rand(1, 5),
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'status_id' => 1,
            ]);
        }
    }

    private function generateValidTimeRange()
    {
        $start = strtotime('07:00');
        $end = strtotime('15:00');

        while (true) {
            $checkIn = rand($start, $end - 3600); // minimal 1 jam durasi
            $checkOut = $checkIn + rand(1800, 3600); // durasi 30–60 menit

            // Cek agar tidak bentrok jam istirahat
            if (
                ($checkIn >= strtotime('12:00') && $checkIn < strtotime('13:00')) ||
                ($checkOut > strtotime('12:00') && $checkOut <= strtotime('13:00')) ||
                ($checkIn < strtotime('12:00') && $checkOut > strtotime('13:00'))
            ) {
                continue; // ulangi jika bentrok
            }

            return [
                date('H:i', $checkIn),
                date('H:i', $checkOut),
            ];
        }
    }
}
