<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('enrollment_id')
                    ->label('Student Enrollment')
                    ->options(\App\Models\Enrollment::with(['student', 'course'])->get()->mapWithKeys(function ($enrollment) {
                        return [$enrollment->id => "{$enrollment->student?->name} - {$enrollment->course?->name}"];
                    }))
                    ->searchable()
                    ->required(),
                TextInput::make('score')
                    ->required()
                    ->numeric(),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
