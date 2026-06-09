<?php

use App\Mcp\Servers\SchoolServer;
use Laravel\Mcp\Facades\Mcp;

/*
|--------------------------------------------------------------------------
| MCP Routes
|--------------------------------------------------------------------------
|
| Here you may register MCP servers for your application. These servers
| expose tools, resources, and prompts to MCP-compatible AI clients
| like Claude Desktop, Cursor, VS Code, and others.
|
*/

// HTTP transport: POST /mcp/school
// Accessible by any MCP client over HTTP (e.g. browser-based agents)
Mcp::web('/mcp/school', SchoolServer::class);

// Stdio transport: php artisan mcp:start school
// Accessible by desktop MCP clients (e.g. Claude Desktop, Cursor)
Mcp::local('school', SchoolServer::class);
