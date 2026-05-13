<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Student Information')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('student_number')
                            ->label('ID Number')
                            ->copyable(),
                        TextEntry::make('department.name')
                            ->label('Department')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('year')
                            ->label('Year Level')
                            ->suffix(' Year'),
                    ]),

                \Filament\Schemas\Components\Section::make('Academic Performance')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('average_grade')
                            ->label('Average Score')
                            ->state(fn ($record) => number_format($record->grades()->avg('score') ?? 0, 1) . '%')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-academic-cap'),

                        TextEntry::make('attendance_rate')
                            ->label('Attendance Rate')
                            ->state(fn ($record) => 
                                $record->attendances()->count() > 0 
                                ? number_format(($record->attendances()->where('status', 'present')->count() / $record->attendances()->count()) * 100, 1) . '%'
                                : 'No data'
                            )
                            ->badge()
                            ->color('primary')
                            ->icon('heroicon-o-calendar-days'),

                        TextEntry::make('total_courses')
                            ->label('Enrolled Courses')
                            ->state(fn ($record) => $record->enrollments()->count())
                            ->badge()
                            ->color('warning')
                            ->icon('heroicon-o-book-open'),
                    ]),

                \Filament\Schemas\Components\Section::make('AI Counselor Summary')
                    ->description('Automatically generated insights based on performance and behavior.')
                    ->icon('heroicon-o-sparkles')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('summary')
                            ->label('')
                            ->placeholder('No summary generated yet. Click the sparkle button above to generate one!')
                            ->markdown()
                            ->prose()
                            ->columnSpanFull()
                            ->color('indigo'),
                    ]),

                \Filament\Schemas\Components\Section::make('Future Academic Roadmap')
                    ->description('AI-driven suggestions for electives and learning growth.')
                    ->icon('heroicon-o-map')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('recommendations')
                            ->label('')
                            ->placeholder('No roadmap generated yet. Click the "AI Academic Pathway" button above!')
                            ->markdown()
                            ->prose()
                            ->columnSpanFull()
                            ->color('info'),
                    ]),
            ]);
    }
}
