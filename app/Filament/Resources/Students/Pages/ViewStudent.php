<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStudent extends ViewRecord
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
            EditAction::make(),
        ];
    }
}
