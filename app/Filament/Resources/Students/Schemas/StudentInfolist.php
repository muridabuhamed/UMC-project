<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('student_number')->label('Student Number'),
                TextEntry::make('department.name')->label('Department'),
                TextEntry::make('year'),
            ]);
    }
}
