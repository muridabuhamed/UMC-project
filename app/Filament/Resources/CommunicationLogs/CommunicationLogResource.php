<?php

namespace App\Filament\Resources\CommunicationLogs;

use App\Filament\Resources\CommunicationLogs\Pages\CreateCommunicationLog;
use App\Filament\Resources\CommunicationLogs\Pages\EditCommunicationLog;
use App\Filament\Resources\CommunicationLogs\Pages\ListCommunicationLogs;
use App\Filament\Resources\CommunicationLogs\Pages\ViewCommunicationLog;
use App\Filament\Resources\CommunicationLogs\Schemas\CommunicationLogForm;
use App\Filament\Resources\CommunicationLogs\Schemas\CommunicationLogInfolist;
use App\Filament\Resources\CommunicationLogs\Tables\CommunicationLogsTable;
use App\Models\CommunicationLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CommunicationLogResource extends Resource
{
    protected static ?string $model = CommunicationLog::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static ?string $recordTitleAttribute = 'subject';

    public static function form(Schema $schema): Schema
    {
        return CommunicationLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommunicationLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunicationLogsTable::configure($table);
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
            'index' => ListCommunicationLogs::route('/'),
            'create' => CreateCommunicationLog::route('/create'),
            'view' => ViewCommunicationLog::route('/{record}'),
            'edit' => EditCommunicationLog::route('/{record}/edit'),
        ];
    }
}
