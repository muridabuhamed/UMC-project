<?php

namespace App\Filament\Resources\CommunicationLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CommunicationLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Communication Details')
                    ->description('Log details of the conversation with parents.')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('student_id')
                                ->relationship('student', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->default(fn() => auth()->id())
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                        ]),
                        Grid::make(3)->schema([
                            DateTimePicker::make('contact_date')
                                ->default(now())
                                ->required(),
                            Select::make('contact_type')
                                ->options([
                                    'Call' => 'Phone Call',
                                    'Email' => 'Email',
                                    'Meeting' => 'In-Person Meeting',
                                    'Message' => 'WhatsApp/SMS',
                                ])
                                ->required(),
                            Select::make('mood')
                                ->options([
                                    'positive' => '🟢 Positive',
                                    'neutral' => '🟡 Neutral',
                                    'negative' => '🔴 Negative',
                                ])
                                ->required()
                                ->default('neutral'),
                        ]),
                        TextInput::make('subject')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('notes')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
