<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('generate_ai_report')
                ->label('Generate AI Report')
                ->icon('heroicon-o-sparkles')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {
                    $student = $this->record;
                    
                    // Gather context
                    $grades = $student->grades()->with('enrollment.course')->get();
                    $attendanceCount = $student->attendances()->count();
                    $absences = $student->attendances()->where('status', 'absent')->count();
                    $logs = $student->communicationLogs()->latest()->take(5)->get();
                    
                    $context = "Student Name: {$student->name}\n";
                    $context .= "Department: {$student->department->name}\n";
                    $context .= "Grades: " . $grades->map(fn($g) => "{$g->enrollment->course->name}: {$g->score}%")->join(', ') . "\n";
                    $context .= "Attendance: {$attendanceCount} total sessions, {$absences} absences.\n";
                    $context .= "Recent Parent Communication: " . $logs->map(fn($l) => "[{$l->contact_type}] {$l->subject} (Mood: {$l->mood})")->join('; ') . "\n";
                    
                    $prompt = "You are an expert school counselor. Based on the following student data, write a professional, encouraging, and objective 3-sentence summary for their official school report card. Focus on their academic performance, attendance, and parent relationship. Be concise.\n\nDATA:\n{$context}";

                    try {
                        $result = \Gemini\Laravel\Facades\Gemini::generativeModel('gemini-flash-latest')->generateContent($prompt);
                        $aiSummary = $result->text();
                        
                        $student->update(['summary' => $aiSummary]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('AI Report Generated')
                            ->success()
                            ->send();
                            
                        $this->refreshFormData(['summary']);
                    } catch (\Exception $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('AI Generation Failed')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            \Filament\Actions\Action::make('generate_academic_roadmap')
                ->label('AI Academic Pathway')
                ->icon('heroicon-o-academic-cap')
                ->color('info')
                ->requiresConfirmation()
                ->action(function () {
                    $student = $this->record;
                    
                    // Gather context
                    $grades = $student->grades()->with('enrollment.course')->get();
                    $allCourses = \App\Models\Course::with('department')->get();
                    
                    $context = "STUDENT DATA:\n";
                    $context .= "Name: {$student->name}\n";
                    $context .= "Current Department: {$student->department->name}\n";
                    $context .= "Academic Record: " . $grades->map(fn($g) => "{$g->enrollment->course->name}: {$g->score}%")->join(', ') . "\n\n";
                    
                    $context .= "AVAILABLE COURSES IN SCHOOL:\n";
                    $context .= $allCourses->map(fn($c) => "- {$c->name} ({$c->department->name})")->join("\n") . "\n";
                    
                    $prompt = "You are a Senior Academic Strategist. Analyze the student's grades and learning style.
                    Provide a CONCISE summary using exactly 3 bullet points:
                    - **Learning Style:** (1 sentence)
                    - **Recommended Next Courses:** (Name 2 electives)
                    - **Support Strategy:** (1 specific suggestion)
                    Use bold headings and no long paragraphs.";

                    try {
                        $result = \Gemini\Laravel\Facades\Gemini::generativeModel('gemini-flash-latest')->generateContent($prompt . "\n\nCONTEXT:\n" . $context);
                        $recommendations = $result->text();
                        
                        $student->update(['recommendations' => $recommendations]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Academic Roadmap Generated')
                            ->success()
                            ->send();
                            
                        $this->refreshFormData(['recommendations']);
                    } catch (\Exception $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Pathway Generation Failed')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
