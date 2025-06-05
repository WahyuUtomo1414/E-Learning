<?php

namespace App\Filament\Resources;

use App\Models\Day;
use Filament\Tables;
use App\Models\Course;
use App\Models\Status;
use App\Models\Teacher;
use Filament\Forms\Form;
use App\Models\Classroom;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section as FormSection;
use Filament\Infolists\Components\Section as InfolistSection;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'School Management';

    protected static ?string $navigationLabel = 'Course';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('classroom_id')
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->label('Classroom')
                    ->searchable(),
                Select::make('teacher_id')
                    ->required()
                    ->options(Teacher::with('user')->get()->pluck('user.name', 'id'))
                    ->label('Subject Teachers')
                    ->searchable(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(128)
                    ->columnSpan(2),
                Textarea::make('desc')
                    ->maxLength(255)
                    ->label('Description')
                    ->columnSpan(2),
                TextInput::make('learning_materials')
                    ->label('Learning Materials')
                    ->maxLength(255)
                    ->columnSpan(2),
                FormSection::make('Class Data')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                    Select::make('day_id')
                        ->required()
                        ->options(Day::all()->pluck('name', 'id'))
                        ->label('Day')
                        ->searchable(),
                    TimePicker::make('check_in')
                        ->required()
                        ->native(false),
                    TimePicker::make('check_out')
                        ->required()
                        ->native(false),
                ])->columns(3),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->options(Status::where('status_type_id', 1)->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                TextColumn::make('status.name')
                    ->sortable(),
                TextColumn::make('createdBy.name')
                    ->label('Created By')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updatedBy.name')
                    ->label("Updated by")
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deletedBy.name')
                    ->label("Deleted by")
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Course Data')
                    ->icon('heroicon-m-book-open')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Course Name'),
                        TextEntry::make('classroom')
                            ->label('Class')
                            ->formatStateUsing(function ($record) {
                                return $record->classroom->level . ' - ' . $record->classroom->major->acronym;
                            }),
                        TextEntry::make('teacher.user.name')
                            ->label('Teacher Name'),
                        TextEntry::make('desc')
                            ->label('Description')
                            ->columnSpan(3),
                        TextEntry::make('learning_materials')
                            ->label('Learning Materials')
                            ->url(fn (Course $record): string => $record->learning_materials)
                            ->openUrlInNewTab()
                            ->color('info')
                            ->columnSpan(3),
                    ])
                    ->columns(3),
                InfolistSection::make('Subject Time')
                    ->icon('heroicon-m-clock')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        TextEntry::make('day.name')
                            ->label('Day'),
                        TextEntry::make('check_in')
                            ->label('Check In')
                            ->formatStateUsing(function ($state) {
                                return \Carbon\Carbon::parse($state)->format('H:i') . ' WIB';
                            }),
                        TextEntry::make('check_out')
                            ->label('Check Out')
                            ->formatStateUsing(function ($state) {
                                return \Carbon\Carbon::parse($state)->format('H:i') . ' WIB';
                            }),
                    ])
                    ->columns(3),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);

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

        return $query;
    }

}
