<?php

namespace App\Filament\Resources\GuardianStudentResource\Pages;

use App\Filament\Resources\GuardianStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuardianStudent extends EditRecord
{
    protected static string $resource = GuardianStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
