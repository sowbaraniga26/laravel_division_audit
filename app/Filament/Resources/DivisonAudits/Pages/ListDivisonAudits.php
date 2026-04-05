<?php

namespace App\Filament\Resources\DivisonAudits\Pages;

use App\Filament\Resources\DivisonAudits\DivisonAuditResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDivisonAudits extends ListRecords
{
    protected static string $resource = DivisonAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
