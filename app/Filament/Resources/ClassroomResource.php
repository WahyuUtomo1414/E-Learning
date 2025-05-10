<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Major;
use App\Models\Course;
use App\Models\School;
use App\Models\Status;
use App\Models\Student;
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
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClassroomResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClassroomResource\RelationManagers;

class ClassroomResource extends Resource
{
    protected static ?string $model = Classroom::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationLabel = 'Class';

    protected static ?string $pluralModelLabel = 'Class';

    protected static ?string $navigationGroup = 'Manajemen Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('school_id')
                    ->required()
                    ->searchable()
                    ->options(fn () => School::query()->pluck('name', 'id')->toArray())
                    ->label('School'),
                Select::make('teacher_id')
                    ->required()
                    ->searchable()
                    ->options(
                        Teacher::with('user')->get()->pluck('user.name', 'id')
                    )
                    ->label('Guardian Class'),
                Section::make('Class Data')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Select::make('major_id')
                            ->required()
                            ->searchable()
                            ->options(fn () => Major::query()->pluck('name', 'id')->toArray())
                            ->label('Major'),
                        TextInput::make('name')
                            ->required()
                            ->label('Level')
                            ->maxLength(128),
                        TextInput::make('classroom_number')
                            ->required()
                            ->label('Classroom Number')
                            ->maxLength(10),
                        Textarea::make('desc')
                            ->required()
                            ->maxLength(255)
                            ->label('Description')
                            ->columnSpan(3),
                    ])->columns(3),
                Section::make('Student Data')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Select::make('students')
                            ->options(Student::with('user')->get()->pluck('user.name', 'id'))
                            ->multiple()
                            ->required()
                            ->searchable()
                            ->label('Student'),
                    ]),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->searchable()
                    ->options(Status::all()->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school.name')
                    ->sortable(),
                TextColumn::make('teacher.user.name')
                    ->label('Guardian Class')
                    ->sortable(),
                TextColumn::make('major.name')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Level')
                    ->searchable(),
                TextColumn::make('classroom_number')
                    ->label('Class Number')
                    ->searchable(),
                TextColumn::make('desc')
                    ->label('Description')
                    ->searchable(),
                TextColumn::make('students.user.name')
                    ->label('Student')
                    ->listWithLineBreaks(), 
                TextColumn::make('course.name')
                    ->label('Course')
                    ->searchable()
                    ->listWithLineBreaks(),
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
            'index' => Pages\ListClassrooms::route('/'),
            'create' => Pages\CreateClassroom::route('/create'),
            'edit' => Pages\EditClassroom::route('/{record}/edit'),
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
