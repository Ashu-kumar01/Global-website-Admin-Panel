<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$files = [
    'resources/views/admin/placement.blade.php',
    'resources/views/sections/placement.blade.php',
    'resources/views/admin/site-preview.blade.php',
    'resources/views/adminlayout/sidebar.blade.php',
];

foreach ($files as $f) {
    $path = __DIR__ . '/' . $f;
    try {
        $compiled = Illuminate\Support\Facades\Blade::compileString(file_get_contents($path));
        $tmp = tempnam(sys_get_temp_dir(), 'bld') . '.php';
        file_put_contents($tmp, $compiled);
        $out = [];
        $ret = 0;
        exec('php -l ' . escapeshellarg($tmp) . ' 2>&1', $out, $ret);
        echo $f . " => " . implode("\n", $out) . "\n";
        unlink($tmp);
    } catch (Throwable $e) {
        echo $f . " ERROR: " . $e->getMessage() . "\n";
    }
}

// catalog sanity
$catalog = include __DIR__ . '/config/home_sections.php';
echo isset($catalog['recruiters']) ? 'FAIL: recruiters key still present' : 'recruiters key removed OK';
echo PHP_EOL;
echo $catalog['placement']['model'] === \App\Models\PlacementSection::class ? 'placement catalog OK' : 'FAIL placement catalog';
