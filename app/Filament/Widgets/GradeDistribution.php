<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class GradeDistribution extends ChartWidget
{
    protected static ?int $sort = 3;

    public function getColumnSpan(): int | string | array
    {
        return 1;
    }

    protected function getData(): array
    {
        $grades = \App\Models\Grade::all();

        $data = [
            'A (90-100)' => $grades->whereBetween('score', [90, 100])->count(),
            'B (80-89)' => $grades->whereBetween('score', [80, 89.99])->count(),
            'C (70-79)' => $grades->whereBetween('score', [70, 79.99])->count(),
            'D (60-69)' => $grades->whereBetween('score', [60, 69.99])->count(),
            'F (Below 60)' => $grades->where('score', '<', 60)->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Number of Students',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#4f46e5', // Indigo
                        '#6366f1',
                        '#818cf8',
                        '#a5b4fc',
                        '#c7d2fe',
                    ],
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
