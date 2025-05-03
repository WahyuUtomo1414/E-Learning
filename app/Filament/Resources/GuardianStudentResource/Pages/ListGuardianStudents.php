<?php

namespace App\Filament\Resources\GuardianStudentResource\Pages;

use App\Filament\Resources\GuardianStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuardianStudents extends ListRecords
{
    protected static string $resource = GuardianStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
