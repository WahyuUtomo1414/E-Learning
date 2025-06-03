<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Status;
use Filament\Forms\Form;
use App\Models\Assigment;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\AssigmentSubmission;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssigmentSubmissionResource\Pages;
use App\Filament\Resources\AssigmentSubmissionResource\RelationManagers;

class AssigmentSubmissionResource extends Resource
{
    protected static ?string $model = AssigmentSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    
    protected static ?string $navigationGroup = 'Assigment Management';

    protected static ?string $navigationLabel = 'Assigment Submission';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('assigment_id')
                    ->options(Assigment::all()->pluck('name', 'id'))
                    ->label('Assigment')
                    ->required()
                    ->searchable(),
                TextInput::make('answer_link')
                    ->required()
                    ->maxLength(255),
                TextInput::make('score')
                    ->maxLength(3)
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->columnSpan(2),
                Textarea::make('feedback')
                    ->columnSpanFull(),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->searchable()
                    ->default(1)
                    ->options(Status::where('status_type_id', 1)->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assigment.name')
                    ->searchable()
                    ->label('Assigment')
                    ->sortable(),
                TextColumn::make('answer_link')
                    ->url(fn (AssigmentSubmission $record): string => $record->answer_link)
                    ->color('info')
                    ->label('Answer Link')
                    ->openUrlInNewTab()
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('score')   
                    ->sortable()
                    ->searchable(),
                TextColumn::make('feedback')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('status.name')
                    ->label('Status')   
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
