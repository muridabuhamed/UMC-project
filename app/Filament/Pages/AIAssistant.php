<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Gemini\Laravel\Facades\Gemini;
use App\Models\Student;

class AIAssistant extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';
    protected static \UnitEnum|string|null $navigationGroup = 'AI Tools';
    protected static ?string $title = 'AI School Assistant';

    protected string $view = 'filament.pages.a-i-assistant';

    public array $messages = [];
    public string $question = '';

    public function ask()
    {
        if (empty($this->question)) return;

        $userMessage = $this->question;
        $this->messages[] = ['role' => 'user', 'content' => $userMessage];
        $this->question = '';

        try {
            $prompt = $this->getSystemPrompt() . "\n\nUser Question: " . $userMessage;
            
            $result = Gemini::generativeModel('gemini-flash-latest')->generateContent($prompt);
            $aiResponse = $result->text();

            $this->messages[] = ['role' => 'assistant', 'content' => $aiResponse];
            $this->dispatch('messageAdded');
        } catch (\Exception $e) {
            $this->messages[] = ['role' => 'assistant', 'content' => 'Error: ' . $e->getMessage()];
            $this->dispatch('messageAdded');
        }
    }

    private function getSystemPrompt(): string
    {
        $students = Student::with(['enrollments.course', 'grades', 'attendances', 'department'])->get();
        
        $context = "You are the UMC School AI Assistant. You help admins and teachers manage the school. 
        Be professional, helpful, and concise. You can write emails, analyze data, and give advice.
        
        Here is the current school data:
        ";
        
        foreach ($students as $student) {
            $avgGrade = number_format($student->grades->avg('score') ?? 0, 1);
            $attendanceCount = $student->attendances->count();
            $presentCount = $student->attendances->where('status', 'present')->count();
            $attendanceRate = $attendanceCount > 0 ? number_format(($presentCount / $attendanceCount) * 100, 1) : 100;
                
            $context .= "- Student: {$student->name} (ID: {$student->id_number})\n";
            $context .= "  Department: " . ($student->department?->name ?? 'N/A') . "\n";
            $context .= "  Average Grade: {$avgGrade}%\n";
            $context .= "  Attendance Rate: {$attendanceRate}%\n";
            $context .= "  Courses: " . $student->enrollments->pluck('course.name')->implode(', ') . "\n";
        }
        
        return $context;
    }
}
