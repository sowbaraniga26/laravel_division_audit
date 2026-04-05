<?php

namespace App\Filament\Resources\DivisonAudits\Pages;

use App\Filament\Resources\DivisonAudits\DivisonAuditResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDivisonAudit extends EditRecord
{
    protected static string $resource = DivisonAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
