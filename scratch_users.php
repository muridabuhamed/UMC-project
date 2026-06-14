<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach (App\Models\User::with('roles')->get() as $user) {
    echo "Email: " . $user->email . " | Name: " . $user->name . " | Roles: " . $user->roles->pluck('name')->implode(', ') . PHP_EOL;
}
