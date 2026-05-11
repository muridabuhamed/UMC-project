<?php

namespace App\Filament\Resources\FeePayments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FeePaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->money()
                    ->sortable(),
                TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->badge()
                    ->color('info'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                    }),
                TextColumn::make('reference_number')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'cash' => 'Cash',
                        'bank_transfer' => 'Bank Transfer',
                        'card' => 'Card',
                    ]),
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ]),
            ])
            ->headerActions([
                \Filament\Actions\ExportAction::make()
                    ->exporter(\App\Filament\Exports\FeePaymentExporter::class),
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
