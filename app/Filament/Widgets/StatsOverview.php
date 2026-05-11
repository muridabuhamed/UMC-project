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
                ->icon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Total Courses', \App\Models\Course::count())
                ->description('Courses offered')
                ->icon('heroicon-o-book-open')
                ->color('info'),

            Stat::make('Total Enrollments', \App\Models\Enrollment::count())
                ->description('Active enrollments')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('warning'),

            Stat::make('Average Score', number_format(\App\Models\Grade::avg('score') ?? 0, 1) . '%')
                ->description('Overall performance')
                ->icon('heroicon-o-academic-cap')
                ->color('primary'),
        ];
    }
}
