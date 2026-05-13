<?php

namespace App\Filament\Resources\Students\RelationManagers;

use App\Filament\Resources\CommunicationLogs\CommunicationLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class CommunicationLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'communicationLogs';

    protected static ?string $relatedResource = CommunicationLogResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
