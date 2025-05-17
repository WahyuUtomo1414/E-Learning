<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use App\Models\Status;
use Filament\Forms\Form;
use App\Models\Assigment;
use App\Models\Classroom;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AssigmentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssigmentResource\RelationManagers;

class AssigmentResource extends Resource
{
    protected static ?string $model = Assigment::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Manajemen Tugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('classroom_id')
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->label('Classroom')
                    ->required()
                    ->searchable(),
                Select::make('course_id')
                    ->required()
                    ->options(Course::all()->pluck('name', 'id'))
                    ->label('Course')
                    ->searchable(),
                TextInput::make('name')
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(128),
                Textarea::make('desc')
                    ->label('Description')
                    ->columnSpanFull(),
                TextInput::make('question_link')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('deadline')
                    ->required()
                    ->native(false),
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
                TextColumn::make('classroom.major.name')
                    ->label('Major')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('classroom_full')
                    ->label('Classroom')
                    ->getStateUsing(fn ($record) => $record->classroom->name . ' - ' . $record->classroom->classroom_number),
                TextColumn::make('course.name')
                    ->label('Course')
                    ->sortable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('question_link')
                    ->searchable()
                    ->url(fn (Assigment $record): string => $record->question_link)
                    ->openUrlInNewTab()
                    ->color('info')
                    ->limit(50),
                TextColumn::make('deadline')
                    ->date()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('status.name')
                    ->label('Status')
                    ->searchable()
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
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListAssigments::route('/'),
            'create' => Pages\CreateAssigment::route('/create'),
            'edit' => Pages\EditAssigment::route('/{record}/edit'),
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
