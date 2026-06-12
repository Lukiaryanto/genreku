<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Load first user with peserta relation
$user = \App\Models\User::with('peserta')->first();

if ($user && $user->peserta) {
    echo json_encode($user->peserta->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    echo "null";
}
