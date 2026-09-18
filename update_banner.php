<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Banner;

$banner = Banner::where('title', 'LIKE', '%Dev Diwali%')->first();
if ($banner) {
    $banner->button_link = 'https://kashighoomo.in/book-dev-diwali-boat-rides';
    $banner->save();
    echo "Updated Banner ID {$banner->id} button_link to {$banner->button_link}\n";
} else {
    echo "Banner not found\n";
}
