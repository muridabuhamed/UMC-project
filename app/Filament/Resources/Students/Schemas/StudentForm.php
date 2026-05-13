<?php

namespace App\Filament\Resources\Students\Schemas;

use App\Models\Department;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('student_number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Select::make('department_id')
                    ->label('Department')
                    ->options(Department::pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),

                TextInput::make('year')
                    ->numeric()
                    ->default(1)
                    ->required(),

                \Filament\Forms\Components\Textarea::make('summary')
                    ->label('AI Report Summary')
                    ->helperText('Generate this using the AI button on the top right.')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
