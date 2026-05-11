<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')->placeholder('No description'),
                TextEntry::make('department.name')->label('Department'),
            ]);
    }
}
