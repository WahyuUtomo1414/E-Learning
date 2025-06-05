<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Course;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class CourseTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    protected static ?string $heading = 'List Course';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Course::query()
                    ->with('status')
                    ->when(true, function ($query) {
                        $user = Auth::user();

                        if ($user->role_id === 2) {
                            // TEACHER: course.teacher.user_id = auth()->id()
                            $query->whereHas('teacher', function ($q) use ($user) {
                                $q->where('user_id', $user->id);
                            });
                        } elseif ($user->role_id === 3) {
                            // STUDENT: cari classroom_id dari student yang login
                            $student = \App\Models\Student::where('user_id', $user->id)->first();

                            if ($student) {
                                $query->where('classroom_id', $student->classroom_id);
                            } else {
                                // tidak ditemukan student → jangan tampilkan data
                                $query->whereRaw('1 = 0');
                            }
                        }
                    })
            )
            ->defaultPaginationPageOption(10)
            ->columns([
                TextColumn::make('name')
                    ->label('Course Name')
                    ->searchable(),
                TextColumn::make('classroom')
                    ->label('Class')
                    ->formatStateUsing(function ($record) {
                        return $record->classroom->level . ' - ' . $record->classroom->major->acronym;
                    })
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('teacher.user.name')
                    ->label('Teacher Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('day.name')
                    ->searchable()
                    ->label('Day')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                TextColumn::make('check_in')
                    ->label('Check In')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return \Carbon\Carbon::parse($state)->format('H:i') . ' WIB';
                    }),
                TextColumn::make('check_out')
                    ->label('Check Out')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return \Carbon\Carbon::parse($state)->format('H:i') . ' WIB';
                    }),
                TextColumn::make('desc')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('learning_materials')
                    ->label('Learning Materials')
                    ->url(fn (Course $record): string => $record->learning_materials)
                    ->openUrlInNewTab()
                    ->color('info')
                    ->searchable(),
            ])
            ->searchable();
    }
}
