<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use Filament\Actions;
use Filament\Tables\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AttendanceResource;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make() // method untuk membuat tombol absen  
                ->label('Create Attendance')
                ->icon('heroicon-o-calendar-days')
                ->color('info')
                ->url(fn () => url('/dummy'))
                ->openUrlInNewTab(false),
        ];
    }
}
