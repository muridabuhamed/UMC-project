<?php

namespace App\Filament\Resources\Students\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GradesRelationManager extends RelationManager
{
    protected static string $relationship = 'grades';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('enrollment_id')
                    ->relationship('enrollment', 'id')
                    ->required(),
                TextInput::make('score')
                    ->required()
                    ->numeric(),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('enrollment.id')
                    ->label('Enrollment'),
                TextEntry::make('score')
                    ->numeric(),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('score')
            ->columns([
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
                TextColumn::make('remarks')
                    ->limit(30)
                    ->placeholder('No remarks'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
