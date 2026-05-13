<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Grade;
use Illuminate\Support\Facades\DB;
class GradeTrendChart extends ChartWidget
{
    public ?string $filter = 'month';

    protected ?string $heading = 'Average Grade Trend';

    protected int | string | array $columnSpan = 'full';

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $query = Grade::select(
            DB::raw('AVG(score) as average'),
            DB::raw("DATE_FORMAT(created_at, '%b %d') as date")
        );

        if ($activeFilter === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($activeFilter === 'week') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($activeFilter === 'month') {
            $query->where('created_at', '>=', now()->subMonth());
        }

        $grades = $query->groupBy('date')
            ->orderBy('created_at')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Average Grade %',
                    'data' => $grades->pluck('average'),
                    'borderColor' => '#4f46e5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.1)',
                    'fill' => 'start',
                    'tension' => 0.4, 
                ],
                [
                    'label' => 'School Target (75%)',
                    'data' => array_fill(0, count($grades), 75),
                    'borderColor' => '#ef4444',
                    'borderDash' => [5, 5], 
                    'pointStyle' => false,
                    'fill' => false,
                ],
            ],
            'labels' => $grades->pluck('date'),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
