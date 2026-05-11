<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('teacher.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('day_of_week')
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
                TextColumn::make('start_time')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('end_time')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('room_number')
                    ->searchable()
                    ->badge()
                    ->color('gray'),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('day_of_week')
                    ->options([
                        'Monday' => 'Monday',
                        'Tuesday' => 'Tuesday',
                        'Wednesday' => 'Wednesday',
                        'Thursday' => 'Thursday',
                        'Friday' => 'Friday',
                        'Saturday' => 'Saturday',
                        'Sunday' => 'Sunday',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
