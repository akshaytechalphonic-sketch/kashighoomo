<?php

namespace App\Services;

use App\Models\Package;

class PackageContentService
{
    protected static ?array $cachedContent = null;

    public static function all(): array
    {
        if (self::$cachedContent === null) {
            $path = database_path('data/packages_content.json');
            if (file_exists($path)) {
                $json = file_get_contents($path);
                self::$cachedContent = json_decode($json, true) ?? [];
            } else {
                self::$cachedContent = [];
            }
        }
        return self::$cachedContent;
    }

    public static function getContent(string $slug): ?array
    {
        $all = self::all();
        if (isset($all[$slug])) {
            return $all[$slug];
        }

        $aliases = [
            'ayodhya' => 'book-kashi-prayagraj-ayodhya-tour-package-3-nights-4-days',
            'ayodhya-2-days-1-night' => 'book-kashi-prayagraj-ayodhya-tour-package-3-nights-4-days',
            'sunrise-ganga-boat' => 'sunrise-ganga-boat-1',
            'sunrise-ganga-boat-1' => 'sunrise-ganga-boat',
            'dashashwamedh-ghat-ganga' => 'dashashwamedh-ghat-ganga-1',
            'dashashwamedh-ghat-ganga-1' => 'dashashwamedh-ghat-ganga',
            'varanasi-famous-ghats' => 'varanasi-famous-ghats-1',
            'varanasi-famous-ghats-1' => 'varanasi-famous-ghats',
            'dev-deepawali-boat-booking-online' => 'dev-diwali-boat-ride-experience',
            'dev-diwali-boat-ride-experience' => 'dev-deepawali-boat-booking-online',
            'ramnagar-fort-tour' => 'royal-ramnagar-fort-heritage-tour',
            'ramnagar' => 'royal-ramnagar-fort-heritage-tour',
            'ramnagar-fort' => 'royal-ramnagar-fort-heritage-tour',
            'varanasi-ayodhya-prayagraj' => 'varanasi-ayodhya-prayagraj-package',
            'varanasi-ayodhya-prayagraj-tour' => 'varanasi-ayodhya-prayagraj-package',
            'varanasi-ayodhya-prayagraj-tour-package' => 'varanasi-ayodhya-prayagraj-package',
            'varanasi-boat-ride-cruise' => 'varanasi-boat-ride-and-cruise',
            'varanasi-boat-ride' => 'varanasi-boat-ride-and-cruise',
            'varanasi-family-tour-package' => 'varanasi-tour-package-for-family',
            'varanasi-tour-package-family' => 'varanasi-tour-package-for-family',
            'ayodhya-tour' => 'ayodhya-tour-package',
            'ayodhya-package' => 'ayodhya-tour-package',
            'ram-mandir-tour' => 'ram-mandir-ayodhya-tour',
            'ayodhya-ram-mandir-tour' => 'ram-mandir-ayodhya-tour',
            'ram-mandir-ayodhya' => 'ram-mandir-ayodhya-tour',
            'triveni-sangam' => 'triveni-sangam-tour',
            'sangam-tour' => 'triveni-sangam-tour',
            'prayagraj-sangam-tour' => 'triveni-sangam-tour',
            'triveni-sangam-prayagraj' => 'triveni-sangam-tour',
            'kashi-vishwanath' => 'kashi-vishwanath',
            'kashi-vishwanath-1' => 'kashi-vishwanath',
            'kashi-vishwanath-darshan' => 'kashi-vishwanath',
            'kashi-vishwanath-tour' => 'kashi-vishwanath',
            'kashi-vishwanath-tour-package' => 'kashi-vishwanath',
            'kashi-vishwanath-package' => 'kashi-vishwanath',
            'essential-kashi-vishwanath-darshan-yatra' => 'kashi-vishwanath',
            'kashi' => 'kashi-vishwanath',
            'sarnath' => 'sarnath-buddhist-heritage-tour',
            'sarnath-1' => 'sarnath-buddhist-heritage-tour',
            'assi-ghat' => 'assi-ghat-sunrise-spiritual-walk-experience',
            'assi-ghat-1' => 'assi-ghat-sunrise-spiritual-walk-experience',
            'vindhyachal' => 'sacred-vindhyachal-devi-darshan-yatra',
            'vindhyachal-test' => 'sacred-vindhyachal-devi-darshan-yatra',
            'dashashwamedh-ghat' => 'dashashwamedh-ghat-ganga-1',
        ];

        if (isset($aliases[$slug]) && isset($all[$aliases[$slug]])) {
            return $all[$aliases[$slug]];
        }

        if (str_ends_with($slug, '-1')) {
            $baseSlug = substr($slug, 0, -2);
            if (isset($all[$baseSlug])) {
                return $all[$baseSlug];
            }
        } else {
            $altSlug = $slug . '-1';
            if (isset($all[$altSlug])) {
                return $all[$altSlug];
            }
        }

        return null;
    }

    public static function syncPackage(Package $package): Package
    {
        $custom = self::getContent($package->slug);
        if (!$custom) {
            return $package;
        }

        $package->title = $custom['title'] ?? $package->title;
        $package->description = $custom['description'] ?? $package->description;
        if (!empty($custom['inclusions'])) {
            $package->inclusions = $custom['inclusions'];
        }
        if (!empty($custom['exclusions'])) {
            $package->exclusions = $custom['exclusions'];
        }
        if (!empty($custom['itinerary'])) {
            $package->itinerary = $custom['itinerary'];
        }
        if (!empty($custom['meta_title'])) {
            $package->meta_title = $custom['meta_title'];
        }
        if (!empty($custom['meta_description'])) {
            $package->meta_description = $custom['meta_description'];
        }
        if (!empty($custom['duration'])) {
            $package->duration = $custom['duration'];
        }
        if (!empty($custom['price']) && (empty($package->price) || $package->price == 0)) {
            $package->price = $custom['price'];
        }
        if (!empty($custom['images'])) {
            $package->images = $custom['images'];
        }
        if (!empty($custom['destination_id'])) {
            $package->destination_id = $custom['destination_id'];
        }

        // Auto-sync into MySQL database on live Hostinger if database doesn't have the new content yet
        try {
            $dbDesc = $package->getOriginal('description');
            $dbImages = $package->getOriginal('images');
            $syncImages = !empty($custom['images']) && (empty($dbImages) || (is_array($dbImages) && count($dbImages) > 0 && !file_exists(public_path('storage/' . $dbImages[0]))));
            
            if ($dbDesc !== $custom['description'] || $package->getOriginal('title') !== ($custom['title'] ?? $package->title) || $syncImages) {
                $fieldsToUpdate = [
                    'title' => $custom['title'] ?? $package->title,
                    'description' => $custom['description'],
                    'inclusions' => json_encode($custom['inclusions'] ?? []),
                    'exclusions' => json_encode($custom['exclusions'] ?? []),
                    'itinerary' => json_encode($custom['itinerary'] ?? []),
                    'meta_title' => $custom['meta_title'] ?? $package->meta_title,
                    'meta_description' => $custom['meta_description'] ?? $package->meta_description,
                    'duration' => $custom['duration'] ?? $package->duration,
                ];
                if (!empty($custom['images'])) {
                    $fieldsToUpdate['images'] = json_encode($custom['images']);
                }
                if (!empty($custom['destination_id'])) {
                    $fieldsToUpdate['destination_id'] = $custom['destination_id'];
                }
                Package::where('id', $package->id)->update($fieldsToUpdate);
            }

            // Also sync twin slug in database (e.g. sunrise-ganga-boat and sunrise-ganga-boat-1)
            $altSlug = str_ends_with($package->slug, '-1') ? substr($package->slug, 0, -2) : ($package->slug . '-1');
            Package::where('slug', $altSlug)->update([
                'title' => $custom['title'] ?? $package->title,
                'description' => $custom['description'],
                'inclusions' => json_encode($custom['inclusions'] ?? []),
                'exclusions' => json_encode($custom['exclusions'] ?? []),
                'itinerary' => json_encode($custom['itinerary'] ?? []),
                'meta_title' => $custom['meta_title'] ?? $package->meta_title,
                'meta_description' => $custom['meta_description'] ?? $package->meta_description,
                'duration' => $custom['duration'] ?? $package->duration,
            ]);

            $aliases = [
                'dev-deepawali-boat-booking-online' => 'dev-diwali-boat-ride-experience',
                'dev-diwali-boat-ride-experience' => 'dev-deepawali-boat-booking-online',
            ];
            if (isset($aliases[$package->slug])) {
                Package::where('slug', $aliases[$package->slug])->update([
                    'title' => $custom['title'] ?? $package->title,
                    'description' => $custom['description'],
                    'inclusions' => json_encode($custom['inclusions'] ?? []),
                    'exclusions' => json_encode($custom['exclusions'] ?? []),
                    'itinerary' => json_encode($custom['itinerary'] ?? []),
                    'meta_title' => $custom['meta_title'] ?? $package->meta_title,
                    'meta_description' => $custom['meta_description'] ?? $package->meta_description,
                    'duration' => $custom['duration'] ?? $package->duration,
                ]);
            }
        } catch (\Throwable $e) {
            // Silently ignore DB errors so page rendering never breaks
        }

        return $package;
    }

    public static function findOrFallback(string $slug): ?Package
    {
        $aliases = [
            'ayodhya' => 'book-kashi-prayagraj-ayodhya-tour-package-3-nights-4-days',
            'ayodhya-2-days-1-night' => 'book-kashi-prayagraj-ayodhya-tour-package-3-nights-4-days',
            'sunrise-ganga-boat' => 'sunrise-ganga-boat-1',
            'sunrise-ganga-boat-1' => 'sunrise-ganga-boat',
            'dashashwamedh-ghat-ganga' => 'dashashwamedh-ghat-ganga-1',
            'dashashwamedh-ghat-ganga-1' => 'dashashwamedh-ghat-ganga',
            'varanasi-famous-ghats' => 'varanasi-famous-ghats-1',
            'varanasi-famous-ghats-1' => 'varanasi-famous-ghats',
            'dev-deepawali-boat-booking-online' => 'dev-diwali-boat-ride-experience',
            'dev-diwali-boat-ride-experience' => 'dev-deepawali-boat-booking-online',
            'ramnagar-fort-tour' => 'royal-ramnagar-fort-heritage-tour',
            'ramnagar' => 'royal-ramnagar-fort-heritage-tour',
            'ramnagar-fort' => 'royal-ramnagar-fort-heritage-tour',
            'varanasi-ayodhya-prayagraj' => 'varanasi-ayodhya-prayagraj-package',
            'varanasi-ayodhya-prayagraj-tour' => 'varanasi-ayodhya-prayagraj-package',
            'varanasi-ayodhya-prayagraj-tour-package' => 'varanasi-ayodhya-prayagraj-package',
            'varanasi-boat-ride-cruise' => 'varanasi-boat-ride-and-cruise',
            'varanasi-boat-ride' => 'varanasi-boat-ride-and-cruise',
            'varanasi-family-tour-package' => 'varanasi-tour-package-for-family',
            'varanasi-tour-package-family' => 'varanasi-tour-package-for-family',
            'ayodhya-tour' => 'ayodhya-tour-package',
            'ayodhya-package' => 'ayodhya-tour-package',
            'ram-mandir-tour' => 'ram-mandir-ayodhya-tour',
            'ayodhya-ram-mandir-tour' => 'ram-mandir-ayodhya-tour',
            'ram-mandir-ayodhya' => 'ram-mandir-ayodhya-tour',
            'triveni-sangam' => 'triveni-sangam-tour',
            'sangam-tour' => 'triveni-sangam-tour',
            'prayagraj-sangam-tour' => 'triveni-sangam-tour',
            'triveni-sangam-prayagraj' => 'triveni-sangam-tour',
            'kashi-vishwanath' => 'kashi-vishwanath',
            'kashi-vishwanath-1' => 'kashi-vishwanath',
            'kashi-vishwanath-darshan' => 'kashi-vishwanath',
            'kashi-vishwanath-tour' => 'kashi-vishwanath',
            'kashi-vishwanath-tour-package' => 'kashi-vishwanath',
            'kashi-vishwanath-package' => 'kashi-vishwanath',
            'essential-kashi-vishwanath-darshan-yatra' => 'kashi-vishwanath',
            'kashi' => 'kashi-vishwanath',
            'sarnath' => 'sarnath-buddhist-heritage-tour',
            'sarnath-1' => 'sarnath-buddhist-heritage-tour',
            'assi-ghat' => 'assi-ghat-sunrise-spiritual-walk-experience',
            'assi-ghat-1' => 'assi-ghat-sunrise-spiritual-walk-experience',
            'vindhyachal' => 'sacred-vindhyachal-devi-darshan-yatra',
            'vindhyachal-test' => 'sacred-vindhyachal-devi-darshan-yatra',
            'dashashwamedh-ghat' => 'dashashwamedh-ghat-ganga-1',
        ];

        $package = Package::where('slug', $slug)->where('status', true)->first();
        if (!$package) {
            $package = Package::where('slug', $slug)->first();
        }

        // Check alias in DB
        if (!$package && isset($aliases[$slug])) {
            $package = Package::where('slug', $aliases[$slug])->where('status', true)->first();
            if (!$package) {
                $package = Package::where('slug', $aliases[$slug])->first();
            }
        }

        // Check alternate with/without -1 in DB
        if (!$package) {
            $altSlug = str_ends_with($slug, '-1') ? substr($slug, 0, -2) : ($slug . '-1');
            $package = Package::where('slug', $altSlug)->where('status', true)->first();
            if (!$package) {
                $package = Package::where('slug', $altSlug)->first();
            }
        }

        if (!$package) {
            $custom = self::getContent($slug);
            if ($custom) {
                try {
                    $package = Package::create([
                        'title' => $custom['title'],
                        'slug' => $slug,
                        'destination_id' => $custom['destination_id'] ?? null,
                        'service_id' => $custom['service_id'] ?? 1,
                        'duration' => $custom['duration'] ?? '1 Day',
                        'price' => $custom['price'] ?? 1000.00,
                        'difficulty' => $custom['difficulty'] ?? 'Easy',
                        'best_season' => $custom['best_season'] ?? null,
                        'start_location' => $custom['start_location'] ?? null,
                        'status' => true,
                        'featured' => true,
                        'description' => $custom['description'],
                        'inclusions' => $custom['inclusions'] ?? [],
                        'exclusions' => $custom['exclusions'] ?? [],
                        'itinerary' => $custom['itinerary'] ?? [],
                        'images' => $custom['images'] ?? ['destinations/UfwwNeKs2LphzsOuEQFdAZj4wRgsIF7EtYLmJAAW.jpg'],
                        'meta_title' => $custom['meta_title'] ?? null,
                        'meta_description' => $custom['meta_description'] ?? null,
                        'meta_keywords' => $custom['meta_keywords'] ?? null,
                    ]);
                } catch (\Throwable $e) {
                    $package = new Package([
                        'title' => $custom['title'],
                        'slug' => $slug,
                        'destination_id' => $custom['destination_id'] ?? null,
                        'description' => $custom['description'],
                        'inclusions' => $custom['inclusions'] ?? [],
                        'exclusions' => $custom['exclusions'] ?? [],
                        'itinerary' => $custom['itinerary'] ?? [],
                    ]);
                }
            }
        }

        if ($package) {
            $package = self::syncPackage($package);
        }

        return $package;
    }
}
