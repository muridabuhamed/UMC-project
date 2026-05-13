<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class AttendanceDayChart extends ChartWidget
{
    protected ?string $heading = 'Absences by Day of Week';

    protected function getData(): array
    {
        $absences = Attendance::where('status', 'absent')
            ->select(
                DB::raw('COUNT(*) as count'),
                DB::raw("DAYNAME(date) as day")
            )
            ->groupBy('day')
            ->orderBy(DB::raw("DAYOFWEEK(date)"))
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Absences',
                    'data' => $absences->pluck('count'),
                    'backgroundColor' => $absences->pluck('count')->map(function ($count) {
                        if ($count >= 10) return '#ef4444'; // Red
                        if ($count >= 5) return '#f59e0b';  // Yellow
                        return '#10b981';                   // Green
                    })->toArray(),
                ],
            ],
            'labels' => $absences->pluck('day'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
