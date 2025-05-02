<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $classCount = Classroom::count();
        return [
            Stat::make('Jumlah Peserta Didik', '242')
                ->description('Peserta')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([2, 3, 35, 18, 15, 26, 15, 30, 25, 30, 25, 50])
                ->color('success'),
            Stat::make('Jumlah Guru', '23')
                ->description('Guru')
                ->descriptionIcon('heroicon-m-briefcase')
                ->chart([32, 23, 35, 18, 15, 56, 15, 30, 25, 30, 25, 30])
                ->color('warning'),
            Stat::make('Jumlah Kelas', '17')
                ->description('Kelas')
                ->descriptionIcon('heroicon-m-home')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
        ];
    }
}
