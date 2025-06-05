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
use Illuminate\Support\Facades\Auth;
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

    protected static ?string $navigationGroup = 'Assigment Management';

    protected static ?string $navigationLabel = 'Assigment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('classroom_id')
                    ->options(Classroom::all()->pluck('level', 'id'))
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
                    ->default(1)
                    ->options(Status::where('status_type_id', 1)->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('classroom.major.name')
                    ->label('Major')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('classroom.level')
                    ->label('Classroom')
                    ->sortable()
                    ->searchable(),
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
                    ->sortable(),
                TextColumn::make('desc')
                    ->limit(50)
                    ->label('Description'),
                TextColumn::make('status.name')
                    ->label('Status')
                    ->searchable()
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
        $query = parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);

        $user = Auth::user();

        if ($user->role_id === 2) {
            // TEACHER: filter by created_by = auth user id
            $query->where('created_by', $user->id);

        } elseif ($user->role_id === 3) {
            // STUDENT: cari classroom_id dari student yang login
            $student = \App\Models\Student::where('user_id', $user->id)->first();

            if ($student) {
                $query->where('classroom_id', $student->classroom_id);
            } else {
                // tidak ditemukan student → jangan tampilkan data
                $query->whereRaw('1 = 0');
            }
        }

        return $query;
    }
}
