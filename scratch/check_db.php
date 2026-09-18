<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $results = DB::select("SELECT id, page_name, slug FROM pages");
    echo "Pages in database:\n";
    foreach ($results as $page) {
        echo "  - ID: {$page->id}, Name: {$page->page_name}, Slug: {$page->slug}\n";
    }
} catch (\Exception $e) {
    echo "Error querying pages: " . $e->getMessage() . "\n";
}
