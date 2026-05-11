<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class TopStudents extends TableWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Student::query()
                    ->withAvg('grades', 'score')
                    ->orderByDesc('grades_avg_score')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Student Name')
                    ->icon('heroicon-o-user'),
                
                TextColumn::make('student_number')
                    ->label('ID Number'),

                TextColumn::make('department.name')
                    ->label('Department')
                    ->badge()
                    ->color('info'),

                TextColumn::make('grades_avg_score')
                    ->label('Average Grade')
                    ->numeric(1)
                    ->suffix('%')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),
            ])
            ->paginated(false);
    }
}
