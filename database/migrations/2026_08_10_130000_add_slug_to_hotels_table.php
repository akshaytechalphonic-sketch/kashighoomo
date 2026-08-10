<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('location');
            }
        });

        // Generate slugs for any existing hotels
        $hotels = DB::table('hotels')->whereNull('slug')->orWhere('slug', '')->get();
        foreach ($hotels as $hotel) {
            $slug = Str::slug($hotel->name);
            $originalSlug = $slug;
            $count = 1;
            while (DB::table('hotels')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            DB::table('hotels')->where('id', $hotel->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (Schema::hasColumn('hotels', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
