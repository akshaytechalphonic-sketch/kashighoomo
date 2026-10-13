<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Package;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $path = database_path('data/packages_content.json');
        if (!file_exists($path)) {
            return;
        }

        $packages = json_decode(file_get_contents($path), true) ?? [];

        foreach ($packages as $slug => $data) {
            $pkg = Package::where('slug', $slug)->first();
            if ($pkg) {
                $pkg->update([
                    'title' => $data['title'] ?? $pkg->title,
                    'description' => $data['description'] ?? $pkg->description,
                    'inclusions' => $data['inclusions'] ?? [],
                    'exclusions' => $data['exclusions'] ?? [],
                    'itinerary' => $data['itinerary'] ?? [],
                    'meta_title' => $data['meta_title'] ?? $pkg->meta_title,
                    'meta_description' => $data['meta_description'] ?? $pkg->meta_description,
                    'duration' => $data['duration'] ?? $pkg->duration,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
