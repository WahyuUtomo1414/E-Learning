<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Status;
use App\Models\Attendance;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class AttendanceTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected static ?string $heading = 'List Student Attendance';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Attendance::query()
                    ->with('user')
                    ->when(Auth::user()->role_id == 3, function ($query) {
                        $query->where('user_id', Auth::id());
                    })
            )
            ->defaultPaginationPageOption(10)
            ->columns([
                TextColumn::make('user.name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_date')
                    ->label('Date')
                    ->getStateUsing(fn ($record) => \Carbon\Carbon::parse($record->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y'))
                    ->sortable(),
                TextColumn::make('created_time')
                    ->label('Time')
                    ->getStateUsing(fn ($record) => \Carbon\Carbon::parse($record->created_at->setTimezone('Asia/Jakarta'))->format('H:i:s'))
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Location')
                    ->icon('heroicon-o-map-pin')
                    ->getStateUsing(fn($record) => 
                        new HtmlString("<a href='https://www.google.com/maps?q={$record->latitude},{$record->longitude}' target='_blank' style='color: #3b82f6;'>Lihat Google Maps</a>"))
                    ->html()
                    ->color('info'),
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public'),
                TextColumn::make('desc')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('status.name')
                    ->label('Status')
                    ->sortable(),
                SelectColumn::make('status.name')
                    ->label('Attendance Status')
                    ->options(Status::where('status_type_id', 2)->pluck('name', 'id'))
                    ->disabled(fn () => Auth::user()->role_id == 3)
                    ->searchable()
                    ->sortable(),
            ])
            ->searchable();
    }
}
