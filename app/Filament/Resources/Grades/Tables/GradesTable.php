<?php

namespace App\Filament\Resources\Grades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('enrollment.student.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('enrollment.course.name')
                    ->label('Course')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('score')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state >= 90 => 'success',
                        $state >= 60 => 'warning',
                        default => 'danger',
                    }),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('student')
                    ->relationship('enrollment.student', 'name'),
                \Filament\Tables\Filters\SelectFilter::make('course')
                    ->relationship('enrollment.course', 'name'),
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
