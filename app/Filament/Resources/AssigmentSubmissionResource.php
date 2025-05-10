<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssigmentSubmissionResource\Pages;
use App\Filament\Resources\AssigmentSubmissionResource\RelationManagers;
use App\Models\AssigmentSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssigmentSubmissionResource extends Resource
{
    protected static ?string $model = AssigmentSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    
    protected static ?string $navigationGroup = 'Manajemen Tugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('assigment_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('answer_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('score')
                    ->maxLength(3),
                Forms\Components\Textarea::make('feedback')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('created_by')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric(),
                Forms\Components\TextInput::make('deleted_by')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('assigment_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->searchable(),
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
            'index' => Pages\ListAssigmentSubmissions::route('/'),
            'create' => Pages\CreateAssigmentSubmission::route('/create'),
            'edit' => Pages\EditAssigmentSubmission::route('/{record}/edit'),
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
