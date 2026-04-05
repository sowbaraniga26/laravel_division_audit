<?php

namespace App\Filament\Resources\DivisonAudits\Pages;

use App\Filament\Resources\DivisonAudits\DivisonAuditResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDivisonAudit extends ViewRecord
{
    protected static string $resource = DivisonAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
