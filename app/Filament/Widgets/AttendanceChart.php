<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class AttendanceChart extends ChartWidget
{
    protected static ?string $heading = 'Attendance Chart';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
         // Mengelompokkan attendance berdasarkan status.name
        // $data = Attendance::select('status.name as status_name', DB::raw('count(*) as total'))
        //     ->join('status', 'attendance.status_id', '=', 'status.id')
        //     ->groupBy('status.name')
        //     ->pluck('total', 'status_name')
        //     ->toArray();
        
        // Dummy data untuk $data
        $data = [
            'Hadir' => 40,
            'Izin' => 10,
            'Sakit' => 5,
            'Alpha' => 3,
        ];

        // filter berdasarkan role user
        $query = Attendance::query()
            ->with('user', 'status');

        if (auth()->user()->role_id === 3) {
            $query->whereHas('user', function ($q) {
            $q->where('created_by', auth()->id());
            });
        }

        return [
            'datasets' => [
                [
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#f87171', // merah
                        '#34d399', // hijau
                        '#60a5fa', // biru
                        '#facc15', // kuning
                        '#a78bfa', // ungu
                        '#fb923c', // oranye
                    ],
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
