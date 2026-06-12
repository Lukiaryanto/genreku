<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pimpinan;

$p = Pimpinan::create(['nama' => 'Test Pimpinan', 'email' => 'pimpinan@example.com', 'jabatan' => 'Ketua']);

echo Pimpinan::count() . PHP_EOL;
