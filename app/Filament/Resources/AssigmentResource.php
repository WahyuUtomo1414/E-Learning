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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AssigmentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssigmentResource\RelationManagers;

class AssigmentResource extends Resource
{
    protected static ?string $model = Assigment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Tables\Columns\TextColumn::make('classroom_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('question_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_by')
                    ->numeric()
                    ->sortable(),
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
