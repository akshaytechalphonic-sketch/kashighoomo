@extends('layouts.app')

@section('title', ($sections && isset($sections['about_banner'])) ? ($sections['about_banner']->title . ' | Kashi Tourism') : 'About Us | Kashi Tourism')

@push('styles')
    <style>
        /* ======= PAGE HEADER ======= */
        .about-page-header {
            background: linear-gradient(135deg, #0b1a29 0%, #1a2e42 100%);
            padding: 38px 0 32px;
            margin-top: 82px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .about-page-header::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 180px; height: 180px;
            background: rgba(245,124,0,0.08);
            border-radius: 50%;
        }
        .about-page-header::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -30px;
            width: 220px; height: 220px;
            background: rgba(245,124,0,0.05);
            border-radius: 50%;
        }
        .about-page-header h1 {
            font-size: 1.9rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin-bottom: 6px;
            position: relative; z-index: 1;
        }
        .about-page-header p {
            color: rgba(255,255,255,0.55) !important;
            font-size: 0.88rem !important;
            margin: 0;
            position: relative; z-index: 1;
        }

        /* About content section styling */
        .about-main-section {
            background-color: #ffffff;
            padding: 60px 0;
        }

        .about-image-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #E8E8E8;
        }

        .about-image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.6s ease;
        }

        .about-image-wrapper:hover img {
            transform: scale(1.03);
        }

        .about-title-badge {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #F57C00;
            margin-bottom: 12px;
            display: block;
        }

        .about-heading {
            font-family: 'Poppins', sans-serif;
            font-size: 32px !important;
            font-weight: 800 !important;
            color: #2C2C2C !important;
            line-height: 1.25;
            margin-bottom: 20px;
        }

        .about-desc {
            font-size: 14.5px !important;
            line-height: 1.6 !important;
            color: #555 !important;
            margin-bottom: 30px;
        }

        /* Booking Callout Widget */
        .about-callout-widget {
            background-color: #FFF8F0;
            border-left: 4px solid #F57C00;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
            box-shadow: 0 4px 15px rgba(245, 124, 0, 0.03);
        }

        .callout-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .callout-icon {
            background-color: #ffffff;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F57C00;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            font-size: 18px;
        }

        .callout-title {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .callout-value a {
            font-size: 16px;
            font-weight: 800;
            color: #2C2C2C;
            text-decoration: none;
            transition: 0.2s;
        }

        .callout-value a:hover {
            color: #F57C00;
        }

        /* Mission Vision Cards */
        .mission-vision-section {
            background-color: #F8F9FA;
            padding: 60px 0;
            border-top: 1px solid #E8E8E8;
            border-bottom: 1px solid #E8E8E8;
        }

        .mv-card {
            background: #ffffff;
            border: 1px solid #E8E8E8;
            border-radius: 20px;
            padding: 40px;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            transition: all 0.3s;
        }

        .mv-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(245, 124, 0, 0.05);
            border-color: rgba(245, 124, 0, 0.2);
        }

        .mv-icon-box {
            background-color: #FFF8F0;
            border: 1px solid rgba(245, 124, 0, 0.2);
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F57C00;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .mv-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 20px !important;
            font-weight: 800 !important;
            color: #2C2C2C !important;
            margin-bottom: 14px;
        }

        .mv-card p {
            font-size: 14px !important;
            line-height: 1.55 !important;
            color: #555 !important;
            margin-bottom: 0;
        }

        /* Numbers Section */
        .stats-section {
            background-color: #ffffff;
            padding: 60px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 40px;
        }

        .stat-box {
            background: #FFF8F0;
            border: 1px solid #E8E8E8;
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(245, 124, 0, 0.06);
            border-color: rgba(245, 124, 0, 0.25);
        }

        .stat-box .icon {
            color: #F57C00;
            font-size: 28px;
            margin-bottom: 15px;
            display: block;
        }

        .stat-box h2 {
            font-size: 32px !important;
            font-weight: 800 !important;
            color: #2C2C2C !important;
            margin-bottom: 5px;
            font-family: 'Poppins', sans-serif;
        }

        .stat-box p {
            font-size: 11px !important;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #888 !important;
            margin-bottom: 0;
        }

        /* Mobile adjustments */
        @media (max-width: 991px) {
            .about-page-header {
                margin-top: 76px;
                padding: 30px 0 24px;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 767px) {
            .about-page-header {
                margin-top: 72px;
            }
            .about-page-header h1 {
                font-size: 1.5rem !important;
            }
            .about-main-section, .mission-vision-section, .stats-section {
                padding: 40px 0;
            }
            .about-heading {
                font-size: 24px !important;
            }
            .mv-card {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            .about-callout-widget {
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
            }
            .about-callout-widget .tf-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $aboutBanner = $sections->get('about_banner');
        $aboutTitle = $aboutBanner->title ?? 'About Us';
        $aboutDesc = $aboutBanner->description ?? "Your most trusted local tour operator in Kashi.";
        $aboutBg = ($aboutBanner && !empty($aboutBanner->image)) ? asset('storage/' . $aboutBanner->image) : null;
    @endphp

    <!-- About Page Header Banner -->
    <div class="about-page-header" style="{{ $aboutBg ? "background: linear-gradient(rgba(11, 26, 41, 0.85), rgba(26, 46, 66, 0.9)), url('{$aboutBg}') center/cover no-repeat !important;" : "" }}">
        <div class="container">
            <h1>{{ $aboutTitle }}</h1>
            <p>{!! strip_tags($aboutDesc) !!}</p>
        </div>
    </div>

    <!-- Main About Us Section -->
    @php 
        $mainAbout = $sections['main_about'] ?? null;
    @endphp
    <div class="about-main-section">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Left Side: Image -->
                <div class="col-lg-5 col-md-12">
                    <div class="about-image-wrapper wow animate__animated animate__fadeInLeft" data-wow-duration="1s">
                        <img src="{{ $mainAbout && $mainAbout->image ? asset('storage/'.$mainAbout->image) : asset('frontend-theme/images/backgrounds/bg-about-us.jpg') }}" alt="{{ $mainAbout?->alt_text ?? 'About Kashi Tourism' }}">
                    </div>
                </div>
                <!-- Right Side: Content -->
                <div class="col-lg-7 col-md-12">
                    <div class="wow animate__animated animate__fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                        <span class="about-title-badge">{{ $mainAbout->extra_data['sub_title'] ?? 'Discover Varanasi & Beyond' }}</span>
                        <h2 class="about-heading">{{ $mainAbout->title ?? 'Pioneering Luxury Kashi Yatra Hospitality' }}</h2>
                        <div class="about-desc">
                            {!! $mainAbout->description ?? 'Kashi Tourism was founded with the passion of sharing our homeland\'s raw beauty and rich spiritual heritage with the world. We design customized tours that blend raw Kashi culture with premium comfort and absolute safety.' !!}
                        </div>
                    </div>
                    
                    @if($settings->contact_phone)
                        <!-- Callout Widget -->
                        <div class="about-callout-widget wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            <div class="callout-info">
                                <div class="callout-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div>
                                    <div class="callout-title">Booking Number</div>
                                    <div class="callout-value">
                                        <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}">{{ $settings->contact_phone }}</a>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('packages.index') }}" class="tf-btn primary hover-1 px-4 py-2.5 rounded-pill text-white text-decoration-none">
                                Book Now
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Mission & Vision Section -->
    @php
        $ourMission = $sections['our_misson'] ?? null;
        $ourVision = $sections['our_vison'] ?? null;
    @endphp
    <div class="mission-vision-section">
        <div class="container">
            <div class="row g-4">
                <!-- Mission Card -->
                <div class="col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.1s">
                    <div class="mv-card">
                        <div class="mv-icon-box">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h3>{{ $ourMission->title ?? 'Our Mission' }}</h3>
                        <p>
                            @if($ourMission && $ourMission->description)
                                {!! strip_tags($ourMission->description) !!}
                            @else
                                To provide world-class spiritual travel services that ensure every guest experiences unmatched comfort, spiritual satisfaction, and creates lifelong memories.
                            @endif
                        </p>
                    </div>
                </div>
                <!-- Vision Card -->
                <div class="col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                    <div class="mv-card">
                        <div class="mv-icon-box">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h3>{{ $ourVision->title ?? 'Our Vision' }}</h3>
                        <p>
                            @if($ourVision && $ourVision->description)
                                {!! strip_tags($ourVision->description) !!}
                            @else
                                To become the benchmark for excellence in spiritual tourism, recognized for our commitment to quality, personalized service, and authentic local experiences.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container text-center">
            <div class="wow animate__animated animate__fadeInUp" style="max-width: 600px; margin: 0 auto;">
                <span class="about-title-badge">Kashi Tourism By The Numbers</span>
                <h2 class="fw-bold font-family-poppins text-dark" style="font-size: 28px !important;">Delivering Excellence &amp; Comfort</h2>
                <p class="text-muted mt-2 small" style="line-height: 1.4;">Read the numbers reflecting our dedication to providing exceptional travel and hospitality services in Varanasi.</p>
            </div>
            
            <div class="stats-grid">
                @php
                    $stats = $sections['stats']->extra_data ?? [
                        ['value' => '15K+', 'label' => 'Happy Guests', 'icon' => 'people-fill'],
                        ['value' => '120+', 'label' => 'Suites / Hotels', 'icon' => 'house-heart-fill'],
                        ['value' => '15+', 'label' => 'Custom Routes', 'icon' => 'map-fill'],
                        ['value' => '24/7', 'label' => 'Pilgrim Support', 'icon' => 'chat-quote-fill']
                    ];
                @endphp
                @foreach($stats as $stat)
                <div class="stat-box wow animate__animated animate__fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                    <span class="icon">
                        <i class="bi bi-{{ $stat['icon'] ?? 'star-fill' }}"></i>
                    </span>
                    <h2>{{ $stat['value'] }}</h2>
                    <p>{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
