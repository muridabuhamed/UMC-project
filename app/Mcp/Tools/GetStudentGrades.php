<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use App\Models\Student;

#[Description('Get all grades for a specific student using their student ID.')]
class GetStudentGrades extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $studentId = $request->get('student_id');
        
        $student = Student::with(['grades.enrollment.course'])->find($studentId);
        
        if (!$student) {
            return Response::text("Student with ID {$studentId} not found.");
        }

        $grades = $student->grades->map(function ($grade) {
            // Depending on the exact relationship, course might be on enrollment or directly on grade.
            // Using enrollment->course as standard for HasManyThrough via Enrollment
            $courseName = $grade->enrollment?->course?->name ?? 'Unknown Course';
            return [
                'course' => $courseName,
                'score' => $grade->score,
                'date' => $grade->date?->format('Y-m-d') ?? 'N/A',
                'comments' => $grade->comments,
            ];
        });

        $avgGrade = $student->grades->avg('score') ?? 0;

        $result = [
            'student_name' => $student->name,
            'average_grade' => number_format($avgGrade, 1) . '%',
            'grades' => $grades,
        ];

        return Response::text(json_encode($result, JSON_PRETTY_PRINT));
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'student_id' => $schema->integer('The numeric ID of the student.')->required(),
        ];
    }
}
