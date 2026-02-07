<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$output = "\n--- START SETTINGS ---\n";
$settings = \App\Models\Setting::where('key', 'like', 'mail_%')->get();
foreach ($settings as $setting) {
    $output .= "SETTING: " . $setting->key . " = [" . $setting->value . "]\n";
}
$output .= "--- END SETTINGS ---\n";
file_put_contents(__DIR__.'/debug_output.txt', $output);
echo "Written to debug_output.txt\n";

