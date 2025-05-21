<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttandanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listStatusType = [
            "id" => 2,
            "name" => "Attandance Status",
            "desc" => "Attandance status",
            "active" => 1,
        ];
        StatusType::insert($listStatusType);

        $listStatus = [
            [
                'id' => 4,
                'status_type_id' => 2,
                'name' => 'MASUK',
                "desc" => 'Status for masuk',
                'active' => true,
                'icon' => 'checked',
                'color' => 'primary'
            ],
            [
                'id' => 5,
                'status_type_id' => 2,
                'name' => 'TERLAMBAT',
                "desc" => 'Status for non terlambat',
                'active' => true,
                'icon' => 'x',
                'color' => 'danger'
            ],
            [
                'id' => 6,
                'status_type_id' => 2,
                'name' => 'IZIN',
                "desc" => 'Status for izin',
                'active' => true,
                'icon' => 'folder',
                'color' => 'secondary'
            ],
            [
                'id' => 7,
                'status_type_id' => 2,
                'name' => 'SAKIT',
                "desc" => 'Status for sakit',
                'active' => true,
                'icon' => 'folder',
                'color' => 'secondary'
            ]
        ];
        Status::insert($listStatus);
    }
}
