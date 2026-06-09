<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use App\Models\Department;

#[Description('Get a summary of a department, including head of department, total students, and total teachers.')]
class GetDepartmentSummary extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $departmentName = $request->get('department_name');
        
        $department = Department::withCount(['students', 'teachers'])
            ->where('name', 'like', "%{$departmentName}%")
            ->first();
            
        if (!$department) {
            return Response::text("Department not found matching: {$departmentName}");
        }

        $result = [
            'name' => $department->name,
            'head_of_department' => $department->head_of_department ?? 'N/A',
            'description' => $department->description ?? 'N/A',
            'total_students' => $department->students_count,
            'total_teachers' => $department->teachers_count,
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
            'department_name' => $schema->string('The name of the department (e.g., Computer Science).')->required(),
        ];
    }
}
