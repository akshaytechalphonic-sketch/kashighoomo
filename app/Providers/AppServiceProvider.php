<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Share the current page's SEO data with all views via the pages table.
        // This ensures meta_title, meta_description, meta_keywords are always
        // available in the layout without manually passing $page in every controller.
        View::composer('layouts.app', function ($view) {
            // Only resolve if $page isn't already set by the controller
            if (!isset($view->getData()['page'])) {
                $slug = Request::segment(1) ?: 'home';
                // Normalise common multi-segment slugs
                if (Request::is('/') || $slug === '') {
                    $slug = 'home';
                }
                $page = Page::where('slug', $slug)->where('status', true)->first();
                $view->with('page', $page);
            }
        });

        // Share global settings and dynamic header lists across all views with static caching
        View::composer('*', function ($view) {
            static $settings = null;
            static $headerDestinations = null;
            static $headerCabPackages = null;
            static $headerBoatPackages = null;
            static $headerCabs = null;
            static $headerYatraPackages = null;

            if ($settings === null) {
                if (\Schema::hasTable('settings')) {
                    $settings = \App\Models\Setting::first() ?: new \App\Models\Setting();
                } else {
                    $settings = new \App\Models\Setting();
                }

                if (\Schema::hasTable('destinations')) {
                    $headerDestinations = \App\Models\Destination::where('status', true)->get();
                } else {
                    $headerDestinations = collect();
                }

                if (\Schema::hasTable('cab_booking_packages')) {
                    $headerCabs = \App\Models\CabBookingPackage::where('status', true)->get();
                } else {
                    $headerCabs = collect();
                }

                if (\Schema::hasTable('services') && \Schema::hasTable('packages')) {
                    $yatraService = \App\Models\Service::where('slug', 'kashi-yatra-tour-packages')
                        ->orWhere('title', 'LIKE', '%Yatra%')
                        ->orWhere('title', 'LIKE', '%Tour%')
                        ->first();
                    if ($yatraService) {
                        $headerYatraPackages = \App\Models\Package::where('service_id', $yatraService->id)
                            ->where('status', true)
                            ->get();
                    } else {
                        $headerYatraPackages = collect();
                    }

                    $cabService = \App\Models\Service::where('slug', 'cab-booking')
                        ->orWhere('title', 'LIKE', '%Cab%')
                        ->first();
                    if ($cabService) {
                        $headerCabPackages = \App\Models\Package::where('service_id', $cabService->id)
                            ->where('status', true)
                            ->get();
                    } else {
                        $headerCabPackages = collect();
                    }

                    $boatService = \App\Models\Service::where('slug', 'boat-ride-booking')
                        ->orWhere('title', 'LIKE', '%Boat%')
                        ->first();
                    if ($boatService) {
                        $headerBoatPackages = \App\Models\Package::where('service_id', $boatService->id)
                            ->where('status', true)
                            ->get();
                    } else {
                        $headerBoatPackages = collect();
                    }
                } else {
                    $headerYatraPackages = collect();
                    $headerCabPackages = collect();
                    $headerBoatPackages = collect();
                }
            }

            $view->with([
                'settings'            => $settings,
                'headerDestinations'  => $headerDestinations,
                'headerCabPackages'   => $headerCabPackages,
                'headerBoatPackages'  => $headerBoatPackages,
                'headerCabs'          => $headerCabs,
                'headerYatraPackages' => $headerYatraPackages,
            ]);
        });
    }
}
