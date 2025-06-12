<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Status;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Sectionn;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\TeacherResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeacherResource\RelationManagers;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'School Management';

    protected static ?string $navigationLabel = 'Teacher';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->required()
                    ->options(User::where('role_id', 2)->pluck('name', 'id'))
                    ->label('User')
                    ->searchable(),
                Hidden::make('teacher_number')
                    ->required()
                    ->default('TC-' . str_pad(mt_rand(0, 99), 4, '0', STR_PAD_LEFT)),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->options(Status::where('status_type_id', 1)->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user.avatar_url')
                    ->label('Foto')
                    ->circular()
                    ->size(70),
                TextColumn::make('user.name')
                    ->label('Teacher Name')
                    ->sortable(),
                TextColumn::make('teacher_number')
                    ->label('Teacher Number')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.phone_number')
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
                Section::make('Teacher Data')
                    ->icon('heroicon-m-briefcase')
                    ->aside()
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        ImageEntry::make('user.avatar_url')
                            ->label('Foto')
                            ->circular()
                            ->size(150)
                            ->columnSpanFull(),
                        TextEntry::make('user.name')
                            ->label('Teacher Name'),
                        TextEntry::make('techer_number')
                            ->label('Teacher Number'),
                        TextEntry::make('user.email')
                            ->label('Email'),
                        TextEntry::make('user.phone_number')
                            ->label('WhatsApp / Phone Number')
                            ->formatStateUsing(function ($state) {
                                // Ubah 08xxxx menjadi 628xxxx
                                return preg_replace('/^0/', '62', $state);
                            })
                            ->url(fn ($state) => 'https://wa.me/' . preg_replace('/^0/', '62', $state), true)
                            ->color('info')
                            ->openUrlInNewTab(),
                    ])->columns(2),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
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
