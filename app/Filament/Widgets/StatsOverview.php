<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Registered students')
                ->color('success'),

            Stat::make('Total Departments', Department::count())
                ->description('Active departments')
                ->color('info'),

            Stat::make('Latest Year', Student::max('year') ?? 1)
                ->description('Highest study year enrolled')
                ->color('warning'),
        ];
    }
}
