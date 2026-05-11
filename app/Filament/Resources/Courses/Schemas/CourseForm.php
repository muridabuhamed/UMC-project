<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Models\Department;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->nullable()
                    ->rows(3),

                Select::make('department_id')
                    ->label('Department')
                    ->options(Department::pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
            ]);
    }
}
