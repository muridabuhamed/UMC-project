<?php

namespace App\Filament\Resources\FeePayments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FeePaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('student.name')
                    ->label('Student'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('payment_date')
                    ->date(),
                TextEntry::make('payment_method'),
                TextEntry::make('status'),
                TextEntry::make('reference_number')
                    ->placeholder('-'),
                TextEntry::make('remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
