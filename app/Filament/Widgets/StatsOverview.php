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
        $user = auth()->user();
        $isTeacher = $user->isTeacher();
        $teacherId = $user->teacher?->id;

        $studentCount = $isTeacher 
            ? Student::whereHas('enrollments', fn($q) => $q->whereHas('course', fn($cq) => $cq->where('teacher_id', $teacherId)))->count()
            : Student::count();

        $courseCount = $isTeacher
            ? \App\Models\Course::where('teacher_id', $teacherId)->count()
            : \App\Models\Course::count();

        $enrollmentCount = $isTeacher
            ? \App\Models\Enrollment::whereHas('course', fn($q) => $q->where('teacher_id', $teacherId))->count()
            : \App\Models\Enrollment::count();

        $stats = [
            Stat::make('Total Students', $studentCount)
                ->description($isTeacher ? 'Your students' : 'Registered students')
                ->icon('heroicon-o-user-group')
                ->color('success'),

            !$isTeacher ? Stat::make('Total Teachers', \App\Models\Teacher::count())
                ->description('Active faculty')
                ->icon('heroicon-o-user-circle')
                ->color('info') : null,

            Stat::make('Total Courses', $courseCount)
                ->description($isTeacher ? 'Your courses' : 'Courses offered')
                ->icon('heroicon-o-book-open')
                ->color('info'),

            Stat::make('Total Enrollments', $enrollmentCount)
                ->description($isTeacher ? 'Students in your classes' : 'Active enrollments')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('warning'),

            Stat::make('Average Score', number_format(\App\Models\Grade::when($isTeacher, fn($q) => $q->whereHas('enrollment.course', fn($cq) => $cq->where('teacher_id', $teacherId)))->avg('score') ?? 0, 1) . '%')
                ->description('Overall performance')
                ->icon('heroicon-o-academic-cap')
                ->color('primary'),

            $user->hasRole('super_admin') ? Stat::make('Total Revenue', '$' . number_format(\App\Models\FeePayment::where('status', 'completed')->sum('amount'), 2))
                ->description('Completed payments')
                ->icon('heroicon-o-banknotes')
                ->color('success') : null,
        ];

        return array_filter($stats);
    }
}
