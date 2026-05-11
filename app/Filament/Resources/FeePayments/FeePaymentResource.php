<?php

namespace App\Filament\Resources\FeePayments;

use App\Filament\Resources\FeePayments\Pages\CreateFeePayment;
use App\Filament\Resources\FeePayments\Pages\EditFeePayment;
use App\Filament\Resources\FeePayments\Pages\ListFeePayments;
use App\Filament\Resources\FeePayments\Pages\ViewFeePayment;
use App\Filament\Resources\FeePayments\Schemas\FeePaymentForm;
use App\Filament\Resources\FeePayments\Schemas\FeePaymentInfolist;
use App\Filament\Resources\FeePayments\Tables\FeePaymentsTable;
use App\Models\FeePayment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FeePaymentResource extends Resource
{
    protected static ?string $model = FeePayment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static \UnitEnum|string|null $navigationGroup = 'Administration';

    public static function form(Schema $schema): Schema
    {
        return FeePaymentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FeePaymentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeePaymentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFeePayments::route('/'),
            'create' => CreateFeePayment::route('/create'),
            'view' => ViewFeePayment::route('/{record}'),
            'edit' => EditFeePayment::route('/{record}/edit'),
        ];
    }
}
