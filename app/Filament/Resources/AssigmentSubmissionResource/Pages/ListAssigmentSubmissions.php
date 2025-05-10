<?php

namespace App\Filament\Resources\AssigmentSubmissionResource\Pages;

use App\Filament\Resources\AssigmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssigmentSubmissions extends ListRecords
{
    protected static string $resource = AssigmentSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
