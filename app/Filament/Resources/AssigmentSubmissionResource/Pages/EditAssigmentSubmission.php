<?php

namespace App\Filament\Resources\AssigmentSubmissionResource\Pages;

use App\Filament\Resources\AssigmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssigmentSubmission extends EditRecord
{
    protected static string $resource = AssigmentSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
