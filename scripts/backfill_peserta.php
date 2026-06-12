<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Peserta;

$users = User::where('role', 'peserta')->get();
$created = 0;
foreach ($users as $u) {
    if (! Peserta::where('user_id', $u->id)->exists()) {
        Peserta::create([
            'user_id' => $u->id,
            'nama' => $u->name,
            'tanggal_lahir' => null,
            'alamat' => null,
            'asal_instansi' => null,
        ]);
        echo "Created Peserta for user id={$u->id} email={$u->email}\n";
        $created++;
    }
}

if ($created === 0) {
    echo "No missing Peserta records found.\n";
} else {
    echo "Backfilled $created Peserta records.\n";
}
