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
        Schema::table('cab_booking_packages', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('cab_name');
        });

        // Generate slugs for existing packages
        $packages = DB::table('cab_booking_packages')->get();
        foreach ($packages as $pkg) {
            $slug = Str::slug($pkg->cab_name);
            $originalSlug = $slug;
            $count = 1;
            while (DB::table('cab_booking_packages')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            DB::table('cab_booking_packages')->where('id', $pkg->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cab_booking_packages', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
