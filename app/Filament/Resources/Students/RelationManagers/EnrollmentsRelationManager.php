<?php

namespace App\Filament\Resources\Students\RelationManagers;

use App\Filament\Resources\Enrollments\EnrollmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $relatedResource = EnrollmentResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('course.name')
                    ->label('Course')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('course.department.name')
                    ->label('Department')
                    ->badge()
                    ->color('info'),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Enrollment Date')
                    ->date(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
