<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Major;
use App\Models\School;
use App\Models\Status;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Forms\Form;
use App\Models\Classroom;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\ClassroomResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section as FormSection;
use Filament\Infolists\Components\Section as InfolistSection;
use App\Filament\Resources\ClassroomResource\RelationManagers;

class ClassroomResource extends Resource
{
    protected static ?string $model = Classroom::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationLabel = 'Classroom';

    protected static ?string $pluralModelLabel = 'Classroom';

    protected static ?string $navigationGroup = 'School Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('school_id')
                    ->required()
                    ->searchable()
                    ->options(School::all()->pluck('name', 'id'))
                    ->label('School'),
                Select::make('teacher_id')
                    ->required()
                    ->searchable()
                    ->options(
                        Teacher::with('user')->get()->pluck('user.name', 'id')
                    )
                    ->label('Guardian Class'),
                FormSection::make('Class Data')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Select::make('major_id')
                            ->required()
                            ->searchable()
                            ->options(Major::query()->pluck('name', 'id'))
                            ->label('Major'),
                        TextInput::make('level')
                            ->required()
                            ->label('Level')
                            ->maxLength(128),
                        TextInput::make('classroom_code')
                            ->required()
                            ->label('Classroom Code')
                            ->maxLength(10),
                        Textarea::make('desc')
                            ->required()
                            ->maxLength(255)
                            ->label('Description')
                            ->columnSpan(3),
                    ])->columns(3),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->searchable()
                    ->options(Status::where('status_type_id', 1)->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school.name')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('level')
                    ->label('Level')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('classroom_code')
                    ->label('Class Code')
                    ->searchable(),
                TextColumn::make('teacher.user.name')
                    ->label('Guardian Class')
                    ->searchable(),
                TextColumn::make('major.name')
                    ->searchable(),
                TextColumn::make('desc')
                    ->label('Description')
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
                Tables\Actions\DeleteAction::make(),
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
                InfolistSection::make('Classroom Data')
                    ->icon('heroicon-m-square-3-stack-3d')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        TextEntry::make('school.name')
                            ->label('School'),
                        TextEntry::make('major.name')
                            ->label('Major'),
                        TextEntry::make('level')
                            ->label('Level')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('classroom_code')
                            ->label('Class Code'),
                        TextEntry::make('teacher.user.name')
                            ->label('Guardian Class'),
                        TextEntry::make('desc')
                            ->label('Description')
                            ->columnSpan(3),
                    ])->columns(3),
                    // InfolistSection::make('Student Data')
                    //     ->icon('heroicon-m-users')
                    //     ->description('Prevent abuse by limiting the number of requests per period')
                    //     ->schema([
                    //         TextEntry::make('students.user.name')
                    //             ->label('Student')
                    //             ->listWithLineBreaks(),
                    //     ]),
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
