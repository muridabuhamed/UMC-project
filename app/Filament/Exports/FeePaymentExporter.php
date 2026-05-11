<?php

namespace App\Filament\Exports;

use App\Models\FeePayment;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class FeePaymentExporter extends Exporter
{
    protected static ?string $model = FeePayment::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('student.name'),
            ExportColumn::make('amount'),
            ExportColumn::make('payment_date'),
            ExportColumn::make('payment_method'),
            ExportColumn::make('status'),
            ExportColumn::make('reference_number'),
            ExportColumn::make('remarks'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your fee payment export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
