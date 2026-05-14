<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\FeePayment;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\Widget;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Cache;

class ExecutiveHealthReport extends Widget
{
    protected string $view = 'filament.widgets.executive-health-report';

    protected int | string | array $columnSpan = 2;

    public ?string $report = null;
    public bool $isLoading = false;

    public function mount(): void
    {
        $this->report = Cache::get('executive_school_report');
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }

    public function generateReport()
    {
        $this->isLoading = true;
        
        try {
            $data = $this->gatherSchoolData();
            $prompt = $this->buildPrompt($data);
            
            $result = Gemini::generativeModel('gemini-flash-latest')->generateContent($prompt);
            $this->report = $result->text();
            
            Cache::put('executive_school_report', $this->report, now()->addHours(12));
            
            $this->dispatch('report-generated');
        } catch (\Exception $e) {
            $this->report = "Error generating report: " . $e->getMessage();
        }

        $this->isLoading = false;
    }

    protected function gatherSchoolData(): array
    {
        return [
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'total_courses' => Course::count(),
            'total_enrollments' => Enrollment::count(),
            'department_performance' => Department::with(['students.grades'])
                ->get()
                ->map(fn($d) => [
                    'name' => $d->name,
                    'avg_grade' => number_format($d->students->flatMap->grades->avg('score') ?? 0, 1),
                    'student_count' => $d->students->count(),
                ])->toArray(),
            'attendance_rate' => number_format(
                (Attendance::where('status', 'present')->count() / max(Attendance::count(), 1)) * 100, 
                1
            ),
            'financials' => [
                'total_revenue' => FeePayment::where('status', 'completed')->sum('amount'),
                'pending_revenue' => FeePayment::where('status', 'pending')->sum('amount'),
                'payment_methods' => FeePayment::groupBy('payment_method')->selectRaw('payment_method, count(*) as count')->get()->toArray(),
            ],
            'recent_growth' => [
                'new_students_30d' => Student::where('created_at', '>=', now()->subDays(30))->count(),
                'new_enrollments_30d' => Enrollment::where('created_at', '>=', now()->subDays(30))->count(),
            ]
        ];
    }

    protected function buildPrompt(array $data): string
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        
        return "You are a Senior Educational Consultant and Business Analyst. 
        Analyze the following school data and provide a professional EXECUTIVE HEALTH REPORT for the School Admin.
        
        FORMAT YOUR RESPONSE WITH THESE HEADINGS:
        1. 💎 Executive Summary (A high-level overview of the school's current state)
        2. 🎓 Academic Performance (Insights on departments and student success)
        3. 📊 Operational Vitality (Attendance and enrollment trends)
        4. 💰 Financial Health (Revenue and payment status)
        5. 🚀 Strategic Recommendations (3-4 actionable steps the admin should take)
        
        USE PREMIUM, PROFESSIONAL LANGUAGE. Use Markdown for formatting. Be concise but insightful.
        
        DATA:
        {$jsonData}";
    }
}
