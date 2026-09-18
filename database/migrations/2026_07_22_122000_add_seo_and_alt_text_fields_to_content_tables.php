<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Pages table
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('pages', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('pages', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('pages', 'meta_tags')) {
                $table->longText('meta_tags')->nullable()->after('meta_keywords');
            }
        });

        // 2. Blogs table
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('is_published');
            }
            if (!Schema::hasColumn('blogs', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('blogs', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('blogs', 'meta_tags')) {
                $table->longText('meta_tags')->nullable()->after('meta_keywords');
            }
            if (!Schema::hasColumn('blogs', 'alt_text')) {
                $table->string('alt_text')->nullable()->after('featured_image');
            }
        });

        // 3. Packages table
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('featured');
            }
            if (!Schema::hasColumn('packages', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('packages', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('packages', 'meta_tags')) {
                $table->longText('meta_tags')->nullable()->after('meta_keywords');
            }
            if (!Schema::hasColumn('packages', 'alt_text')) {
                $table->text('alt_text')->nullable()->after('images');
            }
        });

        // 4. Destinations table
        Schema::table('destinations', function (Blueprint $table) {
            if (!Schema::hasColumn('destinations', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('status');
            }
            if (!Schema::hasColumn('destinations', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('destinations', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('destinations', 'meta_tags')) {
                $table->longText('meta_tags')->nullable()->after('meta_keywords');
            }
            if (!Schema::hasColumn('destinations', 'alt_text')) {
                $table->string('alt_text')->nullable()->after('image');
            }
        });

        // 5. Hotels table
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('map_embed_url');
            }
            if (!Schema::hasColumn('hotels', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('hotels', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('hotels', 'meta_tags')) {
                $table->longText('meta_tags')->nullable()->after('meta_keywords');
            }
            if (!Schema::hasColumn('hotels', 'alt_text')) {
                $table->text('alt_text')->nullable()->after('images');
            }
        });

        // 6. Rooms table
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('exclusions');
            }
            if (!Schema::hasColumn('rooms', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('rooms', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('rooms', 'meta_tags')) {
                $table->longText('meta_tags')->nullable()->after('meta_keywords');
            }
            if (!Schema::hasColumn('rooms', 'alt_text')) {
                $table->text('alt_text')->nullable()->after('images');
            }
        });

        // 7. Cab Booking Packages table
        Schema::table('cab_booking_packages', function (Blueprint $table) {
            if (!Schema::hasColumn('cab_booking_packages', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('status');
            }
            if (!Schema::hasColumn('cab_booking_packages', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('cab_booking_packages', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('cab_booking_packages', 'meta_tags')) {
                $table->longText('meta_tags')->nullable()->after('meta_keywords');
            }
            if (!Schema::hasColumn('cab_booking_packages', 'alt_text')) {
                $table->text('alt_text')->nullable()->after('images');
            }
        });

        // 8. Galleries table
        Schema::table('galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('galleries', 'alt_text')) {
                $table->string('alt_text')->nullable()->after('image');
            }
        });

        // 9. Banners table
        Schema::table('banners', function (Blueprint $table) {
            if (!Schema::hasColumn('banners', 'alt_text')) {
                $table->string('alt_text')->nullable()->after('image');
            }
        });

        // 10. Testimonials table
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'alt_text')) {
                $table->string('alt_text')->nullable()->after('image');
            }
        });

        // 11. Page Sections table
        Schema::table('page_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('page_sections', 'alt_text')) {
                $table->string('alt_text')->nullable()->after('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe drop columns if they exist
        Schema::table('pages', function (Blueprint $table) {
            // Note: only drop meta_tags if we want to preserve original columns
            if (Schema::hasColumn('pages', 'meta_tags')) {
                $table->dropColumn('meta_tags');
            }
        });

        Schema::table('blogs', function (Blueprint $table) {
            $cols = array_filter(['meta_title', 'meta_description', 'meta_keywords', 'meta_tags', 'alt_text'], function($col) {
                return Schema::hasColumn('blogs', $col);
            });
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });

        Schema::table('packages', function (Blueprint $table) {
            if (Schema::hasColumn('packages', 'meta_tags')) {
                $table->dropColumn('meta_tags');
            }
            if (Schema::hasColumn('packages', 'alt_text')) {
                $table->dropColumn('alt_text');
            }
        });

        Schema::table('destinations', function (Blueprint $table) {
            $cols = array_filter(['meta_title', 'meta_description', 'meta_keywords', 'meta_tags', 'alt_text'], function($col) {
                return Schema::hasColumn('destinations', $col);
            });
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });

        Schema::table('hotels', function (Blueprint $table) {
            $cols = array_filter(['meta_title', 'meta_description', 'meta_keywords', 'meta_tags', 'alt_text'], function($col) {
                return Schema::hasColumn('hotels', $col);
            });
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });

        Schema::table('rooms', function (Blueprint $table) {
            $cols = array_filter(['meta_title', 'meta_description', 'meta_keywords', 'meta_tags', 'alt_text'], function($col) {
                return Schema::hasColumn('rooms', $col);
            });
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });

        Schema::table('cab_booking_packages', function (Blueprint $table) {
            $cols = array_filter(['meta_title', 'meta_description', 'meta_keywords', 'meta_tags', 'alt_text'], function($col) {
                return Schema::hasColumn('cab_booking_packages', $col);
            });
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });

        Schema::table('galleries', function (Blueprint $table) {
            if (Schema::hasColumn('galleries', 'alt_text')) {
                $table->dropColumn('alt_text');
            }
        });

        Schema::table('banners', function (Blueprint $table) {
            if (Schema::hasColumn('banners', 'alt_text')) {
                $table->dropColumn('alt_text');
            }
        });

        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'alt_text')) {
                $table->dropColumn('alt_text');
            }
        });

        Schema::table('page_sections', function (Blueprint $table) {
            if (Schema::hasColumn('page_sections', 'alt_text')) {
                $table->dropColumn('alt_text');
            }
        });
    }
};
