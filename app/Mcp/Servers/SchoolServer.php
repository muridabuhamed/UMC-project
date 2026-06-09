<?php

namespace App\Mcp\Servers;

use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;
use App\Mcp\Tools\SearchStudentByName;
use App\Mcp\Tools\GetStudentGrades;
use App\Mcp\Tools\GetStudentAttendance;
use App\Mcp\Tools\GetDepartmentSummary;

#[Name('UMC School Manager')]
#[Version('1.0.0')]
#[Instructions(<<<'MARKDOWN'
This MCP server provides access to the UMC School Manager system.

Available tools:
- **search_student_by_name**: Search for students by name. Returns ID, name, student number, department.
- **get_student_grades**: Get all grades for a student by their ID.
- **get_student_attendance**: Get attendance records and summary for a student by their ID.
- **get_department_summary**: Get a department summary including student and teacher counts.

Use `search_student_by_name` first to find a student's ID, then use the other tools with that ID.
MARKDOWN)]
class SchoolServer extends Server
{
    protected array $tools = [
        SearchStudentByName::class,
        GetStudentGrades::class,
        GetStudentAttendance::class,
        GetDepartmentSummary::class,
    ];

    protected array $resources = [
        //
    ];

    protected array $prompts = [
        //
    ];
}
