<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Peserta;

$users = User::where('role', 'peserta')->orderBy('created_at', 'desc')->get();
foreach ($users as $u) {
    echo $u->id . ' ' . $u->email . ' has_peserta:' . (Peserta::where('user_id', $u->id)->exists() ? '1' : '0') . PHP_EOL;
}
