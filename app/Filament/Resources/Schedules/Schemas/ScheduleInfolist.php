<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ScheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('course.name'),
                TextEntry::make('teacher.name'),
                TextEntry::make('day_of_week')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Monday' => 'info',
                        'Tuesday' => 'warning',
                        'Wednesday' => 'success',
                        'Thursday' => 'primary',
                        'Friday' => 'gray',
                        'Saturday' => 'secondary',
                        'Sunday' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('start_time')
                    ->time('H:i'),
                TextEntry::make('end_time')
                    ->time('H:i'),
                TextEntry::make('room_number')
                    ->badge()
                    ->color('gray'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
