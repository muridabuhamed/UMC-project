<?php

namespace App\Livewire;

use Livewire\Component;
use Gemini\Laravel\Facades\Gemini;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\FeePayment;
use App\Models\Grade;
use App\Models\Attendance;

class AICommandCenter extends Component
{
    public string $query = '';
    public ?string $response = null;
    public bool $isSearching = false;
    public bool $isOpen = false;

    protected $listeners = ['openAICommandCenter' => 'open'];

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->query = '';
        $this->response = null;
    }

    public function ask()
    {
        if (empty($this->query)) return;

        $this->isSearching = true;
        
        try {
            $context = $this->getGlobalContext();
            $prompt = "You are the UMC School Command AI. You help the School Admin manage the institution. 
            Answer the following user question based on the school data provided below.
            Be extremely precise, professional, and helpful. Use Markdown for tables or lists if needed.
            
            USER QUESTION: {$this->query}
            
            SCHOOL CONTEXT:
            {$context}";

            $result = Gemini::generativeModel('gemini-flash-latest')->generateContent($prompt);
            $this->response = $result->text();
        } catch (\Exception $e) {
            $this->response = "Error: " . $e->getMessage();
        }

        $this->isSearching = false;
    }

    private function getGlobalContext(): string
    {
        $students = Student::with(['department', 'grades'])->get();
        $teachers = Teacher::with('courses')->get();
        $courses = Course::with(['department', 'teacher'])->get();
        $revenue = FeePayment::where('status', 'completed')->sum('amount');
        
        $context = "DATA SUMMARY:\n";
        $context .= "- Total Students: " . $students->count() . "\n";
        $context .= "- Total Teachers: " . $teachers->count() . "\n";
        $context .= "- Total Courses: " . $courses->count() . "\n";
        $context .= "- Total Revenue: $" . number_format($revenue, 2) . "\n\n";
        
        $context .= "TEACHERS:\n";
        foreach ($teachers as $t) {
            $context .= "- {$t->name} (Email: {$t->email}, Courses: " . $t->courses->pluck('name')->implode(', ') . ")\n";
        }
        
        $context .= "\nSTUDENT PERFORMANCE TOP 5:\n";
        $topStudents = $students->sortByDesc(fn($s) => $s->grades->avg('score'))->take(5);
        foreach ($topStudents as $s) {
            $context .= "- {$s->name} ({$s->department?->name}): " . number_format($s->grades->avg('score') ?? 0, 1) . "%\n";
        }
        
        return $context;
    }

    public function render()
    {
        return view('livewire.ai-command-center');
    }
}
