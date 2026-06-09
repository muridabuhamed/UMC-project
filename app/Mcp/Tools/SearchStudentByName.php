<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use App\Models\Student;

#[Description('Search for a student by their name. Returns basic student information like ID, name, student number, and department.')]
class SearchStudentByName extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $name = $request->get('name');
        
        $students = Student::with('department')
            ->where('name', 'like', "%{$name}%")
            ->limit(5)
            ->get();
            
        if ($students->isEmpty()) {
            return Response::text("No students found matching the name: {$name}");
        }

        $result = $students->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'student_number' => $student->student_number,
                'department' => $student->department?->name ?? 'N/A',
                'year' => $student->year,
            ];
        });

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
            'name' => $schema->string('The name of the student to search for.')->required(),
        ];
    }
}
