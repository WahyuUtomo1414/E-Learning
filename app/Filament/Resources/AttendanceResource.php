<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Status;
use Filament\Forms\Form;
use App\Models\Attendance;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Attendance Management';

    protected static ?string $navigationLabel = 'Attendance';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->required()
                    ->options(User::where('role_id', 3)->pluck('name', 'id'))
                    ->searchable()
                    ->label('Student')
                    ->columnSpanFull(),
                Section::make('Data Location')
                    ->description('Ambil Dari Google Maps')
                    ->schema([
                        TextInput::make('latitude')
                            ->required(),
                        TextInput::make('longitude')
                            ->required(),
                    ])->columns(2),
                FileUpload::make('foto')
                    ->required()
                    ->image()
                    ->directory('Absensi')
                    ->columnSpanFull(),
                Textarea::make('desc')
                    ->maxLength(255)
                    ->label('Description')
                    ->columnSpanFull(),
                Select::make('status_id')
                    ->required()
                    ->label('Status')
                    ->options(Status::where('status_type_id', 2)->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_date')
                    ->label('Date')
                    ->getStateUsing(fn ($record) => \Carbon\Carbon::parse($record->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y'))
                    ->sortable(),
                TextColumn::make('created_time')
                    ->label('Time')
                    ->getStateUsing(fn ($record) => \Carbon\Carbon::parse($record->created_at->setTimezone('Asia/Jakarta'))->format('H:i:s'))
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Location')
                    ->icon('heroicon-o-map-pin')
                    ->getStateUsing(fn($record) => 
                        new HtmlString("<a href='https://www.google.com/maps?q={$record->latitude},{$record->longitude}' target='_blank' style='color: #3b82f6;'>Lihat Google Maps</a>"))
                    ->html()
                    ->color('info'),
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public'),
                TextColumn::make('desc')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('status.name')
                    ->label('Status')
                    ->sortable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }

    // method untuk memfilter data berdasarkan student yang sedang login
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    
        if (Auth::check() && Auth::user()->role_id === 3) {
            $query->where('created_by', Auth::id());
        }
    
        return $query;
    }
}
