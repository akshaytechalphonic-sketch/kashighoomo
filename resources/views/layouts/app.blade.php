<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ $settings->site_favicon ? asset('storage/' . $settings->site_favicon) : asset('favicon.svg') }}">

    {{-- ===== DYNAMIC SEO META TAGS (driven by pages table & settings) ===== --}}
    @php
        $seoSource = $package ?? $page ?? $contactdata ?? $hotel ?? $blog ?? $destination ?? $service ?? null;
        $metaTitle       = $seoSource->meta_title       ?? ($settings->seo_meta_title ?? config('app.name', 'Kashi Tourism – Himalayan Journeys'));
        $metaDescription = $seoSource->meta_description ?? ($settings->seo_meta_description ?? 'Experience Kashi like never before — premium bike expeditions, luxury stays, and customised Himalayan itineraries crafted with passion.');
        $metaKeywords    = $seoSource->meta_keywords    ?? ($settings->seo_meta_keywords    ?? 'Kashi Tourism, Kashi tour packages, Varanasi Kashi, himalayan travel, bike expedition Kashi');
        $metaTags        = $seoSource->meta_tags        ?? null;
    @endphp

    <title>@yield('title', $metaTitle)</title>
    <meta name="description" content="@yield('meta_description', $metaDescription)">
    <meta name="keywords"    content="@yield('meta_keywords',    $metaKeywords)">
  
    {{-- <meta property="og:title"       content="@yield('title', $metaTitle)">
    <meta property="og:description" content="@yield('meta_description', $metaDescription)">
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ url()->current() }}">
  
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('title', $metaTitle)">
    <meta name="twitter:description" content="@yield('meta_description', $metaDescription)"> --}}

    @yield('meta_tags')
    @if(!empty($metaTags))
        {!! $metaTags !!}
    @endif

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('frontend-theme/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-theme/fonts/font-icons.css') }}">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-theme/css/boostrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-theme/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-theme/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-theme/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-theme/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-theme/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Bootstrap Icons for supplementary widgets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('preload')
    @stack('styles')

    <style>
        /* Premium Design System Overrides */
        :root {
            --primary-color: #F57C00;
            --primary-hover: #E65100;
            --secondary-color: #8B1E1E;
            --accent-gold: #D4AF37;
            --dark-text: #2C2C2C;
            --light-bg: #FFF8F0;
            --border-color: #E8E8E8;
        }

        body {
            font-family: 'Poppins', sans-serif !important;
            font-size: 15px !important;
            line-height: 1.6 !important;
            color: #2C2C2C !important;
            background-color: #FFF8F0 !important;
        }

        /* Typography scale to resolve massive/clashing headers */
        h1, .h1 {
            font-size: 2rem !important;
            font-weight: 600 !important;
            line-height: 1.25 !important;
            color: #2C2C2C !important;
            font-family: 'Poppins', sans-serif !important;
        }

        h2, .h2 {
            font-size: 1.65rem !important;
            font-weight: 600 !important;
            line-height: 1.3 !important;
            color: #2C2C2C !important;
            font-family: 'Poppins', sans-serif !important;
        }

        h3, .h3 {
            font-size: 1.3rem !important;
            font-weight: 600 !important;
            line-height: 1.35 !important;
            color: #fff !important;
            font-family: 'Poppins', sans-serif !important;
        }

        h4, .h4 {
            font-size: 1rem !important;
            font-weight: 500 !important;
            line-height: 1.4 !important;
            color: #2C2C2C !important;
            font-family: 'Poppins', sans-serif !important;
        }

        h5, .h5 {
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            font-family: 'Poppins', sans-serif !important;
        }

        h6, .h6 {
            font-size: 0.85rem !important;
            font-weight: 500 !important;
            font-family: 'Poppins', sans-serif !important;
        }

        p {
            font-size: 0.92rem !important;
            line-height: 1.6 !important;
            /* color: #5F615E !important; */
        }

        /* Nav links sizing and clean structure */
        header.header {
            background: rgba(236, 132, 45, 90%) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(6, 22, 36, 0.04) !important;
            border-bottom: 1px solid rgba(245, 124, 0, 0.08) !important;
            transition: all 0.3s ease-in-out !important;
        }
        header.header.style-1 .nav-link {
            color: #fff !important;
            font-weight: 600 !important;
            font-size: 0.92rem !important;
            transition: color 0.2s ease-in-out !important;
        }
        header.header.style-1 .nav-link:hover,
        header.header.style-1 .nav-link.active {
            color: #f1efef !important;
        }
        .site-logo-img {
            max-height: 60px;
            object-fit: contain;
        }

        .btn-book-header {
            background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);
            color: #ffffff !important;
            font-size: 13px;
            font-weight: 700;
            padding: 9px 24px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(245, 124, 0, 0.25);
            transition: all 0.3s;
            border: none;
            letter-spacing: 0.3px;
        }
        .btn-book-header:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 124, 0, 0.35);
            color: #ffffff !important;
        }

        
        /* Auto open dropdowns on hover positioning */
        @media (min-width: 992px) {
            .menu-item.dropdown {
                position: relative !important;
            }
            .menu-item.dropdown .dropdown-menu {
                position: absolute !important;
                left: 0 !important;
                top: 100% !important;
                z-index: 9999 !important;
                margin-top: 0 !important;
            }
            /* Ensure header is above page content */
            header#header {
                z-index: 9000 !important;
            }
        }

        /* Standardized Premium Card design system */
        .item.hover-img.bg-white,
        .perfect-trip-card,
        .accommodation-card-premium,
        .cab-card-premium {
            border: 1px solid #E8E8E8 !important;
            box-shadow: 0 4px 20px rgba(6, 22, 36, 0.02) !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            background: #ffffff !important;
        }
        .item.hover-img.bg-white:hover,
        .perfect-trip-card:hover,
        .accommodation-card-premium:hover,
        .cab-card-premium:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 12px 30px rgba(245, 124, 0, 0.08) !important;
            border-color: rgba(245, 124, 0, 0.3) !important;
        }

        /* Color Overrides resolving contrast clashes */
        .text-primary, .text-warning {
            color: #F57C00 !important;
        }
        .rating .text-warning {
            color: #D4AF37 !important;
        }
        .bg-warning {
            background-color: #F57C00 !important;
            color: #ffffff !important;
        }
        .bg-success {
            background-color: #8B1E1E !important;
            color: #ffffff !important;
        }

        /* Premium Buttons */
        .tf-btn.primary,
        .btn-primary,
        .bg-primary,
        .button-primary {
            background-color: #F57C00 !important;
            border-color: #F57C00 !important;
            color: #ffffff !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            transition: all 0.2s ease-in-out !important;
        }
        .tf-btn.primary:hover,
        .btn-primary:hover,
        .button-primary:hover {
            background-color: #E65100 !important;
            border-color: #E65100 !important;
            color: #ffffff !important;
        }
        .hover-text-warning:hover {
            color: #F57C00 !important;
            transform: translateX(4px);
            transition: color 0.2s ease, transform 0.2s ease;
        }
        /* Ensure footer links don't affect each other on hover */
        .footer .tour-list li {
            display: block;
            line-height: 1.9;
        }
        .footer .tour-list li a {
            display: inline-block;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        /* Contact floating options */
        .btn-floating {
            position: fixed;
            right: 25px;
            overflow: hidden;
            width: 50px;
            height: 50px;
            border-radius: 100px;
            border: 0;
            z-index: 9999;
            color: white;
            transition: .2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-floating:hover {
            width: auto;
            padding: 0 20px;
            cursor: pointer;
        }
        .btn-floating span {
            font-size: 14px;
            margin-left: 8px;
            transition: .2s;
            white-space: nowrap;
            display: none;
        }
        .btn-floating:hover span {
            display: inline-block;
        }
        .btn-floating.phone {
            bottom: 85px;
            background-color: #8B1E1E;
        }
        .btn-floating.phone:hover {
            background-color: #a82e2e;
        }
        .btn-floating.whatsapp {
            background-color: #34af23;
            bottom: 25px;
        }
        .btn-floating.whatsapp:hover {
            background-color: #1f7a12;
        }

        .header.style-1 .header-wrap .header-ct-right .wrap-login-menu .login a {
            color: #2C2C2C;
            font-weight: 600;
        }
        .header.style-1 .header-wrap .header-ct-right .wrap-login-menu .login a:hover {
            color: #f3f1ee;
        }
        .dropdown-menu-premium {
            background: #ffffff;
            border: 1px solid #E8E8E8;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }
        .dropdown-menu-premium .dropdown-item {
            font-weight: 500;
            font-size: 0.88rem;
            color: #2C2C2C;
            padding: 8px 16px;
            transition: all 0.2s;
        }
        .dropdown-menu-premium .dropdown-item:hover {
            background-color: #FFF8F0;
            color: #F57C00;
        }
        .page-title {
            background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), 
                        url('{{ asset("frontend-theme/images/backgrounds/page-title.jpg") }}') center/cover no-repeat !important;
            padding: 100px 0 60px !important;
            margin-top: 85px;
        }
        .page-title .title {
            color: #ffffff !important;
            font-weight: 800 !important;
            font-family: "Poppins", sans-serif;
        }

        /* ================================================
           GLOBAL MOBILE RESPONSIVE STYLES
           ================================================ */

        /* Tablet — max-width: 991px */
        @media (max-width: 991px) {
            /* Header */
            header.header {
                padding: 8px 0 !important;
            }
            .site-logo-img {
                max-height: 45px;
            }
            .btn-book-header {
                font-size: 11px !important;
                padding: 8px 16px !important;
            }

            /* Typography scale-down */
            h1, .h1 {
                font-size: 1.75rem !important;
                font-weight: 600 !important;
            }
            h2, .h2 {
                font-size: 1.35rem !important;
                font-weight: 600 !important;
            }
            h3, .h3 {
                font-size: 1.15rem !important;
                font-weight: 500 !important;
            }

            /* Page title banner */
            .page-title {
                padding: 70px 0 40px !important;
                margin-top: 75px;
            }

            /* Cards */
            .item.hover-img.bg-white,
            .perfect-trip-card,
            .accommodation-card-premium,
            .cab-card-premium {
                border-radius: 10px !important;
            }

            /* Footer */
            .footer .container {
                padding-left: 20px;
                padding-right: 20px;
            }

            /* Section padding */
            .flat-section.py-5 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }

            /* Floating buttons */
            .btn-floating {
                right: 14px !important;
                width: 46px !important;
                height: 46px !important;
                border-radius: 50% !important;
                padding: 0 !important;
            }
            .btn-floating.phone {
                bottom: 78px !important;
            }
            .btn-floating.whatsapp {
                bottom: 18px !important;
            }
            .btn-floating span {
                display: none !important;
            }
        }

        /* Mobile — max-width: 767px */
        @media (max-width: 767px) {
            /* Typography */
            h1, .h1 {
                font-size: 1.5rem !important;
            }
            h2, .h2 {
                font-size: 1.2rem !important;
            }
            h3, .h3 {
                font-size: 1.05rem !important;
            }
            h4, .h4 {
                font-size: 1rem !important;
            }
            p {
                font-size: 0.85rem !important;
            }

            /* Header */
            .site-logo-img {
                max-height: 38px;
            }

            /* Page title */
            .page-title {
                padding: 45px 0 25px !important;
                margin-top: 72px !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                border-radius: 0 !important;
            }
            .page-title .title {
                font-size: 20px !important;
                line-height: 1.3 !important;
            }

            /* Container padding */
            .container {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            /* Section titles */
            .box-title .desc {
                font-size: 13px !important;
            }

            /* Buttons */
            .tf-btn.primary {
                font-size: 12px !important;
                padding: 10px 20px !important;
            }

            /* Cards — reduce hover lift */
            .item.hover-img.bg-white:hover,
            .perfect-trip-card:hover,
            .accommodation-card-premium:hover,
            .cab-card-premium:hover,
            .pkg-card:hover {
                transform: translateY(-2px) !important;
            }

            /* Footer columns stack */
            .footer .row > [class*="col-"] {
                margin-bottom: 20px;
            }

            /* Floating support buttons — compact */
            .btn-floating {
                width: 46px !important;
                height: 46px !important;
                border-radius: 50% !important;
                padding: 0 !important;
                justify-content: center !important;
            }
            .btn-floating.phone {
                bottom: 78px !important;
            }
            .btn-floating.whatsapp {
                bottom: 18px !important;
            }
            .btn-floating i {
                font-size: 18px !important;
            }
            .btn-floating span {
                display: none !important;
            }

            /* Tab bar / nav fixes */
            .dropdown-menu-premium {
                min-width: 200px !important;
                border-radius: 12px !important;
            }

            /* Modals */
            .modal-dialog {
                margin: 10px !important;
            }
            .modal-content {
                border-radius: 16px !important;
            }
        }

        /* Small phones — max-width: 575px */
        @media (max-width: 575px) {
            h1, .h1 {
                font-size: 1.3rem !important;
            }
            h2, .h2 {
                font-size: 1.1rem !important;
            }

            .page-title {
                padding: 45px 0 25px !important;
                margin-top: 55px;
            }
            .page-title .title {
                font-size: 20px !important;
            }

            /* Even smaller sections */
            .flat-section.py-5 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }

            /* Buttons */
            .tf-btn.primary {
                font-size: 11px !important;
                padding: 9px 18px !important;
            }

            /* Cards compact */
            .pkg-card-img {
                height: 150px !important;
            }
        }

        /* ===== Premium Mobile Navbar & Drawer Overrides ===== */
        @media (max-width: 991px) {
            .mobile-menu {
                position: fixed !important;
                top: 0 !important;
                bottom: 0 !important;
                left: -320px !important;
                width: 300px !important;
                max-width: 85% !important;
                height: 100vh !important;
                background: #ffffff !important;
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15) !important;
                transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
                z-index: 100000 !important;
                display: block !important;
                padding: 0 !important;
                overflow-y: auto !important;
            }

            .mobile-menu.active {
                left: 0 !important;
            }

            .mobile-menu .menu-box {
                padding: 24px 20px !important;
                display: flex !important;
                flex-direction: column !important;
                height: 100% !important;
            }

            .mobile-menu .logo {
                border-bottom: 1.5px solid #f0f0f0 !important;
                padding-bottom: 18px !important;
                margin-bottom: 20px !important;
            }

            .mobile-menu .inner-menu {
                display: flex !important;
                flex-direction: column !important;
                gap: 8px !important;
                border-bottom: none !important;
                margin: 0 0 20px 0 !important;
                padding: 0 !important;
            }

            .mobile-menu .inner-menu .nav-item {
                border-radius: 8px !important;
                overflow: hidden !important;
                transition: all 0.25s !important;
                display: block !important;
            }

            .mobile-menu .inner-menu .nav-item a {
                display: flex !important;
                align-items: center !important;
                padding: 12px 16px !important;
                color: #2C2C2C !important;
                font-family: 'Poppins', sans-serif !important;
                font-weight: 600 !important;
                font-size: 14.5px !important;
                text-decoration: none !important;
                transition: all 0.25s !important;
            }

            .mobile-menu .inner-menu .nav-item.active,
            .mobile-menu .inner-menu .nav-item:hover {
                background: rgba(245, 124, 0, 0.08) !important;
            }

            .mobile-menu .inner-menu .nav-item.active a,
            .mobile-menu .inner-menu .nav-item:hover a {
                color: #F57C00 !important;
                padding-left: 20px !important;
            }

            /* Overlay styling */
            .overlay {
                position: fixed !important;
                inset: 0 !important;
                background-color: rgba(6, 22, 36, 0.6) !important;
                backdrop-filter: blur(4px) !important;
                opacity: 0 !important;
                visibility: hidden !important;
                transition: all 0.3s ease !important;
                z-index: 99999 !important;
            }

            .overlay.active {
                opacity: 1 !important;
                visibility: visible !important;
            }

            /* Premium Rounded Close Button */
            .close-btn {
                position: fixed !important;
                top: 16px !important;
                right: 16px !important;
                z-index: 100001 !important;
                width: 36px !important;
                height: 36px !important;
                border-radius: 50% !important;
                background-color: #F57C00 !important;
                color: #ffffff !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
                border: none !important;
                box-shadow: 0 4px 12px rgba(245, 124, 0, 0.25) !important;
                transition: all 0.25s ease !important;
                opacity: 0 !important;
                visibility: hidden !important;
            }

            .close-btn.active {
                opacity: 1 !important;
                visibility: visible !important;
            }

            .close-btn i, .close-btn span {
                font-size: 16px !important;
                color: #ffffff !important;
            }

            .close-btn:hover {
                background-color: #E65100 !important;
                transform: rotate(90deg) !important;
            }
        }
    </style>
</head>

<body>
    <!-- Preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
            <img src="{{ asset('frontend-theme/images/logo/destination.png') }}" alt="logo-loading">
        </div>
    </div>

    <!-- Main App Wrapper -->
    <div id="app" class="d-flex flex-column min-vh-100">
        
        <!-- Header -->
        @if(!request()->routeIs('login'))
        <header id="header" class="header style-1 position-fixed color-1">
            <div class="container">
                <div class="header-wrap relative w-full">
                    <div class="header-ct-left flex-left z-5">
                        <div class="logo flex-center" id="logo">
                            <a href="{{ url('/') }}" class="text-decoration-none">
                                @if(!empty($settings->site_logo))
                                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name ?? 'visitKashi' }}" style="max-height: 50px; width: auto; object-fit: contain;">
                                @else
                                    <span style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; letter-spacing: -0.5px; line-height: 1;">
                                        <span style="color: #F57C00;"><i class="bi bi-water me-1"></i>Kashi</span><span style="color: #8B1E1E;">Ghoomo</span>
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                    
                    <div class="header-ct-center flex-center z-5">
                        <div class="inner-center">
                            <div class="nav-wrap">
                                <nav class="list-nav">
                                    <ul class="menu-nav" id="menu-nav">
                                        <li class="menu-item flex-center gap-1 h-full">
                                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                                        </li>
                                        <li class="menu-item dropdown flex-center gap-1 h-full">
                                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Tour Packages <span class="bi bi-chevron-down ms-1" style="font-size: 10px;"></span></a>
                                            <ul class="dropdown-menu border-0 shadow-lg p-2 rounded-3 dropdown-menu-premium">
                                                @forelse($headerDestinations as $dest)
                                                    <li><a class="dropdown-item rounded-2" href="{{ route('packages.index', $dest->slug) }}">{{ $dest->name }} Tour</a></li>
                                                @empty
                                                    <li><a class="dropdown-item rounded-2" href="{{ route('packages.index') }}">Varanasi Tour</a></li>
                                                @endforelse
                                                <li><hr class="dropdown-divider" style="border-color: #E8E8E8;"></li>
                                                <li><a class="dropdown-item rounded-2 fw-bold" href="{{ route('packages.index') }}">All Packages</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item dropdown flex-center gap-1 h-full">
                                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Cabs <span class="bi bi-chevron-down ms-1" style="font-size: 10px;"></span></a>
                                            <ul class="dropdown-menu border-0 shadow-lg p-2 rounded-3 dropdown-menu-premium">
                                                @forelse($headerCabs as $cab)
                                                    @php
                                                        $icon = '🚗';
                                                        if (stripos($cab->vehicle_type, 'SUV') !== false) {
                                                            $icon = '🚙';
                                                        } elseif (stripos($cab->vehicle_type, 'Tempo') !== false || stripos($cab->vehicle_type, 'Traveler') !== false || stripos($cab->vehicle_type, 'Bus') !== false || stripos($cab->cab_name, 'Tempo') !== false) {
                                                            $icon = '🚌';
                                                        }
                                                    @endphp
                                                    <li>
                                                        <a class="dropdown-item rounded-2" href="{{ route('packages.index', ['cab_booking_package_id' => $cab->id]) }}">
                                                            {{ $icon }} {{ $cab->cab_name }}
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li><a class="dropdown-item rounded-2" href="{{ route('cabs.index') }}">🚗 All Cabs</a></li>
                                                @endforelse
                                                <li><hr class="dropdown-divider" style="border-color: #E8E8E8;"></li>
                                                <li><a class="dropdown-item rounded-2 fw-bold" href="{{ route('cabs.index') }}">All Cab Services</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item dropdown flex-center gap-1 h-full">
                                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Boats <span class="bi bi-chevron-down ms-1" style="font-size: 10px;"></span></a>
                                            <ul class="dropdown-menu border-0 shadow-lg p-2 rounded-3 dropdown-menu-premium">
                                                @forelse($headerBoatPackages as $pkg)
                                                    <li><a class="dropdown-item rounded-2" href="{{ route('packages.show', $pkg->slug) }}">{{ $pkg->title }}</a></li>
                                                @empty
                                                    <li><a class="dropdown-item rounded-2" href="{{ route('boat-rides.index') }}">Motor Boat Booking</a></li>
                                                    <li><a class="dropdown-item rounded-2" href="{{ route('boat-rides.index') }}">Bajra Boat Booking</a></li>
                                                @endforelse
                                                <li><hr class="dropdown-divider" style="border-color: #E8E8E8;"></li>
                                                <li><a class="dropdown-item rounded-2 fw-bold" href="{{ route('boat-rides.index') }}">All Boat Bookings</a></li>
                                            </ul>
                                        </li>
                                        

                                        <li class="menu-item flex-center gap-1 h-full">
                                            <a href="{{ route('blogs.index') }}" class="nav-link {{ request()->routeIs('blogs') ? 'active' : '' }}">Blogs</a>
                                        </li>
                                        <li class="menu-item flex-center gap-1 h-full">
                                            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <div class="header-ct-right flex-end gap-4 z-5">
                        <a href="{{ route('packages.index') }}" class="btn-book-header d-none d-lg-inline-block text-decoration-none">
                            Book Package
                        </a>
                        <ul class="wrap-login-menu">
                            @guest
                                
                            @else
                                <li class="login dropdown">
                                    <span class="icon icon-user"></span>
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-premium border-0 shadow-lg mt-2 p-2">
                                        @if(Auth::user()->role === 'admin')
                                            <li><a class="dropdown-item rounded-3" href="{{ route('admin.dashboard') }}">
                                                <i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item rounded-3 text-danger fw-bold" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                        <div class="toggle-mobile">
                            <span class="icon icon-list"></span>
                        </div>
                    </div>
                </div>

                <div class="overlay"></div>
                <div class="close-btn flex-center">
                    <i class="bi bi-x-lg"></i>
                </div>

                <!-- Mobile Menu -->
                <div class="mobile-menu">
                    <div class="menu-box">
                        <div class="logo">
                            <a href="{{ url('/') }}" class="text-decoration-none">
                                @if(!empty($settings->site_logo))
                                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name ?? 'visitKashi' }}" style="max-height: 45px; width: auto; object-fit: contain;">
                                @else
                                    <span style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 800; letter-spacing: -0.5px; line-height: 1;">
                                        <span style="color: #F57C00;"><i class="bi bi-water me-1"></i>Kashi</span><span style="color: #8B1E1E;">Tourism</span>
                                    </span>
                                @endif
                            </a>
                        </div>
                        <div class="inner-menu">
                            <div class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}"><span class="nav-text">Home</span></a>
                            </div>
                            <div class="nav-item {{ request()->routeIs('packages.*') ? 'active' : '' }}">
                                <a href="{{ route('packages.index') }}"><span class="nav-text">Tour Packages</span></a>
                            </div>
                            <div class="nav-item {{ request()->routeIs('cabs.*') ? 'active' : '' }}">
                                <a href="{{ route('cabs.index') }}"><span class="nav-text">Cabs</span></a>
                            </div>
                            <div class="nav-item {{ request()->routeIs('boat-rides.*') ? 'active' : '' }}">
                                <a href="{{ route('boat-rides.index') }}"><span class="nav-text">Boats</span></a>
                            </div>
                             <div class="nav-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                                <a href="{{ route('blogs.index') }}"><span class="nav-text">Blogs</span></a>
                            </div>
                            <div class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <a href="{{ route('contact') }}"><span class="nav-text">Contact</span></a>
                            </div>
                        </div>

                        <div class="inner-info mt-4">
                            <h4 class="title-info">Need help?</h4>
                            <div class="list-info d-flex flex-col gap-3">
                                @if($settings->contact_phone)
                                <div class="phone d-flex">
                                    <div class="icon flex-center">
                                        <i class="bi bi-telephone-fill text-warning"></i>
                                    </div>
                                    <div class="content ms-3">
                                        <p class="label mb-0" style="font-size:12px; color:#888;">Call Us</p>
                                        <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" class="fw-bold">{{ $settings->contact_phone }}</a>
                                    </div>
                                </div>
                                @endif
                                @if($settings->contact_email)
                                <div class="email d-flex">
                                    <div class="icon flex-center">
                                        <i class="bi bi-envelope-fill text-warning"></i>
                                    </div>
                                    <div class="content ms-3">
                                        <p class="label mb-0" style="font-size:12px; color:#888;">Email</p>
                                        <a href="mailto:{{ $settings->contact_email }}" class="fw-bold">{{ $settings->contact_email }}</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @endif

        <!-- Main Content Area -->
        <main class="flex-grow-1">
            @yield('content')
        </main>

        <!-- Footer -->
        @if(!request()->routeIs('login'))
        <footer class="footer">
            <div class="inner-footer py-5" style="background: #0b1a29; border-top: 1px solid rgba(255,255,255,0.05);">
                <div class="container">
                    <div class="row g-4">
                        <!-- Column 1: Info and contact -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="widget-box">
                                <div class="footer-logo mb-4">
                                    <a href="{{ url('/') }}" class="text-decoration-none">
                                        @if(!empty($settings->site_logo))
                                            <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name ?? 'visitKashi' }}" style="max-height: 50px; width: auto; object-fit: contain;">
                                        @else
                                            <span style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; letter-spacing: -0.5px; line-height: 1;">
                                                <span style="color: #F57C00;">visit</span><span style="color: #ffffff;">Kashi</span>
                                            </span>
                                        @endif
                                    </a>
                                </div>
                                <p class="text-white-50 mb-4" style="font-size: 13.5px; line-height: 1.6; text-align: justify;">
                                    India's most trusted travel partner for Varanasi — hotel stays, cab hire, boat rides, Ganga Aarti & pilgrimage tours.
                                </p>
                                @if($settings->address)
                                <p class="text-white-50 mb-3" style="font-size: 13px; line-height: 1.5;">
                                    <i class="bi bi-geo-alt-fill text-warning me-2" style="color: #D4AF37 !important;"></i> {{ $settings->address }}
                                </p>
                                @endif
                                @if($settings->contact_phone)
                                <p class="text-white-50 mb-3" style="font-size: 13px;">
                                    <i class="bi bi-telephone-fill text-warning me-2" style="color: #D4AF37 !important;"></i> 
                                    <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" class="text-white text-decoration-none">{{ $settings->contact_phone }}</a>
                                </p>
                                @endif
                                @if($settings->contact_email)
                                <p class="text-white-50 mb-4" style="font-size: 13px;">
                                    <i class="bi bi-envelope-fill text-warning me-2" style="color: #D4AF37 !important;"></i> 
                                    <a href="mailto:{{ $settings->contact_email }}" class="text-white text-decoration-none">{{ $settings->contact_email }}</a>
                                </p>
                                @endif
                                <div class="footer-socials">
                                    <ul class="list-social d-flex gap-3 p-0" style="list-style:none;">
                                        @if($settings->facebook_url)
                                            <li><a href="{{ $settings->facebook_url }}" target="_blank" class="text-white fs-5" aria-label="Facebook"><i class="bi bi-facebook"></i></a></li>
                                        @endif
                                        @if($settings->instagram_url)
                                            <li><a href="{{ $settings->instagram_url }}" target="_blank" class="text-white fs-5" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                                        @endif
                                        @if($settings->twitter_url)
                                            <li><a href="{{ $settings->twitter_url }}" target="_blank" class="text-white fs-5" aria-label="Twitter"><i class="bi bi-twitter"></i></a></li>
                                        @endif
                                        @if($settings->whatsapp_number)
                                            <li><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" class="text-white fs-5" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Kashi Yatra -->
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="widget-box">
                                <div class="text-white h5 fw-bold mb-4" style="border-bottom: 2px solid #8B1E1E; padding-bottom: 8px; display: inline-block; font-size: 15px;">KASHI YATRA</div>
                                <ul class="tour-list p-0" style="list-style:none; line-height: 2;">
                                    @forelse($headerYatraPackages as $pkg)
                                        <li><a href="{{ route('packages.show', $pkg->slug) }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">{{ $pkg->title }}</a></li>
                                    @empty
                                        <li><a href="{{ route('packages.index') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">Varanasi Yatra Packages</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <!-- Column 3: Cab Booking -->
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="widget-box">
                                <div class="text-white h5 fw-bold mb-4" style="border-bottom: 2px solid #8B1E1E; padding-bottom: 8px; display: inline-block; font-size: 15px;">CAB BOOKING</div>
                                <ul class="tour-list p-0" style="list-style:none; line-height: 2;">
                                    @forelse($headerCabs as $cab)
                                        <li><a href="{{ route('packages.index', ['cab_booking_package_id' => $cab->id]) }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">{{ $cab->cab_name }}</a></li>
                                    @empty
                                        <li><a href="{{ route('cabs.index') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">All Cab Booking Services</a></li>
                                    @endforelse
                                    <li><a href="{{ route('cabs.index') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px; font-weight:bold;">All Cab Services</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 4: Boat Booking -->
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="widget-box">
                                <div class="text-white h5 fw-bold mb-4" style="border-bottom: 2px solid #8B1E1E; padding-bottom: 8px; display: inline-block; font-size: 15px;">BOAT BOOKING</div>
                                <ul class="tour-list p-0" style="list-style:none; line-height: 2;">
                                    @forelse($headerBoatPackages as $pkg)
                                        <li><a href="{{ route('packages.show', $pkg->slug) }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">{{ $pkg->title }}</a></li>
                                    @empty
                                        <li><a href="{{ route('boat-rides.index') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">Boat Rides & Cruises</a></li>
                                    @endforelse
                                    <li><a href="{{ route('boat-rides.index') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px; font-weight:bold;">All Boat Bookings</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 5: Quick Links -->
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="widget-box">
                                <div class="text-white h5 fw-bold mb-4" style="border-bottom: 2px solid #8B1E1E; padding-bottom: 8px; display: inline-block; font-size: 15px;">QUICK LINKS</div>
                                <ul class="tour-list p-0" style="list-style:none; line-height: 2;">
                                    <li><a href="{{ route('about') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">About Us</a></li>
                                    <li><a href="{{ route('privacy-policy') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">Privacy Policy</a></li>
                                    <li><a href="{{ route('terms-conditions') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">Terms &amp; Conditions</a></li>
                                    <li><a href="{{ route('faq') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">FAQs</a></li>
                                    <li><a href="{{ route('contact') }}" class="text-white-50 text-decoration-none hover-text-warning" style="font-size: 13px;">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bottom-footer" style="background: #06111b; border-top: 1px solid rgba(255,255,255,0.05); py-3;">
                <div class="container">
                    <div class="content-bottom d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="copy-right text-white-50" style="font-size: 12.5px;">
                            {!! $settings->copyright_text ?? '&copy; ' . date('Y') . ' <strong>Kashi Tourism</strong>. All Rights Reserved.' !!}
                        </div>
                        <ul class="menu-bottom flex-center gap-3 p-0 m-0" style="list-style:none;">
                            <li><a href="{{ route('terms-conditions') }}" class="item-bottom text-white-50 text-decoration-none hover-text-warning" style="font-size: 12px;">Terms of use</a></li>
                            <li><a href="{{ route('privacy-policy') }}" class="item-bottom text-white-50 text-decoration-none hover-text-warning" style="font-size: 12px;">Privacy policy</a></li>
                            <li><a href="{{ route('faq') }}" class="item-bottom text-white-50 text-decoration-none hover-text-warning" style="font-size: 12px;">FAQs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        @endif
    </div>

    <!--  Search Modal -->
    <div class="modal fade" id="modalSearch" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="m-0 h4">Search Tours</div>
                    <span class="close-modal icon-X" data-bs-dismiss="modal"></span>
                </div>
                <form class="search-box" id="searchForm" method="GET" action="{{ route('packages.index') }}">
                    <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search by location, title, price...">
                    <button type="submit" class="icon icon-search pos-2" aria-label="Search"></button>
                </form>
                <div id="searchResults" class="mt-3"></div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal modal-account fade" id="modalLogin" aria-modal="true" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account">
                    <div class="banner-account">
                        <img src="{{ asset('frontend-theme/images/locations/tour-98.jpg') }}" alt="banner">
                        <img src="{{ asset('frontend-theme/images/logo/logo.svg') }}" alt="logo" class="logo-overlay">
                    </div>
                    <form class="form-account" id="loginForm" onsubmit="event.preventDefault(); alert('Login simulated successfully!');">
                        <div class="title-box">
                            <h1>Login</h1>
                            <span class="close-modal icon-X" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="box">
                            <fieldset class="box-fieldset">
                                <label>Email</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/mail.svg') }}" alt="icons" class="icon">
                                    <input type="email" class="form-control" id="loginEmail" placeholder="Your email" required>
                                </div>
                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label>Password</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/icon-lock.svg') }}" alt="icons" class="icon">
                                    <input type="password" class="form-control" id="loginPassword" placeholder="Your password" required>
                                </div>
                                <div class="text-forgot text-end">
                                    <a href="#modalForgot" data-bs-toggle="modal">Forgot password?</a>
                                </div>
                            </fieldset>
                        </div>
                        <div class="box box-btn">
                            <button type="submit" class="tf-btn primary w-100">Login</button>
                            <div class="text text-center subtitle">
                                Don’t you have an account?
                                <a href="#modalRegister" data-bs-toggle="modal" class="text_primary">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal modal-account fade" id="modalRegister">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account">
                    <div class="banner-account">
                        <img src="{{ asset('frontend-theme/images/locations/tour-99.jpg') }}" alt="banner">
                        <img src="{{ asset('frontend-theme/images/logo/logo.svg') }}" alt="logo" class="logo-overlay">
                    </div>
                    <form class="form-account" onsubmit="event.preventDefault(); alert('Registration simulated successfully!');">
                        <div class="title-box">
                            <h1>Register</h1>
                            <span class="close-modal icon-X" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="box">
                            <fieldset class="box-fieldset">
                                <label>Email address</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/mail.svg') }}" alt="icons" class="icon">
                                    <input type="email" class="form-control" placeholder="Email address" required>
                                </div>
                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label>Password</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/icon-lock.svg') }}" alt="icon" class="icon">
                                    <input type="password" class="form-control" placeholder="Your password" required>
                                </div>
                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label>Confirm password</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/icon-lock.svg') }}" alt="icon" class="icon">
                                    <input type="password" class="form-control" placeholder="Confirm password" required>
                                </div>
                            </fieldset>
                        </div>
                        <div class="box box-btn">
                            <button type="submit" class="tf-btn primary w-100">Sign Up</button>
                            <div class="text text-center">
                                Already have an account?
                                <a href="#modalLogin" data-bs-toggle="modal" data-bs-dismiss="modal" class="text_primary">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Modal -->
    <div class="modal modal-account fade" id="modalForgot" aria-modal="true" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account">
                    <div class="banner-account">
                        <img src="{{ asset('frontend-theme/images/locations/tour-80.jpg') }}" alt="banner">
                        <img src="{{ asset('frontend-theme/images/logo/logo.svg') }}" alt="logo" class="logo-overlay">
                    </div>
                    <form class="form-account" onsubmit="event.preventDefault();">
                        <div class="title-box">
                            <h1>Forgot Password</h1>
                            <span class="close-modal icon-X" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="box">
                            <fieldset class="box-fieldset">
                                <label>Email</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/mail.svg') }}" alt="icons" class="icon">
                                    <input type="email" class="form-control" placeholder="Enter your registered email" required>
                                </div>
                            </fieldset>
                        </div>
                        <div class="box box-btn">
                            <a href="#modalOTP" data-bs-toggle="modal" data-bs-dismiss="modal" class="tf-btn primary w-100 text-center text-white py-2 text-decoration-none">Send Reset Link</a>
                            <div class="text text-center">
                                Back to <a href="#modalLogin" data-bs-toggle="modal" class="text_primary">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- OTP Modal -->
    <div class="modal modal-account fade" id="modalOTP" aria-modal="true" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account">
                    <div class="banner-account">
                        <img src="{{ asset('frontend-theme/images/locations/tour-41.jpg') }}" alt="banner">
                        <img src="{{ asset('frontend-theme/images/logo/logo.svg') }}" alt="logo" class="logo-overlay">
                    </div>
                    <form class="form-account otp-form" id="otpForm" onsubmit="event.preventDefault();">
                        <div class="title-box">
                            <h1>Enter Code</h1>
                            <span class="close-modal icon-X" data-bs-dismiss="modal"></span>
                        </div>
                        <p class="text-center caption-2 mb-4">
                            Please check the message sent to <br>
                            <strong class="text_primary" id="otpEmail">your email address</strong>
                        </p>
                        <div class="box otp-box text-center">
                            <div class="otp-inputs d-flex justify-content-center gap-4">
                                <input type="text" maxlength="1" class="otp-input" inputmode="numeric">
                                <input type="text" maxlength="1" class="otp-input" inputmode="numeric">
                                <input type="text" maxlength="1" class="otp-input" inputmode="numeric">
                                <input type="text" maxlength="1" class="otp-input" inputmode="numeric">
                                <input type="text" maxlength="1" class="otp-input" inputmode="numeric">
                                <input type="text" maxlength="1" class="otp-input" inputmode="numeric">
                            </div>
                        </div>
                        <div class="box box-btn">
                            <a href="#modalResetPassword" data-bs-toggle="modal" data-bs-dismiss="modal" class="tf-btn primary w-100 text-center text-white py-2 text-decoration-none" id="btnOtpContinue">Continue</a>
                        </div>
                        <div class="text text-center">
                            Didn’t receive the code?
                            <a href="#" class="text_primary" id="btnOtpResend">Resend</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal modal-account fade" id="modalResetPassword" aria-modal="true" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account">
                    <div class="banner-account">
                        <img src="{{ asset('frontend-theme/images/locations/tour-76.jpg') }}" alt="banner">
                        <img src="{{ asset('frontend-theme/images/logo/logo.svg') }}" alt="logo" class="logo-overlay">
                    </div>
                    <form class="form-account" onsubmit="event.preventDefault();">
                        <div class="title-box">
                            <h1>Reset Password</h1>
                            <span class="close-modal icon-X" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="box">
                            <fieldset class="box-fieldset">
                                <label>New Password</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/icon-lock.svg') }}" alt="icon" class="icon">
                                    <input type="password" class="form-control" placeholder="Enter new password" required>
                                </div>
                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label>Confirm Password</label>
                                <div class="ip-field">
                                    <img src="{{ asset('frontend-theme/images/icons/icon-lock.svg') }}" alt="icon" class="icon">
                                    <input type="password" class="form-control" placeholder="Re-enter password" required>
                                </div>
                            </fieldset>
                        </div>
                        <div class="box box-btn">
                            <a href="#modalLogin" data-bs-toggle="modal" class="tf-btn primary w-100 text-center text-white py-2 text-decoration-none">Confirm</a>
                        </div>
                        <div class="text text-center">
                            After resetting your password, you will be redirected to
                            <a href="#modalLogin" data-bs-toggle="modal" data-bs-dismiss="modal" class="text_primary">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Support Widgets -->
    @if(!request()->routeIs('login'))
        @if($settings->contact_phone)
        <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" style="text-decoration:none;">
            <button class="btn-floating phone" title="Call Support">
                <i class="bi bi-telephone-fill" style="font-size:20px;"></i>
                <span>{{ $settings->contact_phone }}</span>
            </button>
        </a>
        @endif

        @if($settings->whatsapp_number)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" style="text-decoration:none;">
            <button class="btn-floating whatsapp" title="WhatsApp Support">
                <i class="bi bi-whatsapp" style="font-size:22px;"></i>
                <span>{{ $settings->whatsapp_number }}</span>
            </button>
        </a>
        @endif

        <!-- Back to top -->
        <button class="backtotop" id="backtotop">
            <span class="border-progress"></span>
            <span class="icon icon-arrow-up"></span>
        </button>
    @endif

    <!-- Javascript -->
    <script src="{{ asset('frontend-theme/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend-theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend-theme/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend-theme/js/swiper.js') }}"></script>
    <script src="{{ asset('frontend-theme/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend-theme/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend-theme/js/wNumb.min.js') }}"></script>
    <script src="{{ asset('frontend-theme/js/fancybox.umd.js') }}"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
    <script>
        $(document).ready(function() {
            if ($(window).width() >= 992) {
                $('.menu-item.dropdown').hover(
                    function() {
                        $(this).addClass('show');
                        $(this).find('.dropdown-toggle').first().attr('aria-expanded', 'true');
                        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(150);
                    },
                    function() {
                        $(this).removeClass('show');
                        $(this).find('.dropdown-toggle').first().attr('aria-expanded', 'false');
                        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
                    }
                );
            }
        });
    </script>
    <script src="{{ asset('frontend-theme/js/main_v2.js') }}"></script>

    @stack('scripts')
</body>

</html>
