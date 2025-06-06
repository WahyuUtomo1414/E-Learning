<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Status;
use App\Models\Student;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\GuardianStudent;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GuardianStudentResource\Pages;
use App\Filament\Resources\GuardianStudentResource\RelationManagers;

class GuardianStudentResource extends Resource
{
    protected static ?string $model = GuardianStudent::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';

    //protected static ?string $navigationLabel = 'Wali Murid';

    //protected static ?string $pluralModelLabel = 'Wali Murid';

    protected static ?string $navigationGroup = 'Student Management';

    protected static ?string $navigationLabel = 'Guardian Student';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('student_id')
                    ->required()
                    ->options(
                        Student::with('user')->get()->pluck('user.name', 'id')
                    )
                    ->label('Student')
                    ->searchable()
                    ->columnSpan(2),
                TextInput::make('name')
                    ->required()
                    ->maxLength(128),
                TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->maxLength(16),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->default(1)
                    ->options(Status::where('status_type_id', 1)->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.user.name')
                    ->label('Student Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label('WhatsApp / Phone Number')
                    ->formatStateUsing(function ($state) {
                        // Ubah 08xxxx menjadi 628xxxx
                        return preg_replace('/^0/', '62', $state);
                    })
                    ->url(fn ($state) => 'https://wa.me/' . preg_replace('/^0/', '62', $state), true)
                    ->color('info')
                    ->openUrlInNewTab()
                    ->searchable(),
                TextColumn::make('status.name')
                    ->label('Status')
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
            'index' => Pages\ListGuardianStudents::route('/'),
            'create' => Pages\CreateGuardianStudent::route('/create'),
            'edit' => Pages\EditGuardianStudent::route('/{record}/edit'),
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
