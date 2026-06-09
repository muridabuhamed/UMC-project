<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use App\Models\Student;

#[Description('Get the attendance records and summary for a specific student using their student ID.')]
class GetStudentAttendance extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $studentId = $request->get('student_id');
        
        $student = Student::with(['attendances.enrollment.course'])->find($studentId);
        
        if (!$student) {
            return Response::text("Student with ID {$studentId} not found.");
        }

        $attendanceCount = $student->attendances->count();
        $presentCount = $student->attendances->where('status', 'present')->count();
        $absentCount = $student->attendances->where('status', 'absent')->count();
        $lateCount = $student->attendances->where('status', 'late')->count();
        $attendanceRate = $attendanceCount > 0 ? number_format(($presentCount / $attendanceCount) * 100, 1) : 100;

        $recentRecords = $student->attendances->sortByDesc('date')->take(10)->map(function ($attendance) {
            $courseName = $attendance->enrollment?->course?->name ?? 'Unknown Course';
            return [
                'course' => $courseName,
                'status' => $attendance->status,
                'date' => $attendance->date ?? 'N/A',
            ];
        });

        $result = [
            'student_name' => $student->name,
            'attendance_rate' => $attendanceRate . '%',
            'summary' => [
                'total_classes' => $attendanceCount,
                'present' => $presentCount,
                'absent' => $absentCount,
                'late' => $lateCount,
            ],
            'recent_records' => $recentRecords->values()->all(),
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
