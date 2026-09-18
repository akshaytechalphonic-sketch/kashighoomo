<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Package;
use App\Models\Page;
use App\Models\Banner;

echo "--- Banners ---\n";
foreach(Banner::all() as $b) {
    echo "ID: {$b->id} | Title: {$b->title} | Link: {$b->button_link}\n";
}

echo "--- Packages ---\n";
foreach(Package::all() as $p) {
    echo "ID: {$p->id} | Slug: {$p->slug} | Title: {$p->title}\n";
}

echo "--- Pages ---\n";
foreach(Page::all() as $pg) {
    echo "ID: {$pg->id} | Slug: {$pg->slug} | Title: {$pg->title}\n";
}
