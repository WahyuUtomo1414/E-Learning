<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\School;
use App\Models\Status;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SchoolResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SchoolResource\RelationManagers;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Manajemen Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(128)
                    ->columnSpanFull(2),
                FileUpload::make('logo')
                    ->required()
                    ->image()
                    ->directory('school')
                    ->columnSpanFull(),
                Select::make('school_master')
                    ->required()
                    ->options(
                        Teacher::with('user')->get()->pluck('user.name', 'id')
                    )
                    ->searchable()
                    ->label('School Master')
                    ->columnSpanFull(),
                Textarea::make('street')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('desc')
                    ->label('Description')
                    ->columnSpanFull(),
                Section::make('Data Location')
                    ->description('Ambil Dari Google Maps')
                    ->schema([
                        TextInput::make('latitude'),
                        TextInput::make('longitude'),
                    ])->columns(2),
                TimePicker::make('school_start_time')
                    ->label('School Start Time')
                    ->placeholder('08:00:00')
                    ->required(),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->options(Status::where('status_type_Id', 1)->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular()
                    ->size(70),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('schoolMaster.user.name')
                    ->label('School Master')
                    ->searchable(),
                TextColumn::make('street')
                    ->label('Street')
                    ->searchable(),
                TextColumn::make('desc')
                    ->label('Description')
                    ->limit(50),
                TextColumn::make('location')
                    ->label('Location')
                    ->icon('heroicon-o-map-pin')
                    ->getStateUsing(fn($record) => 
                        new HtmlString("<a href='https://www.google.com/maps?q={$record->latitude},{$record->longitude}' target='_blank' style='color: #3b82f6;'>Lihat Google Maps</a>"))
                    ->html()
                    ->color('info'),
                TextColumn::make('school_start_time')
                    ->label('School Start Time'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
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
