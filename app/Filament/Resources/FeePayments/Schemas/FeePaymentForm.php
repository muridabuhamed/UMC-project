<?php

namespace App\Filament\Resources\FeePayments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FeePaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('amount')
                    ->numeric()
                    ->prefix('$')
                    ->required(),
                DatePicker::make('payment_date')
                    ->default(now())
                    ->required(),
                Select::make('payment_method')
                    ->options([
                        'cash' => 'Cash',
                        'bank_transfer' => 'Bank Transfer',
                        'card' => 'Credit/Debit Card',
                    ])
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ])
                    ->default('completed')
                    ->required(),
                TextInput::make('reference_number')
                    ->placeholder('e.g. TXN123456789'),
                Textarea::make('remarks')
                    ->placeholder('Any additional details...')
                    ->columnSpanFull(),
            ]);
    }
}
