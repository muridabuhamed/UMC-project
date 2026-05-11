<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GradeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('enrollment.student.name')
                    ->label('Student'),
                TextEntry::make('enrollment.course.name')
                    ->label('Course'),
                TextEntry::make('score')
                    ->numeric()
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state >= 90 => 'success',
                        $state >= 60 => 'warning',
                        default => 'danger',
                    }),
                TextEntry::make('remarks')
                    ->placeholder('No remarks')
                    ->columnSpanFull(),
            ]);
    }
}
