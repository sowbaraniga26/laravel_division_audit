<?php

namespace App\Filament\Resources\DivisonAudits\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use App\Models\Reason;

class DivisonAuditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('location_id')
                    ->relationship(name: 'location', titleAttribute: 'name')
                    ->required(),  
                Select::make('department_id')
                    ->relationship(name: 'department', titleAttribute: 'name')
                    ->required(),                    
                Select::make('reason_id')
                    ->relationship(name: 'reason', titleAttribute: 'reason')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if ($state) {
                            $reason = Reason::find($state);
                            $set('status', $reason?->status);
                        }
                    }),
                DatePicker::make('audit_date')
                    ->required(),
                TextInput::make('status'),
                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }
}
