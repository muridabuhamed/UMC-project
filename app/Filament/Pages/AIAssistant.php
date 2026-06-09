<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\FunctionDeclaration;
use Gemini\Data\Schema;
use Gemini\Enums\DataType;
use Gemini\Data\Tool;
use App\Mcp\Tools\SearchStudentByName;
use App\Mcp\Tools\GetStudentGrades;
use App\Mcp\Tools\GetStudentAttendance;
use App\Mcp\Tools\GetDepartmentSummary;

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
            $tools = [
                new Tool(functionDeclarations: [
                    new FunctionDeclaration(
                        'search_student_by_name',
                        'Search for a student by their name. Returns basic student information like ID, name, student number, and department.',
                        new Schema(DataType::OBJECT, properties: [
                            'name' => new Schema(DataType::STRING, description: 'The name of the student to search for.')
                        ], required: ['name'])
                    ),
                    new FunctionDeclaration(
                        'get_student_grades',
                        'Get all grades for a specific student using their student ID.',
                        new Schema(DataType::OBJECT, properties: [
                            'student_id' => new Schema(DataType::INTEGER, description: 'The numeric ID of the student.')
                        ], required: ['student_id'])
                    ),
                    new FunctionDeclaration(
                        'get_student_attendance',
                        'Get the attendance records and summary for a specific student using their student ID.',
                        new Schema(DataType::OBJECT, properties: [
                            'student_id' => new Schema(DataType::INTEGER, description: 'The numeric ID of the student.')
                        ], required: ['student_id'])
                    ),
                    new FunctionDeclaration(
                        'get_department_summary',
                        'Get a summary of a department, including head of department, total students, and total teachers.',
                        new Schema(DataType::OBJECT, properties: [
                            'department_name' => new Schema(DataType::STRING, description: 'The name of the department (e.g., Computer Science).')
                        ], required: ['department_name'])
                    ),
                ])
            ];

            // Reconstruct chat history for Gemini (excluding the current message)
            $history = [];
            foreach (array_slice($this->messages, 0, -1) as $msg) {
                if ($msg['role'] === 'user') {
                    $history[] = \Gemini\Data\Content::parse($msg['content']);
                } else {
                    $history[] = \Gemini\Data\Content::parse($msg['content'], \Gemini\Enums\Role::MODEL);
                }
            }

            $chat = Gemini::generativeModel('gemini-flash-latest')
                ->withTool($tools[0])
                ->withSystemInstruction(\Gemini\Data\Content::parse($this->getSystemPrompt()))
                ->startChat(history: $history);

            $response = $chat->sendMessage($userMessage);

            // Handle potential function calls iteratively
            while (true) {
                $functionCall = null;
                if (!empty($response->candidates)) {
                    foreach ($response->candidates[0]->content->parts as $part) {
                        if ($part->functionCall !== null) {
                            $functionCall = $part->functionCall;
                            break;
                        }
                    }
                }

                if ($functionCall === null) {
                    break;
                }

                $functionName = $functionCall->name;
                $args = $functionCall->args;

                $toolResponse = $this->runMcpTool($functionName, $args);

                // Send the result of the tool back to Gemini to get the final answer
                $response = $chat->sendMessage(
                    new \Gemini\Data\Content(
                        parts: [
                            new \Gemini\Data\Part(
                                functionResponse: new \Gemini\Data\FunctionResponse(
                                    name: $functionName,
                                    response: ['result' => json_decode($toolResponse, true) ?? $toolResponse]
                                )
                            )
                        ],
                        role: \Gemini\Enums\Role::USER
                    )
                );
            }

            $aiResponse = $response->text();

            $this->messages[] = ['role' => 'assistant', 'content' => $aiResponse];
            $this->dispatch('messageAdded');
        } catch (\Exception $e) {
            $this->messages[] = ['role' => 'assistant', 'content' => 'Error: ' . $e->getMessage()];
            $this->dispatch('messageAdded');
        }
    }

    /**
     * Registry mapping Gemini function names to MCP Tool classes.
     */
    private const TOOL_REGISTRY = [
        'search_student_by_name' => SearchStudentByName::class,
        'get_student_grades' => GetStudentGrades::class,
        'get_student_attendance' => GetStudentAttendance::class,
        'get_department_summary' => GetDepartmentSummary::class,
    ];

    private function runMcpTool(string $functionName, array $args): string
    {
        if (!isset(self::TOOL_REGISTRY[$functionName])) {
            throw new \Exception("Unknown tool: {$functionName}");
        }

        $request = new \Laravel\Mcp\Request(arguments: $args);
        $tool = app(self::TOOL_REGISTRY[$functionName]);
        $response = $tool->handle($request);

        return (string) $response->content();
    }

    private function getSystemPrompt(): string
    {
        return "You are the UMC School AI Assistant. You help admins and teachers manage the school. 
        Be professional, helpful, and concise. You have access to tools to query the database.
        Use the tools when the user asks about specific students, grades, attendance, or departments.
        Do NOT assume information unless the tool provides it.";
    }
}
