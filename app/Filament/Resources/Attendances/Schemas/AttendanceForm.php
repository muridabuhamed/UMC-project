<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AttendanceForm
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
                DatePicker::make('date')
                    ->default(now())
                    ->required(),
                \Filament\Forms\Components\ToggleButtons::make('status')
                    ->options([
                        'present' => 'Present',
                        'absent' => 'Absent',
                        'late' => 'Late',
                        'excused' => 'Excused',
                    ])
                    ->colors([
                        'present' => 'success',
                        'absent' => 'danger',
                        'late' => 'warning',
                        'excused' => 'info',
                    ])
                    ->icons([
                        'present' => 'heroicon-o-check-circle',
                        'absent' => 'heroicon-o-x-circle',
                        'late' => 'heroicon-o-clock',
                        'excused' => 'heroicon-o-envelope',
                    ])
                    ->inline()
                    ->default('present')
                    ->required(),
                Textarea::make('remarks')
                    ->placeholder('Optional remarks...')
                    ->columnSpanFull(),
            ]);
    }
}
