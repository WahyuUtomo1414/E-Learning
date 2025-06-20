<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Status;
use Filament\Forms\Form;
use App\Models\Attendance;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfolistSection;
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
                    ->getStateUsing(fn ($record) => \Carbon\Carbon::parse($record->created_at->setTimezone('Asia/Jakarta'))->format('H:i:s') . ' WIB')
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Location')
                    ->icon('heroicon-o-map-pin')
                    ->getStateUsing(fn($record) => 
                        new HtmlString("<a href='https://www.google.com/maps?q={$record->latitude},{$record->longitude}' target='_blank' style='color: #3b82f6;'>View Google Maps</a>"))
                    ->html()
                    ->color('info'),
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('absensi'),
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
    
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Attendance Data')
                    ->icon('heroicon-m-calendar-days')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Student Name'),
                        TextEntry::make('created_date')
                            ->label('Date')
                            ->getStateUsing(fn ($record) => \Carbon\Carbon::parse($record->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y')),
                        TextEntry::make('created_time')
                            ->label('Time')
                            ->getStateUsing(fn ($record) => \Carbon\Carbon::parse($record->created_at->setTimezone('Asia/Jakarta'))->format('H:i:s') . ' WIB'),
                        TextEntry::make('location')
                            ->label('Location')
                            ->badge()
                            ->color('blue')
                            ->icon('heroicon-o-map-pin')
                            ->getStateUsing(fn ($record) => 
                                "<a href='https://www.google.com/maps?q={$record->latitude},{$record->longitude}' target='_blank'>View Location</a>")
                            ->html(),
                        ImageEntry::make('foto')
                            ->disk('absensi')
                            ->height(100),
                        TextEntry::make('desc')
                            ->label('Description'),
                        TextEntry::make('status.name')
                            ->label('Status'),
                    ]),
            ])
            ->columns(1)
            ->inlineLabel();
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
