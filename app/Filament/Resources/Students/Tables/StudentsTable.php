<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('student_number')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('year')
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('department')
                    ->relationship('department', 'name'),
            ])
            ->headerActions([
                \Filament\Actions\ExportAction::make()
                    ->exporter(\App\Filament\Exports\StudentExporter::class),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('log_contact')
                    ->label('Log Contact')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->form([
                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            \Filament\Forms\Components\DateTimePicker::make('contact_date')
                                ->default(now())
                                ->required(),
                            \Filament\Forms\Components\Select::make('contact_type')
                                ->options([
                                    'Call' => 'Phone Call',
                                    'Email' => 'Email',
                                    'Meeting' => 'In-Person Meeting',
                                    'Message' => 'WhatsApp/SMS',
                                ])
                                ->required(),
                        ]),
                        \Filament\Forms\Components\TextInput::make('subject')
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('notes')
                            ->rows(3),
                        \Filament\Forms\Components\Select::make('mood')
                            ->options([
                                'positive' => '🟢 Positive',
                                'neutral' => '🟡 Neutral',
                                'negative' => '🔴 Negative',
                            ])
                            ->default('neutral')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->communicationLogs()->create([
                            ...$data,
                            'user_id' => auth()->id(),
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Communication Logged')
                            ->success()
                            ->send();
                    }),
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
