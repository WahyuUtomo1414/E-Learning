<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listStatusType = [
            "id" => 1,
            "name" => "Default Status",
            "desc" => "New status",
            "active" => 1,
        ];
        StatusType::insert($listStatusType);

        $listStatus = [
            [
                'id' => 1,
                'status_type_id' => 1,
                'name' => 'ACTIVE',
                "desc" => 'Status for active',
                'active' => true,
                'icon' => 'checked',
                'color' => 'primary'
            ],
            [
                'id' => 2,
                'status_type_id' => 1,
                'name' => 'NON_ACTIVE',
                "desc" => 'Status for non active',
                'active' => true,
                'icon' => 'x',
                'color' => 'danger'
            ],
            [
                'id' => 3,
                'status_type_id' => 1,
                'name' => 'DRAFT',
                "desc" => 'Status for draft',
                'active' => true,
                'icon' => 'folder',
                'color' => 'secondary'
            ],
        ];
        Status::insert($listStatus);

    }
}
