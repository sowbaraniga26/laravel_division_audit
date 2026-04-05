<?php

namespace App\Filament\Resources\DivisonAudits;

use App\Filament\Resources\DivisonAudits\Pages\CreateDivisonAudit;
use App\Filament\Resources\DivisonAudits\Pages\EditDivisonAudit;
use App\Filament\Resources\DivisonAudits\Pages\ListDivisonAudits;
use App\Filament\Resources\DivisonAudits\Pages\ViewDivisonAudit;
use App\Filament\Resources\DivisonAudits\Schemas\DivisonAuditForm;
use App\Filament\Resources\DivisonAudits\Schemas\DivisonAuditInfolist;
use App\Filament\Resources\DivisonAudits\Tables\DivisonAuditsTable;
use App\Models\DivisonAudit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DivisonAuditResource extends Resource
{
    protected static ?string $model = DivisonAudit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DivisonAuditForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DivisonAuditInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DivisonAuditsTable::configure($table);
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
            'index' => ListDivisonAudits::route('/'),
            'create' => CreateDivisonAudit::route('/create'),
            'view' => ViewDivisonAudit::route('/{record}'),
            'edit' => EditDivisonAudit::route('/{record}/edit'),
        ];
    }
}
