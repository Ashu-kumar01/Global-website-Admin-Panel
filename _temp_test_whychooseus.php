<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::first();
if (!$user) {
    echo "NO USER FOUND\n";
    exit(1);
}
\Illuminate\Support\Facades\Auth::login($user);
app('view')->share('errors', new \Illuminate\Support\ViewErrorBag());

try {
    $controller = new \App\Http\Controllers\WhyChooseUsController();
    $response = $controller->index();
    $html = $response->render();
    echo "OK index rendered length: " . strlen($html) . "\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
