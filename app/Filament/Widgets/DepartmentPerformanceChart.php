<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Department;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class DepartmentPerformanceChart extends ChartWidget
{
    protected ?string $heading = 'Department Performance (Average Grade)';

    protected function getData(): array
    {
        $performance = Department::select('departments.name')
            ->join('students', 'departments.id', '=', 'students.department_id')
            ->join('enrollments', 'students.id', '=', 'enrollments.student_id')
            ->join('grades', 'enrollments.id', '=', 'grades.enrollment_id')
            ->select(
                'departments.name',
                DB::raw('AVG(grades.score) as average')
            )
            ->groupBy('departments.name')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Average Grade %',
                    'data' => $performance->pluck('average'),
                    'backgroundColor' => ['#4f46e5', '#10b981', '#f59e0b', '#ef4444'],
                ],
            ],
            'labels' => $performance->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
