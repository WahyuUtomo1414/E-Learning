<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Support\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $classCount = Classroom::count();
        $tanggal = Carbon::now('Asia/Jakarta')->translatedFormat('d M Y');
        $jam = Carbon::now('Asia/Jakarta')->translatedFormat('H:i:s');
        $user = auth()->user();

        return [
            Stat::make('Date', $tanggal)
                ->color('success')
                ->icon('heroicon-s-calendar')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Have A Good Day', $jam)
                ->color('success')
                ->icon('heroicon-s-bell-alert')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('', 'Attendance')
                ->description('Click to Attendance')
                ->descriptionIcon('heroicon-m-arrows-pointing-in', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer text-primary font-bold',
                    'onclick' => "window.location.href='/attendance'",
                    'style' => 'background-color: #7AE2CF; color: #077A7D;'
                ])
                ->color('white')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Student Count', '242')
                ->description('Student')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([2, 3, 35, 18, 15, 26, 15, 30, 25, 30, 25, 50])
                ->color('success'),
            Stat::make('Teacher Count', '23')
                ->description('Teacher')
                ->descriptionIcon('heroicon-m-briefcase')
                ->chart([32, 23, 35, 18, 15, 56, 15, 30, 25, 30, 25, 30])
                ->color('warning'),
            Stat::make('Class Count', '17')
                ->description('Class')
                ->descriptionIcon('heroicon-m-home')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
        ];
    }
}
