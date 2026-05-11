<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class AttendanceChart extends ChartWidget
{
    protected static ?int $sort = 4;

    public function getColumnSpan(): int | string | array
    {
        return 1;
    }

    protected function getData(): array
    {
        $attendance = \App\Models\Attendance::all();

        $data = [
            'Present' => $attendance->where('status', 'present')->count(),
            'Absent' => $attendance->where('status', 'absent')->count(),
            'Late' => $attendance->where('status', 'late')->count(),
            'Excused' => $attendance->where('status', 'excused')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Attendance Status',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#22c55e', // Success Green
                        '#ef4444', // Danger Red
                        '#eab308', // Warning Yellow
                        '#3b82f6', // Info Blue
                    ],
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
