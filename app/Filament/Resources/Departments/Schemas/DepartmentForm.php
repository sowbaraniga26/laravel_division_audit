<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('location_id')
                    ->required()
                    ->relationship(name: 'location', titleAttribute: 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('description'),
            ]);
    }
}