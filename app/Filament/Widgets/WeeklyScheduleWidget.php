<?php

namespace App\Filament\Widgets;

use App\Models\Schedule;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class WeeklyScheduleWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'teacher']);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Schedule::query()
                    ->where('day_of_week', now()->format('l'))
                    ->when(auth()->user()->isTeacher(), fn($q) => $q->where('teacher_id', auth()->user()->teacher?->id))
                    ->orderBy('start_time')
            )
            ->columns([
                TextColumn::make('start_time')
                    ->time('H:i')
                    ->label('Time'),
                TextColumn::make('course.name')
                    ->label('Course'),
                TextColumn::make('teacher.name')
                    ->label('Teacher'),
                TextColumn::make('room_number')
                    ->label('Room')
                    ->badge(),
            ])
            ->paginated(false);
    }
}
