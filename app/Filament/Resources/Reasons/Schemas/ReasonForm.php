<?php

namespace App\Filament\Resources\Reasons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReasonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('department_id')
                    ->required()
                    ->relationship(name: 'department', titleAttribute: 'name'),
                Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('status')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}