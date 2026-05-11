<?php

namespace App\Filament\Resources\Students\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttendancesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendances';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('enrollment_id')
                    ->relationship('enrollment', 'id')
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                Select::make('status')
                    ->options(['present' => 'Present', 'absent' => 'Absent', 'late' => 'Late', 'excused' => 'Excused'])
                    ->default('present')
                    ->required(),
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
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('status')
                    ->badge(),
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
            ->recordTitleAttribute('date')
            ->columns([
                TextColumn::make('enrollment.course.name')
                    ->label('Course')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'present' => 'success',
                        'absent' => 'danger',
                        'late' => 'warning',
                        'excused' => 'info',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'present' => 'heroicon-o-check-circle',
                        'absent' => 'heroicon-o-x-circle',
                        'late' => 'heroicon-o-clock',
                        'excused' => 'heroicon-o-envelope',
                    }),
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
