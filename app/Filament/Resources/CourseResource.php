<?php

namespace App\Filament\Resources;

use App\Models\Day;
use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use App\Models\Status;
use App\Models\Teacher;
use Filament\Forms\Form;
use App\Models\Classroom;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseResource\RelationManagers;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Manajemen Sekolah';

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
                Section::make('Class Data')
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
                    ->options(Status::all()->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('classroom.name')
                    ->sortable(),
                TextColumn::make('teacher.user.name')
                    ->label('Teacher Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('desc')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('learning_materials')
                    ->label('Learning Materials')
                    ->searchable(),
                TextColumn::make('day.name')
                    ->searchable()
                    ->label('Day')
                    ->sortable(),
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
                TextColumn::make('status.name')
                    ->sortable(),
                TextColumn::make('createdBy.name')
                    ->label('Created By'),
                TextColumn::make('updatedBy.name')
                    ->label("Updated by"),
                TextColumn::make('deletedBy.name')
                    ->label("Deleted by"),
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
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
