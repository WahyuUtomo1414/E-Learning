<?php

namespace App\Filament\Exports;

use App\Models\Attendance;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AttendanceExporter extends Exporter
{
    protected static ?string $model = Attendance::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('user.name')
                ->label('Student Name'),
            ExportColumn::make('location')
                ->label('Location')
                ->formatStateUsing(function ($record) {
                    if ($record->latitude && $record->longitude) {
                        $url = "https://www.google.com/maps?q={$record->latitude},{$record->longitude}";
                        return "<a href=\"{$url}\" target=\"_blank\">View on Google Maps</a>";
                    }
                    return '-';
                })
                ->html(),
            ExportColumn::make('foto')
                ->label('Foto')
                ->formatStateUsing(function ($record) {
                    if ($record->foto) {
                        $appName = config('app.name');
                        $url = url("storage/absensi/{$record->foto}");
                        return "<a href=\"{$url}\" target=\"_blank\">{$appName} - View Foto</a>";
                    }
                    return '-';
                })
                ->html(),
            ExportColumn::make('desc'),
            ExportColumn::make('status.name')
                ->label('Staus'),
            ExportColumn::make('created_by'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your attendance export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
