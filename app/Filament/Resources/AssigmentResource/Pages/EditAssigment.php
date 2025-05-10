<?php

namespace App\Filament\Resources\AssigmentResource\Pages;

use App\Filament\Resources\AssigmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssigment extends EditRecord
{
    protected static string $resource = AssigmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
