<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$ribbons = App\Models\Ribbion::with('notices')->get();
foreach ($ribbons as $r) {
    echo "id={$r->id} bg={$r->backgroundColor} text={$r->textColor} pos={$r->ribbonPosition} anim={$r->ribbonAnimation} speed={$r->sliderSpeed} updated={$r->updated_at}\n";
    foreach ($r->notices as $n) {
        echo "  notice: {$n->name} | {$n->link}\n";
    }
}
