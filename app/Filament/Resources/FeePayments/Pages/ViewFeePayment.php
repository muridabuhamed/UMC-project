<?php

namespace App\Filament\Resources\FeePayments\Pages;

use App\Filament\Resources\FeePayments\FeePaymentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFeePayment extends ViewRecord
{
    protected static string $resource = FeePaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
