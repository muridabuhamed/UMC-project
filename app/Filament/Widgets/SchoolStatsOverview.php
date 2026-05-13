<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalStudents = \App\Models\Student::count();
        $avgGrade = \App\Models\Grade::avg('score') ?? 0;
        $totalFees = \App\Models\FeePayment::sum('amount');
        
        $attendanceRate = \App\Models\Attendance::count() > 0 
            ? (\App\Models\Attendance::where('status', 'present')->count() / \App\Models\Attendance::count()) * 100 
            : 0;

        return [
            Stat::make('Total Students', $totalStudents)
                ->description('Active enrollments')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
            Stat::make('Average Grade', number_format($avgGrade, 1) . '%')
                ->description('Overall school performance')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color($avgGrade >= 75 ? 'success' : 'warning'),
            Stat::make('Total Fees Collected', '$' . number_format($totalFees, 2))
                ->description('Revenue this year')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Attendance Rate', number_format($attendanceRate, 1) . '%')
                ->description('Daily presence')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color($attendanceRate >= 90 ? 'success' : 'danger'),
        ];
    }
}
