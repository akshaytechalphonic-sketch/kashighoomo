@extends('layouts.app')

@push('styles')
    <style>
        /* Premium CSS Theme & Layout Overrides */
        :root {
            --vk-saffron: #F57C00;
            --vk-saffron-dark: #E65100;
            --vk-saffron-glow: rgba(245, 124, 0, 0.18);
            --vk-crimson: #8B1E1E;
            --vk-gold: #D4AF37;
            --vk-navy: #051421;
            --vk-light-warm: #FFF8F0;
            --vk-light-gray: #FAFAFA;
            --vk-card-border: rgba(245, 124, 0, 0.08);
            --vk-shadow-sm: 0 4px 15px rgba(6, 22, 36, 0.03);
            --vk-shadow-md: 0 10px 30px rgba(6, 22, 36, 0.06);
            --vk-shadow-lg: 0 16px 48px rgba(6, 22, 36, 0.1);
            --vk-ease-out: cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        /* Hero Slide Improvements */
        .heroSwiper,
        .hero-slide-visitkashi {
            background: linear-gradient(135deg, #0a1b29 0%, #051421 55%, #2a1b12 100%);
            position: relative;
            width: 100%;
            height: 440px !important;
            min-height: 440px !important;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .heroSwiper .swiper-wrapper {
            height: 100% !important;
        }

        .hero-slide-visitkashi::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(245, 124, 0, 0.04) 1.5px, transparent 1.5px);
            background-size: 20px 20px;
            opacity: 0.8;
            z-index: 1;
            pointer-events: none;
        }

        .hero-content-left {
            width: 50%;
            height: 100%;
            padding: 60px 40px 15px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            z-index: 10;
            margin-top: 0;
        }

        .custom-hero-badge {
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: var(--vk-gold);
            border: 1.5px solid rgba(212, 175, 55, 0.45);
            padding: 7px 18px;
            border-radius: 50px;
            background: rgba(212, 175, 55, 0.12);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
            align-self: flex-start;
            box-shadow: 0 4px 15px rgba(245, 124, 0, 0.06);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .feature-icon-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(245, 124, 0, 0.15) !important;
            border: 1px solid rgba(245, 124, 0, 0.3) !important;
            color: var(--vk-saffron) !important;
            font-size: 13px;
            box-shadow: 0 4px 10px rgba(245, 124, 0, 0.1);
        }

        /* Hero features grid system */
        .hero-features-grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 10px 18px !important;
            margin-bottom: 18px !important;
            width: 100% !important;
            max-width: 420px;
        }
        .hero-feature-item {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .hero-media-right {
            position: absolute;
            top: 60px;
            right: 0;
            width: 50%;
            height: calc(100% - 60px);
            border-left: 6px solid var(--vk-saffron);
            border-top-left-radius: 460px 50%;
            border-bottom-left-radius: 460px 50%;
            overflow: hidden;
            z-index: 5;
            box-shadow: -15px 0 35px rgba(245, 124, 0, 0.12);
        }

        .hero-mobile-title-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 50px 16px 12px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.35) 60%, transparent 100%);
            color: #ffffff !important;
            font-size: 17px;
            font-weight: 800;
            text-align: center;
            line-height: 1.25;
            z-index: 10;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.9);
            letter-spacing: -0.3px;
        }

        .hero-overlapping-circle {
            position: absolute;
            bottom: 85px;
            left: 47%;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 5px solid #051421;
            outline: 3px solid var(--vk-gold);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            z-index: 15;
            animation: floatAnimation 6s ease-in-out infinite;
        }

        @keyframes floatAnimation {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* Premium Search Filter Bar Overrides */
        .form-s1 {
            margin-top: -65px;
            position: relative;
            z-index: 99;
        }

        .form-search.transparent.style-2 {
            background: rgba(255, 255, 255, 0.96) !important;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(245, 124, 0, 0.15) !important;
            box-shadow: 0 15px 40px rgba(6, 22, 36, 0.12) !important;
            border-radius: 20px !important;
            padding: 15px 25px !important;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .form-search.transparent.style-2 .inner-group {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
            width: auto;
        }

        .form-search.transparent.style-2 .form-group {
            flex: 1;
            border-right: 1px solid #eee;
            padding-right: 20px;
            margin-bottom: 0 !important;
        }

        .form-search.transparent.style-2 .form-group:last-child {
            border-right: none;
            padding-right: 0;
        }

        .form-search.transparent.style-2 label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            margin-bottom: 4px;
            display: block;
        }

        .form-search.transparent.style-2 .group-select .select-items .current {
            font-size: 14px;
            font-weight: 600;
            color: var(--vk-navy);
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .form-search.transparent.style-2 .box-btn-filter button {
            background: linear-gradient(135deg, var(--vk-saffron) 0%, var(--vk-saffron-dark) 100%) !important;
            color: white !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            padding: 14px 32px !important;
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 8px 20px var(--vk-saffron-glow) !important;
            transition: all 0.3s var(--vk-ease-out) !important;
            height: 52px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .form-search.transparent.style-2 .box-btn-filter button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px var(--vk-saffron-glow) !important;
        }

        /* Circular Categories Deck */
        .circular-categories {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 28px;
            padding: 30px 10px 15px;
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: none;
        }

        .circular-categories::-webkit-scrollbar {
            display: none;
        }

        .category-circle-item {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s var(--vk-ease-out);
            min-width: 105px;
        }

        .category-circle-icon {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(6, 22, 36, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--vk-saffron);
            font-size: 24px;
            transition: all 0.4s var(--vk-ease-out);
            border: 2px solid rgba(245, 124, 0, 0.08);
            overflow: hidden;
        }

        .category-circle-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.4s var(--vk-ease-out);
        }

        .category-circle-item:hover .category-circle-icon {
            border-color: var(--vk-saffron);
            transform: translateY(-8px) scale(1.08);
            box-shadow: 0 12px 24px var(--vk-saffron-glow);
        }

        .category-circle-item:hover .category-circle-icon img {
            transform: scale(1.1);
        }

        .category-circle-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--vk-navy);
            margin-top: 10px;
            text-align: center;
            transition: color 0.3s;
            white-space: normal;
            max-width: 95px;
            line-height: 1.3;
        }

        .category-circle-item:hover .category-circle-title {
            color: var(--vk-saffron);
        }

        /* ===== Compact Airbnb-Style Package Cards ===== */
        .pkg-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            border: none;
            box-shadow: none;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pkg-card:hover {
            transform: translateY(-4px);
        }

        .pkg-card-img {
            position: relative;
            height: 180px;
            border-radius: 14px;
            overflow: hidden;
        }

        .pkg-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pkg-card:hover .pkg-card-img img {
            transform: scale(1.05);
        }

        .pkg-badge-level {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 3;
            background: #ffffff;
            color: #1a1a2e;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }

        .pkg-card-wishlist {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 3;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(4px);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .pkg-card-wishlist:hover {
            background: #ffffff;
            color: #E53935;
            transform: scale(1.15);
        }

        .pkg-card-body {
            padding: 12px 4px 8px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .pkg-card-title {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e !important;
            margin-bottom: 6px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .pkg-card-title a {
            color: inherit !important;
            text-decoration: none;
        }

        .pkg-card-title a:hover {
            color: #F57C00 !important;
        }

        .pkg-card-priceline {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: auto;
        }

        .pkg-card-priceline .pkg-mrp {
            font-size: 13px;
            color: #999;
            text-decoration: line-through;
            font-weight: 500;
        }

        .pkg-card-priceline .pkg-price {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #E53935 !important;
        }

        .pkg-card-priceline .pkg-per {
            font-size: 12px;
            color: #888;
            font-weight: 400;
        }

        .pkg-card-priceline .pkg-dot {
            color: #ccc;
            font-size: 4px;
        }

        .pkg-card-priceline .pkg-rating {
            font-size: 12px;
            color: #1a1a2e;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .pkg-card-priceline .pkg-rating i {
            font-size: 10px;
            color: #1a1a2e;
        }

        /* Package cards mobile: 2-column grid */
        @media (max-width: 767px) {
            .pkg-scroll-row {
                display: flex;
                flex-wrap: wrap;
            }

            .pkg-scroll-row .pkg-scroll-item {
                flex: 0 0 auto;
            }

            .pkg-card-img {
                height: 140px;
            }

            .pkg-card-body {
                padding: 8px 2px 6px;
            }

            .pkg-card-title {
                font-size: 12px;
                margin-bottom: 4px;
                -webkit-line-clamp: 2;
            }

            .pkg-card-priceline {
                gap: 4px;
            }

            .pkg-card-priceline .pkg-mrp {
                font-size: 11px;
            }

            .pkg-card-priceline .pkg-price {
                font-size: 13px;
            }

            .pkg-card-priceline .pkg-per {
                font-size: 10px;
            }

            .pkg-card-priceline .pkg-dot {
                display: none;
            }

            .pkg-card-priceline .pkg-rating {
                font-size: 10px;
            }

            .pkg-badge-level {
                font-size: 8px;
                padding: 3px 7px;
            }

            .pkg-card-wishlist {
                width: 26px;
                height: 26px;
                font-size: 12px;
            }
        }

        @media (max-width: 400px) {
            .pkg-card-img {
                height: 120px;
            }

            .pkg-card-title {
                font-size: 11px;
            }
        }

        /* Stay & Tour Promo Banner */
        .promo-banner-kashi {
            background: linear-gradient(135deg, rgba(245, 124, 0, 0.92) 0%, rgba(5, 20, 33, 0.98) 100%),
                url('https://images.unsplash.com/photo-1561361513-2d000a50f0db?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat;
            border-radius: 20px;
            padding: 35px 35px 45px 35px;
            color: #ffffff;
            box-shadow: 0 15px 35px rgba(245, 124, 0, 0.15);
            margin: 45px 0;
            border: 1px solid rgba(255, 255, 255, 0.12);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            position: relative;
            overflow: hidden;
        }

        .promo-banner-kashi:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 20px 45px rgba(245, 124, 0, 0.18) !important;
        }

        .tour-promo-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 18px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
        }

        .tour-promo-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.12);
            border-color: #D4AF37; /* Gold accent */
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.15);
        }

        .tour-promo-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #F57C00 0%, #D4AF37 100%);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 30px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            color: #ffffff !important;
        }

        .tour-promo-title {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin-top: 10px;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .tour-promo-duration {
            font-size: 11.5px;
            color: #D4AF37;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .tour-promo-desc {
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.45;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .tour-promo-actions {
            display: flex;
            gap: 8px;
        }

        .tour-promo-btn-itinerary {
            flex: 1;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 8px 10px;
            border-radius: 6px;
            text-align: center;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .tour-promo-btn-itinerary:hover {
            background: #ffffff;
            color: #051421 !important;
            border-color: #ffffff;
        }

        .tour-promo-btn-book {
            flex: 1.2;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #ffffff !important;
            background: #25D366; /* WhatsApp Green */
            border: 1px solid #25D366;
            padding: 8px 10px;
            border-radius: 6px;
            text-align: center;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            box-shadow: 0 4px 10px rgba(37, 211, 102, 0.2);
            text-decoration: none !important;
        }

        .tour-promo-btn-book:hover {
            background: #128C7E;
            border-color: #128C7E;
            color: #ffffff !important;
            box-shadow: 0 6px 15px rgba(37, 211, 102, 0.35);
            transform: translateY(-1px);
        }

        /* Timeline in modal */
        .timeline-wrapper {
            margin-top: 15px;
        }
        .timeline-item {
            padding-bottom: 5px;
        }
        .timeline-dot {
            z-index: 2;
            box-shadow: 0 0 0 4px #ffffff;
        }

        /* Modal z-index overrides to stack on top of header */
        .modal {
            z-index: 999999 !important;
        }
        .modal-backdrop {
            z-index: 999998 !important;
        }

        /* Mobile Responsive adjustments for Tour Promo Banner */
        @media (max-width: 576px) {
            .promo-banner-kashi {
                padding: 25px 15px 35px 15px !important;
            }
            .tour-promo-card {
                padding: 15px !important;
            }
            .tour-promo-title {
                font-size: 14px !important;
            }
            .tour-promo-desc {
                font-size: 12px !important;
                margin-bottom: 12px !important;
            }
            .tour-promo-actions {
                flex-direction: column !important;
                gap: 8px !important;
            }
            .tour-promo-btn-itinerary,
            .tour-promo-btn-book {
                flex: none !important;
                width: 100% !important;
                padding: 8px 10px !important;
                font-size: 10.5px !important;
                border-radius: 6px !important;
            }
        }

        /* Perfect Trip Service Cards */
        .perfect-trip-card {
            background: #ffffff;
            border: 1px solid #E8E8E8;
            border-radius: 20px;
            padding: 35px 25px;
            text-align: center;
            transition: all 0.4s var(--vk-ease-out);
            height: 100%;
            box-shadow: var(--vk-shadow-sm);
        }

        .perfect-trip-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--vk-shadow-lg);
            border-color: rgba(245, 124, 0, 0.25);
        }

        .perfect-trip-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--vk-light-warm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--vk-saffron);
            font-size: 24px;
            margin: 0 auto 20px;
            transition: all 0.4s var(--vk-ease-out);
            border: 1px solid rgba(245, 124, 0, 0.1);
        }

        .perfect-trip-card:hover .perfect-trip-icon {
            background: var(--vk-saffron);
            color: #ffffff;
            transform: scale(1.08);
            box-shadow: 0 8px 20px var(--vk-saffron-glow);
        }

        .perfect-trip-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--vk-navy);
            margin-bottom: 12px;
        }

        .perfect-trip-desc {
            font-size: 13px;
            color: #666 !important;
            line-height: 1.5;
        }

        /* Yacht Promo Banner */
        .promo-banner-yacht {
            background: linear-gradient(135deg, rgba(5, 20, 33, 0.95) 0%, rgba(232, 144, 10, 0.88) 100%),
                url('https://images.unsplash.com/photo-1608958416715-df6c1c8aef43?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat;
            border-radius: 20px;
            padding: 45px 50px;
            color: #ffffff;
            margin: 40px 0;
            box-shadow: var(--vk-shadow-lg);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 25px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Dynamic Title Styling Inside Hero */
        .hero-dynamic-title span {
            color: var(--vk-saffron);
        }

        /* Swiper Arrows Style */
        .flex-direction-nav .style-nav-1 {
            width: 48px !important;
            height: 48px !important;
            background: #ffffff !important;
            border-radius: 50% !important;
            box-shadow: var(--vk-shadow-md) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s ease !important;
            z-index: 99 !important;
            border: 1px solid rgba(245, 124, 0, 0.1);
        }

        .flex-direction-nav .style-nav-1:hover {
            background: var(--vk-crimson) !important;
            color: #ffffff !important;
            transform: scale(1.08);
            border-color: var(--vk-crimson);
            box-shadow: 0 8px 20px rgba(139, 30, 30, 0.3) !important;
        }

        /* Premium Section Title styling */
        .box-title span {
            font-size: 11px !important;
            font-weight: 800 !important;
            letter-spacing: 2px !important;
            color: var(--vk-saffron) !important;
            display: inline-block;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .box-title h2 {
            font-size: 32px !important;
            font-weight: 800 !important;
            color: rgb(33 37 40) !important;
            letter-spacing: -0.5px;
        }

        /* Grid layout for 5 items */
        @media (min-width: 992px) {
            .col-lg-2-5 {
                width: 20%;
                flex: 0 0 20%;
            }
        }

        /* Bottom CTA styling */
        .bottom-cta-triangle {
            background: linear-gradient(135deg, rgba(5, 20, 33, 0.9) 0%, rgba(139, 30, 30, 0.92) 100%),
                var(--cta-bg-image, url('https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=1920')) center/cover no-repeat;
            padding: 80px 0;
            color: #ffffff;
            text-align: center;
            margin-top: 60px;
            border-top: 4px solid var(--vk-saffron);
        }

        .bottom-cta-triangle h2 {
            font-size: 36px;
            font-weight: 800;
            color: #ffffff !important;
            margin-bottom: 12px;
        }

        .bottom-cta-triangle p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8) !important;
            margin-bottom: 35px;
        }

        /* SEO block style */
        .seo-content-box {
            background: #ffffff;
            border: 1px solid #E8E8E8;
            border-radius: 20px;
            padding: 45px;
            margin-top: 50px;
            box-shadow: var(--vk-shadow-sm);
        }

        .seo-content-box h3 {
            font-size: 18px;
            font-weight: 800;
            color: var(--vk-navy) !important;
            margin-top: 30px;
            margin-bottom: 12px;
            font-family: 'Poppins', sans-serif;
            border-bottom: 2px solid var(--vk-saffron-glow);
            padding-bottom: 6px;
            display: inline-block;
        }

        .seo-content-box h3:first-of-type {
            margin-top: 0;
        }

        .seo-content-box p {
            font-size: 13.5px;
            color: #555 !important;
            line-height: 1.7 !important;
            margin-bottom: 18px;
        }

        /* Testimonials Section Styles */
        .testimonial-card-premium {
            background: #ffffff;
            border: 1px solid #E8E8E8;
            border-radius: 20px;
            padding: 35px;
            box-shadow: var(--vk-shadow-sm);
            transition: all 0.4s var(--vk-ease-out);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .testimonial-card-premium:hover {
            transform: translateY(-6px);
            box-shadow: var(--vk-shadow-lg);
            border-color: rgba(245, 124, 0, 0.2);
        }

        .testimonial-card-premium::before {
            content: "\201C";
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 90px;
            font-family: Georgia, serif;
            color: rgba(245, 124, 0, 0.08);
            line-height: 1;
        }

        .testimonial-feedback {
            font-size: 14px;
            line-height: 1.6;
            color: #555 !important;
            font-style: italic;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
            flex-grow: 1;
        }

        .testimonial-user {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-top: 15px;
        }

        .testimonial-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--vk-saffron);
        }

        .testimonial-info h4 {
            font-size: 14px;
            font-weight: 700;
            color: var(--vk-navy);
            margin: 0;
        }

        .testimonial-info p {
            font-size: 11px;
            color: #888 !important;
            margin: 0 !important;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Swiper overrides for pagination/nav */
        .swiper-pagination-bullet-active {
            background: var(--vk-saffron) !important;
        }

        /* Responsiveness Overrides */
        @media (max-width: 991px) {
            .heroSwiper,
            .heroSwiper .swiper-wrapper,
            .heroSwiper .swiper-slide,
            .hero-slide-visitkashi {
                height: auto !important;
                min-height: auto !important;
            }

            .hero-slide-visitkashi {
                flex-direction: column;
                height: auto !important;
                min-height: auto !important;
                padding-bottom: 25px;
            }

            .hero-content-left {
                width: 100%;
                height: auto !important;
                min-height: auto !important;
                padding: 20px 20px 15px !important;
                text-align: center;
                margin-top: 0 !important;
                order: 2;
                /* text goes BELOW the image */
            }

            .hero-content-left .hero-dynamic-title,
            .hero-content-left .text-white-50 {
                display: none !important;
            }

            .custom-hero-badge {
                align-self: center;
            }

            .hero-media-right {
                position: relative;
                top: 0 !important;
                margin-top: 70px !important;
                width: 100%;
                height: 340px;
                border-left: 0;
                border-top: none;
                border-bottom: none;
                border-radius: 0;
                order: 1;
                overflow: hidden;
                /* image goes ON TOP */
            }

            .hero-button-prev,
            .hero-button-next {
                top: 135px !important;
                transform: translateY(-50%) !important;
                width: 36px !important;
                height: 36px !important;
                background: rgba(0, 0, 0, 0.55) !important;
                border: 1px solid rgba(255, 255, 255, 0.35) !important;
                color: #ffffff !important;
                z-index: 25 !important;
            }

            .hero-button-prev {
                left: 10px !important;
            }

            .hero-button-next {
                right: 10px !important;
            }

            .hero-button-prev:after,
            .hero-button-next:after {
                font-size: 13px !important;
            }

            /* align feature icons grid on tablet */
            .hero-features-grid {
                max-width: 380px !important;
                margin: 0 auto 20px !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .hero-overlapping-circle {
                display: none;
            }

            .form-s1 {
                margin-top: 0;
                padding: 20px 0;
            }

            .form-search.transparent.style-2 {
                border-radius: 16px !important;
                padding: 20px !important;
            }

            .form-search.transparent.style-2 .inner-group {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
            }

            .form-search.transparent.style-2 .form-group {
                border-right: none;
                padding-right: 0;
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
            }

            .form-search.transparent.style-2 .box-btn-filter {
                width: 100%;
            }

            .form-search.transparent.style-2 .box-btn-filter button {
                width: 100% !important;
            }

            .promo-banner-kashi,
            .promo-banner-yacht {
                padding: 25px 20px;
                text-align: center;
                justify-content: center;
                border-radius: 14px;
            }

            .promo-banner-text {
                width: 100%;
            }

            .promo-banner-text h2 {
                font-size: 20px !important;
            }

            .promo-banner-action {
                justify-content: center;
                width: 100%;
            }

            .promo-banner-action a {
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            .seo-content-box {
                padding: 20px;
            }

            /* Hero banner mobile */
            .hero-slide-visitkashi {
                min-height: auto !important;
            }

            .hero-dynamic-title {
                font-size: 24px !important;
                line-height: 1.3 !important;
            }

            /* Removed duplicate styling rule */

            /* Cleaned up redundant styles */

            /* Circle destinations row */
            .circular-categories {
                gap: 12px;
                padding: 10px 0;
            }

            .category-circle-icon {
                width: 62px;
                height: 62px;
            }

            .category-circle-title {
                font-size: 10px;
                max-width: 70px;
            }

            /* Section headings */
            .box-title .h1 {
                font-size: 22px !important;
            }

            .box-title .desc {
                font-size: 13px !important;
            }

            /* Perfect trip cards */
            .perfect-trip-card {
                padding: 16px !important;
            }

            /* Boat/cab cards */
            .accommodation-card-premium,
            .cab-card-premium {
                margin-bottom: 0 !important;
            }

            /* Button sizing */
            .tf-btn.primary {
                font-size: 12px !important;
                padding: 10px 20px !important;
            }
        }

        /* Small phone adjustments */
        @media (max-width: 575px) {
            .hero-dynamic-title {
                font-size: 20px !important;
            }

            .hero-content-left {
                padding: 35px 14px 18px !important;
                height: auto !important;
            }

            .hero-media-right {
                height: 220px !important;
            }

            .custom-hero-badge {
                font-size: 10px !important;
                padding: 5px 12px !important;
            }

            .button-group .tf-btn {
                width: 100%;
                text-align: center;
                justify-content: center;
                font-size: 12px !important;
            }

            /* features inherit left alignment from tablet */

            .circular-categories {
                gap: 8px;
            }

            .category-circle-icon {
                width: 54px;
                height: 54px;
            }

            .category-circle-title {
                font-size: 9px;
                max-width: 58px;
                margin-top: 6px;
            }

            .promo-banner-text h2 {
                font-size: 18px !important;
            }

            .promo-banner-text p {
                font-size: 12px !important;
            }

            .box-title .h1 {
                font-size: 20px !important;
            }

            .hero-button-prev,
            .hero-button-next {
                top: 85px !important;
                width: 32px !important;
                height: 32px !important;
                background: rgba(0, 0, 0, 0.6) !important;
            }

            .hero-button-prev {
                left: 8px !important;
            }

            .hero-button-next {
                right: 8px !important;
            }

            .hero-button-prev:after,
            .hero-button-next:after {
                font-size: 11px !important;
            }
        }

        /* Hero Swiper premium navigation & pagination styling */
        .hero-button-prev, .hero-button-next {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            width: 44px !important;
            height: 44px !important;
            border-radius: 50% !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .hero-button-prev:after, .hero-button-next:after {
            font-size: 14px !important;
            font-weight: 800 !important;
            color: #ffffff !important;
        }
        .hero-button-prev:hover, .hero-button-next:hover {
            background: var(--vk-saffron) !important;
            border-color: var(--vk-saffron) !important;
            transform: scale(1.08);
            box-shadow: 0 8px 20px var(--vk-saffron-glow) !important;
        }
        .hero-pagination {
            position: absolute !important;
            bottom: 25px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            z-index: 20 !important;
            display: flex !important;
            gap: 6px !important;
            justify-content: center !important;
        }
        .hero-pagination .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.4) !important;
            opacity: 1 !important;
            width: 8px !important;
            height: 8px !important;
            transition: all 0.3s var(--vk-ease-out) !important;
            margin: 0 !important;
        }
        .hero-pagination .swiper-pagination-bullet-active {
            background: var(--vk-saffron) !important;
            width: 20px !important;
            border-radius: 4px !important;
        }
    </style>
@endpush

@section('content')
    @php
        $heroSection  = $sections->get('hero');
        $heroTitle    = $heroSection?->title       ?: 'Experience Divine Kashi';
        $heroDesc     = $heroSection?->description ?: 'Witness the grand evening ritual on the banks of the sacred Ganges. Book private boats, comfortable hotel stays, and custom local cabs for a seamless spiritual journey.';
        $heroImage    = $heroSection?->image        ? asset('storage/' . $heroSection->image) : asset('frontend-theme/images/banner/kashi_hero_banner.png');

        $ctaSection   = $sections->get('why_choose_us');
        $ctaTitle     = $ctaSection?->title       ?: 'Book Your Kashi Prayagraj Ayodhya Package';
        $ctaDesc      = $ctaSection?->description ?: 'Ready to experience the spiritual triangle? Get customized yatra packages matching your budget.';
        $ctaBgImage   = $ctaSection?->image        ? asset('storage/' . $ctaSection->image) : 'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=1920';
    @endphp

    <!-- 1. Hero Banner Slider -->
    <div class="hero swiper heroSwiper position-relative" style="overflow: hidden;">
        <div class="swiper-wrapper">
            @forelse($banners as $banner)
                <div class="swiper-slide hero-slide-visitkashi">
                    <!-- Left Content -->
                    <div class="hero-content-left text-white">
                        @if($banner->title)
                            <div class="mb-3 h1 font-family-poppins fw-extrabold hero-dynamic-title"
                                style="font-size: 30px; line-height: 1.25; font-weight: 800; letter-spacing: -0.5px; color: #ffffff !important;">
                                <span style="color: #fff;">{{ $banner->title }}</span>
                            </div>
                        @endif
                        @if($banner->subtitle)
                            <div class="mb-3 text-white-50"
                                style="font-size: 13.5px; line-height: 1.5; max-width: 480px; margin-bottom: 14px; color: rgba(255,255,255,0.75) !important;">
                                {{ $banner->subtitle }}
                            </div>
                        @endif
                        <div class="hero-features-grid">
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-patch-check-fill"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Private Boats</span>
                            </div>
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-brightness-high"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Ganga Aarti Pooja</span>
                            </div>
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-building"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Hotel Stays</span>
                            </div>
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-patch-check-fill"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Local Experts</span>
                            </div>
                        </div>
                        <div class="button-group mb-4">
                            @if($banner->button_link)
                                <a href="{{ $banner->button_link }}"
                                    class="tf-btn primary hover-1 px-5 py-3 rounded-pill fw-bold text-white text-decoration-none"
                                    style="font-size: 13.5px;">{{ $banner->button_text ?: 'Book Yatra Now' }}</a>
                            @elseif(str_contains(strtolower($banner->title ?? ''), 'diwali'))
                                <a href="{{ url('/book-dev-diwali-boat-rides') }}"
                                    class="tf-btn primary hover-1 px-5 py-3 rounded-pill fw-bold text-white text-decoration-none"
                                    style="font-size: 13.5px;">{{ $banner->button_text ?: 'Book Yatra Now' }}</a>
                            @else
                                <a href="{{ route('packages.show', 'book-kashi-prayagraj-ayodhya-tour-package-3-nights-4-days') }}"
                                    class="tf-btn primary hover-1 px-5 py-3 rounded-pill fw-bold text-white text-decoration-none"
                                    style="font-size: 13.5px;">Book Yatra Now</a>
                            @endif
                        </div>
                        <div class="d-flex align-items-center text-white-50 border-top pt-3"
                            style="font-size: 11.5px; border-color: rgba(255,255,255,0.1) !important;">
                            <i class="bi bi-patch-check-fill me-2 fs-6" style="color: #D4AF37;"></i>
                            <span>{{ $settings->site_name ?? 'Mahadev Yatra' }} | Most Trusted Travel Partner Since 2018</span>
                        </div>
                    </div>
                    <!-- Right Curved Media Area (dynamic image) -->
                    <div class="hero-media-right">
                        <img src="{{ asset('storage/' . $banner->image) }}"
                            alt="{{ $banner->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @if($banner->title)
                            <div class="hero-mobile-title-overlay d-lg-none">
                                {{ $banner->title }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Fallback to current static home banner from sections database if no records exist -->
                <div class="swiper-slide hero-slide-visitkashi">
                    <!-- Left Content -->
                    <div class="hero-content-left text-white">
                        <div class="mb-3 h1 font-family-poppins fw-extrabold hero-dynamic-title"
                            style="font-size: 30px; line-height: 1.25; font-weight: 800; letter-spacing: -0.5px; color: #ffffff !important;">
                            <span style="color: #fff;">{{ $sections['home_banner']->title ?? 'Experience Divine Kashi' }}</span>
                        </div>
                        @if(isset($sections['home_banner']))
                            <div class="mb-3 text-white-50"
                                style="font-size: 13.5px; line-height: 1.5; max-width: 480px; margin-bottom: 14px; color: rgba(255,255,255,0.75) !important;">
                                {!! $sections['home_banner']->description !!}
                            </div>
                        @endif
                        <div class="hero-features-grid">
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-patch-check-fill"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Private Boats</span>
                            </div>
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-brightness-high"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Ganga Aarti Pooja</span>
                            </div>
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-building"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Hotel Stays</span>
                            </div>
                            <div class="hero-feature-item">
                                <div class="feature-icon-box"><i class="bi bi-patch-check-fill"></i></div>
                                <span class="fw-bold" style="font-size: 13px; color: #ffffff !important;">Local Experts</span>
                            </div>
                        </div>
                        <div class="button-group mb-4">
                            <a href="{{ route('packages.show', 'book-kashi-prayagraj-ayodhya-tour-package-3-nights-4-days') }}"
                                class="tf-btn primary hover-1 px-5 py-3 rounded-pill fw-bold text-white text-decoration-none"
                                style="font-size: 13.5px;">Book Yatra Now</a>
                        </div>
                        <div class="d-flex align-items-center text-white-50 border-top pt-3"
                            style="font-size: 11.5px; border-color: rgba(255,255,255,0.1) !important;">
                            <i class="bi bi-patch-check-fill me-2 fs-6" style="color: #D4AF37;"></i>
                            <span>{{ $settings->site_name ?? 'Mahadev Yatra' }} | Most Trusted Travel Partner Since 2018</span>
                        </div>
                    </div>
                    <!-- Right Curved Media Area (dynamic image) -->
                    <div class="hero-media-right">
                        <img src="{{ $heroImage }}"
                            alt="{{ $heroTitle }}" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="hero-mobile-title-overlay d-lg-none">
                            {{ $sections['home_banner']->title ?? 'Experience Divine Kashi' }}
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Swiper Navigation & Pagination elements -->
        @if($banners->count() > 1)
            <div class="swiper-pagination hero-pagination"></div>
            <div class="swiper-button-prev hero-button-prev"></div>
            <div class="swiper-button-next hero-button-next"></div>
        @endif
    </div>


    <div class="container">
        <!-- 2. Destination Circle Icons (Dynamic from DB) -->
        <div class="circular-categories">
            @foreach ($destinations as $dest)
                <a href="{{ route('destinations.show', $dest->slug) }}" class="category-circle-item">
                    <div class="category-circle-icon">
                        <img src="{{ $dest->image ? asset('storage/' . $dest->image) : 'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=200' }}"
                            alt="{{ $dest->name }}">
                    </div>
                    <div class="category-circle-title">{{ $dest->name }}</div>
                </a>
            @endforeach
        </div>

        <!-- 3. Ad Banner 1: Tour Packages Highlight -->
        <div class="promo-banner-kashi wow animate__animated animate__fadeIn">
            <div class="row align-items-center mb-4 w-100">
                <div class="col-12 text-center text-md-start">
                    <span class="text-warning text-uppercase fw-bold" style="font-size:11px; letter-spacing:2px; color: #D4AF37 !important;">Spiritual Journeys</span>
                    <h2 class="text-white fw-extrabold mt-1 mb-2" style="font-size: 32px; font-weight: 800; text-shadow: 0 2px 10px rgba(0,0,0,0.25);">Exclusive Tour Packages</h2>
                    <p class="text-white-50 mb-0" style="font-size:14.5px;">Embark on a sacred yatra with our expertly crafted itineraries. Book now on WhatsApp for instant confirmation.</p>
                </div>
            </div>
            
            <div class="row g-4 w-100">
                <!-- Package 1 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="tour-promo-card">
                        <span class="tour-promo-badge">Popular</span>
                        <div class="tour-card-content mt-3">
                            <h3 class="tour-promo-title">KASHI TOUR</h3>
                            <div class="tour-promo-duration">
                                <i class="bi bi-clock-fill"></i> 2 N 3D
                            </div>
                            <p class="tour-promo-desc">Explore ancient ghats, witness grand evening Ganga Aarti, and visit Kashi Vishwanath corridors.</p>
                        </div>
                        <div class="tour-promo-actions">
                            <button type="button" class="tour-promo-btn-itinerary" data-bs-toggle="modal" data-bs-target="#itineraryKashiTour">
                                <i class="bi bi-file-text"></i> Itinerary
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the KASHI TOUR (2 N 3D) package. Please provide more information.') }}" target="_blank" class="tour-promo-btn-book">
                                <i class="bi bi-whatsapp"></i> Book Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Package 2 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="tour-promo-card">
                        <span class="tour-promo-badge">Spiritual</span>
                        <div class="tour-card-content mt-3">
                            <h3 class="tour-promo-title" style="font-size: 16.5px;">Kashi Prayagraj & Ayodhya Tour</h3>
                            <div class="tour-promo-duration">
                                <i class="bi bi-clock-fill"></i> 3N 4D
                            </div>
                            <p class="tour-promo-desc">A sacred journey covering Kashi Vishwanath temple, Triveni Sangam in Prayagraj, and Ram Mandir in Ayodhya.</p>
                        </div>
                        <div class="tour-promo-actions">
                            <button type="button" class="tour-promo-btn-itinerary" data-bs-toggle="modal" data-bs-target="#itineraryKashiPrayagrajAyodhya">
                                <i class="bi bi-file-text"></i> Itinerary
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the Kashi Prayagraj & Ayodhya Spiritual Tour (3N 4D) package. Please provide more information.') }}" target="_blank" class="tour-promo-btn-book">
                                <i class="bi bi-whatsapp"></i> Book Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="tour-promo-card">
                        <span class="tour-promo-badge">Devotion</span>
                        <div class="tour-card-content mt-3">
                            <h3 class="tour-promo-title">KASHI + AYODHYA</h3>
                            <div class="tour-promo-duration">
                                <i class="bi bi-clock-fill"></i> 2N 3D
                            </div>
                            <p class="tour-promo-desc">Immerse yourself in the divinity of Baba Vishwanath and the grandeur of Ram Janmabhoomi.</p>
                        </div>
                        <div class="tour-promo-actions">
                            <button type="button" class="tour-promo-btn-itinerary" data-bs-toggle="modal" data-bs-target="#itineraryKashiAyodhya">
                                <i class="bi bi-file-text"></i> Itinerary
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the KASHI + AYODHYA (2N 3D) package. Please provide more information.') }}" target="_blank" class="tour-promo-btn-book">
                                <i class="bi bi-whatsapp"></i> Book Now
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Package 4 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="tour-promo-card">
                        <span class="tour-promo-badge">Holy Yatra</span>
                        <div class="tour-card-content mt-3">
                            <h3 class="tour-promo-title">KASHI + GAYA</h3>
                            <div class="tour-promo-duration">
                                <i class="bi bi-clock-fill"></i> 2N 3D
                            </div>
                            <p class="tour-promo-desc">Perform the ancestral Pinda Daan rituals in Gaya and seek blessings of Lord Kashi Vishwanath.</p>
                        </div>
                        <div class="tour-promo-actions">
                            <button type="button" class="tour-promo-btn-itinerary" data-bs-toggle="modal" data-bs-target="#itineraryKashiGaya">
                                <i class="bi bi-file-text"></i> Itinerary
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the KASHI + GAYA (2N 3D) package. Please provide more information.') }}" target="_blank" class="tour-promo-btn-book">
                                <i class="bi bi-whatsapp"></i> Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Everything You Need for a Perfect Trip -->
        <div class="flat-section">
            <div class="box-title text-center mb-5">
                <span class="text-warning text-uppercase fw-bold" style="font-size:12px; letter-spacing:1px;">Trip
                    Nomads</span>
                <h2 class="h1 font-family-poppins fw-bold text-dark mt-1">Everything You Need for a Perfect Trip</h2>
            </div>
            <div class="row g-4">
                <!-- Premium Rooms -->
                <div class="col-lg-2-5 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('hotels.index') }}" class="text-decoration-none">
                        <div class="perfect-trip-card">
                            <div class="perfect-trip-icon"><i class="bi bi-door-open-fill"></i></div>
                            <div class="perfect-trip-title">Premium Rooms</div>
                            <div class="perfect-trip-desc">Comfortable and hygienic hotel rooms near Kashi temples.</div>
                        </div>
                    </a>
                </div>
                <!-- Private Cabs -->
                <div class="col-lg-2-5 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('cabs.index') }}" class="text-decoration-none">
                        <div class="perfect-trip-card">
                            <div class="perfect-trip-icon"><i class="bi bi-car-front-fill"></i></div>
                            <div class="perfect-trip-title">Private Cabs</div>
                            <div class="perfect-trip-desc">Air-conditioned fleet for local sightseeing and outstations.
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Secure Boat Rides -->
                <div class="col-lg-2-5 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('boat-rides.index') }}" class="text-decoration-none">
                        <div class="perfect-trip-card">
                            <div class="perfect-trip-icon"><i class="bi bi-tsunami"></i></div>
                            <div class="perfect-trip-title">Secure Boat Rides</div>
                            <div class="perfect-trip-desc">Sunrise subah-e-banaras and sunset ganga aarti boat rides.</div>
                        </div>
                    </a>
                </div>
                <!-- Ganga Aarti Pooja -->
                <div class="col-lg-2-5 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('packages.index') }}" class="text-decoration-none">
                        <div class="perfect-trip-card">
                            <div class="perfect-trip-icon"><i class="bi bi-brightness-high-fill"></i></div>
                            <div class="perfect-trip-title">Ganga Aarti Pooja</div>
                            <div class="perfect-trip-desc">Special devotianal yatras covering ganga puja and aarti.</div>
                        </div>
                    </a>
                </div>
                <!-- Pilgrim Support -->
                <div class="col-lg-2-5 col-md-6 col-sm-12 col-12">
                    <a href="{{ route('contact') }}" class="text-decoration-none">
                        <div class="perfect-trip-card">
                            <div class="perfect-trip-icon"><i class="bi bi-headset"></i></div>
                            <div class="perfect-trip-title">Pilgrim Support</div>
                            <div class="perfect-trip-desc">24/7 dedicated helpline and local guide support.</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- 5. Varanasi Yatras / Tour Packages -->
        <div class="flat-section flat-recommended ">
            <div class="box-title text-center mb-5 wow animate__animated animate__fadeInUp">
                <span class="text-warning text-uppercase fw-bold" style="font-size:12px; letter-spacing:1px;">Spiritual
                    Yatras</span>
                <h2 class="h1 font-family-poppins fw-bold text-dark mt-1">Tour Packages &amp; Varanasi Yatras</h2>
                <p class="text-muted desc">Explore custom pilgrimage itineraries chosen by thousands of families.</p>
            </div>

            <div class="row g-3 pkg-scroll-row">
                @forelse($featuredPackages as $pkg)
                    <div
                        class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 pkg-scroll-item wow animate__animated animate__fadeInUp">
                        <a href="{{ route('packages.show', $pkg->slug) }}" class="text-decoration-none">
                            <div class="pkg-card">
                                <div class="pkg-card-img">
                                    @php
                                        $cover = !empty($pkg->images)
                                            ? asset('storage/' . $pkg->images[0])
                                            : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800';
                                    @endphp
                                    <img src="{{ $cover }}" alt="{{ $pkg->title }}">
                                    <div class="pkg-badge-level">{{ $pkg->difficulty ?? 'Popular' }}</div>

                                    {{-- <div class="pkg-card-wishlist"
                                        onclick="event.preventDefault(); event.stopPropagation();"><i
                                            class="bi bi-heart"></i></div> --}}
                                </div>
                                <div class="pkg-card-body">
                                    <div class="pkg-card-title">{{ $pkg->title }}</div>
                                    <div class="pkg-card-priceline">
                                        <span class="pkg-mrp">₹{{ number_format($pkg->price * 1.2) }}</span>
                                        <span class="pkg-price">₹{{ number_format($pkg->price) }}</span>
                                        <span class="pkg-per">/ trip</span>
                                        <span class="pkg-dot">●</span>
                                        <span class="pkg-rating"><i class="bi bi-star-fill"></i> 4.9</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center   text-muted">No featured packages found.</div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('packages.index') }}"
                    class="tf-btn primary hover-1 px-5 py-3 rounded-pill text-white text-decoration-none fw-bold"
                    style="font-size: 14px;">View All Tour Packages</a>
            </div>
        </div>

        <!-- 8. Cab Booking / Varanasi Fleet -->
        @php
            $homepageCabs = \App\Models\CabBookingPackage::where('status', true)->latest()->take(4)->get();
        @endphp
        @if ($homepageCabs->count() > 0)
            <div class="flat-section  ">
                <div class="box-title text-center mb-5">
                    <span class="text-warning text-uppercase fw-bold" style="font-size:12px; letter-spacing:1px;">Taxi
                        Fleet</span>
                    <h2 class="h1 font-family-poppins fw-bold text-dark mt-1">Cab Booking &amp; Varanasi Fleet</h2>
                    <p class="text-muted desc">Choose from SUV, Sedan, and luxury cars driven by professional tour drivers.
                    </p>
                </div>
                <div class="row g-4">
                    @foreach ($homepageCabs as $cab)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="item hover-img bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100 d-flex flex-column"
                                style="border: 1px solid #f0f0f0 !important;">
                                <div class="archive-top position-relative overflow-hidden"
                                    style="height:170px; background-color:#f8fafc;">
                                    @if (!empty($cab->images) && count($cab->images) > 0)
                                        <img src="{{ asset('storage/' . $cab->images[0]) }}" alt="{{ $cab->cab_name }}"
                                            class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;">
                                    @else
                                        <div
                                            class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                            <i class="bi bi-car-front text-warning display-4"></i>
                                            <span class="small mt-1">Premium Ride</span>
                                        </div>
                                    @endif
                                    <div class="position-absolute bg-dark text-white rounded-pill px-3 py-1 fw-bold"
                                        style="bottom:12px; right:12px; font-size:10px; z-index:3;">
                                        <i class="bi bi-people-fill text-warning me-1"></i>{{ $cab->seating_capacity }}
                                        Seater
                                    </div>
                                </div>
                                <div class="archive-bottom p-4 d-flex flex-column flex-grow-1">
                                    <span
                                        class="badge bg-light text-dark border-0 rounded-pill px-3 py-1 mb-2 small fw-bold align-self-start"
                                        style="font-size:10px;">{{ $cab->vehicle_type }}</span>
                                    <h3 class="tour-title h6 mb-3 fw-bold text-dark font-family-poppins">
                                        {{ $cab->cab_name }}</h3>
                                    <div class="text-muted flex-grow-1"
                                        style="font-size:12.5px; line-height:1.4; margin-bottom: 20px;">
                                        {!! Str::limit(strip_tags($cab->description), 80) !!}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between border-top pt-3">
                                        <div class="price">
                                            <span class="text-muted"
                                                style="font-size:10px; display:block; text-transform:uppercase; line-height:1.2;">Rates
                                                From</span>
                                            <span class="fw-extrabold text-primary h5 mb-0"
                                                style="color:#061624;">₹{{ number_format($cab->price) }}<small
                                                    class="text-muted" style="font-size:9.5px;">/day</small></span>
                                        </div>
                                        <a href="{{ route('cabs.index') }}"
                                            class="tf-btn primary hover-1 rounded-pill text-white border-0 fw-bold text-decoration-none">Enquire
                                            Cab</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('cabs.index') }}"
                        class="tf-btn primary hover-1 px-5 py-3 rounded-pill text-white text-decoration-none fw-bold"
                        style="font-size:14px;">View Fleet details</a>
                </div>
            </div>
        @endif

        <!-- 9. Popular Stays in Varanasi -->
        <div class="flat-section ">
            <div class="box-title text-center mb-5 wow animate__animated animate__fadeInUp">
                <span class="text-warning text-uppercase fw-bold"
                    style="font-size:12px; letter-spacing:1px;">Accommodations</span>
                <h2 class="h1 font-family-poppins fw-bold text-dark mt-1">Popular Stays in Varanasi</h2>
                <p class="text-muted desc">Book handpicked luxury and mid-range hotel rooms close to major yatra spots.</p>
            </div>
            <div class="row g-4">
                @forelse($featuredHotels as $hotel)
                    <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp">
                        <div class="item hover-img bg-white shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column"
                            style="border: 1px solid #f0f0f0 !important;">
                            <div class="archive-top position-relative overflow-hidden" style="height:200px;">
                                @php
                                    $hotelCover = !empty($hotel->images)
                                        ? asset('storage/' . $hotel->images[0])
                                        : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=800';
                                @endphp
                                <a href="{{ route('hotels.show', $hotel->id) }}" class="d-block h-100">
                                    <img src="{{ $hotelCover }}" alt="{{ $hotel->name }}"
                                        class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;">
                                </a>
                                <div class="position-absolute bg-warning text-white rounded-pill px-3 py-1 fw-bold"
                                    style="top:12px; right:12px; font-size:10px; z-index:3;">
                                    <i class="bi bi-star-fill text-white me-1"></i>{{ $hotel->rating ?? '4.8' }} Rating
                                </div>
                            </div>
                            <div class="archive-bottom p-4 d-flex flex-column flex-grow-1">
                                <h3 class="tour-title h6 mb-2 fw-bold font-family-poppins">
                                    <a href="{{ route('hotels.show', $hotel->id) }}"
                                        class="text-dark text-decoration-none hover-warning">{{ $hotel->name }}</a>
                                </h3>
                                <p class="text-muted small mb-3">
                                    <i
                                        class="bi bi-geo-alt-fill text-warning me-1"></i>{{ $hotel->address ?? 'Varanasi' }}
                                </p>
                                <!-- Amenities -->
                                <div class="d-flex flex-wrap gap-2 mb-3" style="font-size: 11px;">
                                    <span class="bg-light px-2.5 py-1 rounded text-muted"><i
                                            class="bi bi-check2-circle text-success me-1"></i>Wi-Fi</span>
                                    <span class="bg-light px-2.5 py-1 rounded text-muted"><i
                                            class="bi bi-check2-circle text-success me-1"></i>AC Room</span>
                                    <span class="bg-light px-2.5 py-1 rounded text-muted"><i
                                            class="bi bi-check2-circle text-success me-1"></i>Breakfast</span>
                                    <span class="bg-light px-2.5 py-1 rounded text-muted"><i
                                            class="bi bi-check2-circle text-success me-1"></i>Room Service</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-auto">
                                    <div class="price">
                                        <span class="text-muted"
                                            style="font-size:10px; display:block; text-transform:uppercase; line-height:1.2;">Starting
                                            From</span>
                                        <span class="fw-extrabold text-primary h5 mb-0"
                                            style="color:#061624;">₹{{ number_format($hotel->min_price ?? 2200) }}<small
                                                class="text-muted" style="font-size:9.5px;">/night</small></span>
                                    </div>
                                    <a href="{{ route('hotels.show', $hotel->id) }}"
                                        class="tf-btn primary hover-1 px-4  rounded-pill font-size-12 text-white border-0 fw-bold text-decoration-none">Book
                                        Rooms</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">No hotel listings found.</div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('hotels.index') }}"
                    class="tf-btn primary hover-1  rounded-pill text-white text-decoration-none fw-bold"
                    style="font-size:14px;">View All Hotel Listings</a>
            </div>
        </div>
    </div>

    <!-- 9.5 Testimonials Section -->
    @if (isset($testimonials) && $testimonials->count() > 0)
        <div class="flat-section   bg-light-gray"
            style="background-color: #FAFAFA; border-top: 1px solid #E8E8E8; border-bottom: 1px solid #E8E8E8; margin-top: 50px;">
            <div class="container">
                <div class="box-title text-center mb-5">
                    <span>Guest Reviews</span>
                    <h2 class="h1 font-family-poppins fw-bold text-dark mt-1">What Our Travelers Say About Us</h2>
                    <p class="text-muted desc">Read honest reviews from families who explored Kashi with our services.</p>
                </div>

                <div class="swiper testimonialSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $t)
                            <div class="swiper-slide h-auto">
                                <div class="testimonial-card-premium">

                                    <div class="testimonial-user">
                                        <img src="{{ $t->image ? asset('storage/' . $t->image) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200' }}"
                                            alt="{{ $t->name }}" class="testimonial-avatar">
                                        <div class="testimonial-info">
                                            <h4>{{ $t->name }}</h4>
                                            <p>{{ $t->role ?? 'Traveler' }}</p>
                                        </div>
                                    </div><br>
                                    <div class="rating d-flex text-warning gap-1 mb-3" style="font-size: 13px;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $t->rating)
                                                <i class="bi bi-star-fill" style="color: #D4AF37 !important;"></i>
                                            @else
                                                <i class="bi bi-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </div>

                                    <div class="testimonial-feedback">
                                        "{!! strip_tags($t->content) !!}"
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-4 position-relative"></div>
                </div>
            </div>
        </div>
    @endif

    <!-- 10. Spiritual Triangle Bottom CTA Banner -->
    <div class="bottom-cta-triangle" style="--cta-bg-image: url('{{ $ctaBgImage }}');">
        <div class="container">
            <h2>{{ $ctaTitle }}</h2>
            <div> {!! $sections['why_choose_us']->description!!}</div>
            <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
                @if ($settings->contact_phone)
                    <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}"
                        class="btn btn-warning rounded-pill px-5 py-3 text-dark fw-bold text-decoration-none shadow-premium animate__animated animate__pulse animate__infinite"
                        style="font-size:16px;">
                        <i class="bi bi-telephone-fill me-2"></i> Call {{ $settings->contact_phone }}
                    </a>
                @endif
                <a href="{{ route('contact') }}"
                    class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold text-decoration-none"
                    style="font-size:16px;">Get Instant Quote</a>
            </div>
        </div>
    </div>

    <!-- 11. Detailed Varanasi & Yatra SEO Content Block -->
    <div class="container">
        <div class="seo-content-box">
            {!! $sections['about_intro']->description!!}
        </div>
    </div>

    <!-- ITINERARY MODALS -->
    <!-- Modal 1: Kashi Tour -->
    <div class="modal fade" id="itineraryKashiTour" tabindex="-1" aria-labelledby="itineraryKashiTourLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header text-white border-0 py-3 px-4" style="background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);">
                    <h5 class="modal-title fw-bold" id="itineraryKashiTourLabel">
                        <i class="bi bi-map-fill me-2 "></i> Kashi Tour Itinerary (2 Nights / 3 Days)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background: #fdfbf7;">
                    <div class="timeline-wrapper position-relative ps-4 border-start border-2 border-warning" style="border-color: #F57C00 !important; margin-left: 10px;">
                        <!-- Day 1 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">1</div>
                            <h6 class="fw-bold text-dark mb-1">Day 1: Arrival, Hotel Check-in & Evening Ganga Aarti</h6>
                            <p class="text-muted small">Arrive at Varanasi Airport/Junction. Our driver will pick you up and transfer you to the hotel. After check-in, rest for a while. In the evening, witness the divine Ganga Aarti at Dashashwamedh Ghat from a private boat cruise.</p>
                        </div>
                        <!-- Day 2 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">2</div>
                            <h6 class="fw-bold text-dark mb-1">Day 2: Kashi Vishwanath Darshan, Heritage Temples & Sarnath Excursion</h6>
                            <p class="text-muted small">Early morning, proceed for VIP Darshan at Kashi Vishwanath Temple (Golden Temple), Annapurna Temple, and Vishalakshi Temple. Return to hotel for breakfast. Afterwards, drive to Sarnath—the holy place where Lord Buddha gave his first sermon. Visit Dhamek Stupa, Chaukhandi Stupa, and the archaeological museum.</p>
                        </div>
                        <!-- Day 3 -->
                        <div class="timeline-item position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">3</div>
                            <h6 class="fw-bold text-dark mb-1">Day 3: Subah-e-Banaras, Local Temple Tour & Departure</h6>
                            <p class="text-muted small">Experience the mystical morning rituals ("Subah-e-Banaras") at Assi Ghat, featuring traditional Vedic chanting and morning Aarti. Post breakfast, visit Sankat Mochan Temple, Durga Temple, and Birla Vishwanath Temple (BHU). After some local shopping for Banarasi Silk, drop off at Varanasi Airport/Junction for departure.</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning border-0 d-flex align-items-start gap-3 mt-4" style="background-color: rgba(245, 124, 0, 0.08); border-radius: 12px;">
                        <i class="bi bi-info-circle-fill text-warning fs-5" style="color: #F57C00 !important;"></i>
                        <div class="small text-dark">
                            <strong>Package Inclusions:</strong> AC cab for all transfers & sightseeing, hotel accommodation with daily breakfast, private boat ride for Aarti, and VIP temple darshan assistance.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Close</button>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the KASHI TOUR (2 N 3D) package. Please provide more information.') }}" target="_blank" class="btn text-white px-4 py-2" style="background-color: #25D366; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-whatsapp"></i> Book Yatra on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2: Kashi Prayagraj & Ayodhya Spiritual Tour -->
    <div class="modal fade" id="itineraryKashiPrayagrajAyodhya" tabindex="-1" aria-labelledby="itineraryKashiPrayagrajAyodhyaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header text-white border-0 py-3 px-4" style="background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);">
                    <h5 class="modal-title fw-bold" id="itineraryKashiPrayagrajAyodhyaLabel">
                        <i class="bi bi-map-fill me-2"></i> Kashi Prayagraj & Ayodhya Spiritual Tour (3 Nights / 4 Days)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background: #fdfbf7;">
                    <div class="timeline-wrapper position-relative ps-4 border-start border-2 border-warning" style="border-color: #F57C00 !important; margin-left: 10px;">
                        <!-- Day 1 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">1</div>
                            <h6 class="fw-bold text-dark mb-1">Day 1: Arrival & Evening Ganga Aarti in Varanasi</h6>
                            <p class="text-muted small">On arrival at Varanasi, pick up and check-in to your hotel. Evening boat ride on the holy Ganges to witness the grand evening Aarti at Dashashwamedh Ghat. Overnight stay in Varanasi.</p>
                        </div>
                        <!-- Day 2 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">2</div>
                            <h6 class="fw-bold text-dark mb-1">Day 2: Varanasi Temple Tour & Drive to Prayagraj & Ayodhya</h6>
                            <p class="text-muted small">Early morning VIP darshan at Shri Kashi Vishwanath Temple, Annapurna Temple, and Kaal Bhairav. Return to hotel for breakfast, then drive to Prayagraj. Enjoy holy bath at Triveni Sangam (Confluence of Ganga, Yamuna & mythical Saraswati), and visit Bade Hanuman Temple and Anand Bhawan. Later, drive to Ayodhya. Overnight stay in Ayodhya.</p>
                        </div>
                        <!-- Day 3 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">3</div>
                            <h6 class="fw-bold text-dark mb-1">Day 3: Ayodhya Sightseeing & Return to Varanasi</h6>
                            <p class="text-muted small">After breakfast, visit the grand Ram Janmabhoomi Temple, Hanuman Garhi, Kanak Bhawan, and Dashrath Mahal. Witness the serenity of Saryu River. In the afternoon, drive back to Varanasi. Overnight stay in Varanasi.</p>
                        </div>
                        <!-- Day 4 -->
                        <div class="timeline-item position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">4</div>
                            <h6 class="fw-bold text-dark mb-1">Day 4: Sarnath Tour & Departure</h6>
                            <p class="text-muted small">After breakfast, check-out and take a tour of Sarnath (Buddhist monument site). If time permits, visit the local markets for Banarasi sarees and drop at airport/railway station for your onward journey.</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning border-0 d-flex align-items-start gap-3 mt-4" style="background-color: rgba(245, 124, 0, 0.08); border-radius: 12px;">
                        <i class="bi bi-info-circle-fill text-warning fs-5" style="color: #F57C00 !important;"></i>
                        <div class="small text-dark">
                            <strong>Package Inclusions:</strong> AC Cab for Varanasi-Prayagraj-Ayodhya transport, accommodation in 3-star hotels with breakfast, VIP darshan passes, and private boat rides.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Close</button>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the Kashi Prayagraj & Ayodhya Spiritual Tour (3N 4D) package. Please provide more information.') }}" target="_blank" class="btn text-white px-4 py-2" style="background-color: #25D366; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-whatsapp"></i> Book Yatra on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3: Kashi + Ayodhya -->
    <div class="modal fade" id="itineraryKashiAyodhya" tabindex="-1" aria-labelledby="itineraryKashiAyodhyaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header text-white border-0 py-3 px-4" style="background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);">
                    <h5 class="modal-title fw-bold" id="itineraryKashiAyodhyaLabel">
                        <i class="bi bi-map-fill me-2"></i> Kashi + Ayodhya (2 Nights / 3 Days)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background: #fdfbf7;">
                    <div class="timeline-wrapper position-relative ps-4 border-start border-2 border-warning" style="border-color: #F57C00 !important; margin-left: 10px;">
                        <!-- Day 1 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">1</div>
                            <h6 class="fw-bold text-dark mb-1">Day 1: Arrival & Evening Ganga Aarti in Varanasi</h6>
                            <p class="text-muted small">Arrival at Varanasi and transfer to your hotel. In the evening, witness the glorious Ganga Aarti from a boat cruise. Overnight stay in Varanasi.</p>
                        </div>
                        <!-- Day 2 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">2</div>
                            <h6 class="fw-bold text-dark mb-1">Day 2: Vishwanath Darshan & Drive to Ayodhya</h6>
                            <p class="text-muted small">Early morning VIP Darshan at Kashi Vishwanath temple, Annapurna Temple, and Kaal Bhairav. Return for breakfast, then check out and drive to Ayodhya (approx. 4 hours). Check-in at your hotel in Ayodhya. In the evening, attend the Saryu River Aarti and experience the local heritage streets. Overnight stay in Ayodhya.</p>
                        </div>
                        <!-- Day 3 -->
                        <div class="timeline-item position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">3</div>
                            <h6 class="fw-bold text-dark mb-1">Day 3: Ram Mandir Darshan, Ayodhya Tour & Departure</h6>
                            <p class="text-muted small">Seek blessings at the Ram Janmabhoomi Temple, Hanuman Garhi, and Kanak Bhawan. After lunch, check-out and return to Varanasi. We will drop you off at the Airport/Junction for departure.</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning border-0 d-flex align-items-start gap-3 mt-4" style="background-color: rgba(245, 124, 0, 0.08); border-radius: 12px;">
                        <i class="bi bi-info-circle-fill text-warning fs-5" style="color: #F57C00 !important;"></i>
                        <div class="small text-dark">
                            <strong>Package Inclusions:</strong> Private AC vehicle, hotel stays in Varanasi and Ayodhya, breakfast, boat ride in Varanasi, and priority entry assistance for darshans.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Close</button>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the KASHI + AYODHYA (2N 3D) package. Please provide more information.') }}" target="_blank" class="btn text-white px-4 py-2" style="background-color: #25D366; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-whatsapp"></i> Book Yatra on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4: Kashi + Gaya -->
    <div class="modal fade" id="itineraryKashiGaya" tabindex="-1" aria-labelledby="itineraryKashiGayaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header text-white border-0 py-3 px-4" style="background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);">
                    <h5 class="modal-title fw-bold" id="itineraryKashiGayaLabel">
                        <i class="bi bi-map-fill me-2"></i> Kashi + Gaya (2 Nights / 3 Days)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background: #fdfbf7;">
                    <div class="timeline-wrapper position-relative ps-4 border-start border-2 border-warning" style="border-color: #F57C00 !important; margin-left: 10px;">
                        <!-- Day 1 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">1</div>
                            <h6 class="fw-bold text-dark mb-1">Day 1: Arrival & Evening Ganga Aarti in Varanasi</h6>
                            <p class="text-muted small">Arrival at Varanasi and transfer to your hotel. In the evening, witness the famous Ganga Aarti at Dashashwamedh Ghat from a private boat. Overnight stay in Varanasi.</p>
                        </div>
                        <!-- Day 2 -->
                        <div class="timeline-item mb-4 position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">2</div>
                            <h6 class="fw-bold text-dark mb-1">Day 2: Varanasi Temple Darshan & Drive to Gaya & Bodhgaya</h6>
                            <p class="text-muted small">Early morning VIP Darshan at Kashi Vishwanath temple, Annapurna Temple, and Kaal Bhairav. Return for breakfast, then drive to Gaya (approx. 5-6 hours). In Gaya, visit the holy Vishnupad Temple to perform Pind Daan (ancestral rites) if desired. Later, visit Bodhgaya—where Lord Buddha attained enlightenment. Visit the Mahabodhi Temple, the sacred Bodhi Tree, and various international monasteries. Overnight stay in Bodhgaya.</p>
                        </div>
                        <!-- Day 3 -->
                        <div class="timeline-item position-relative">
                            <div class="timeline-dot position-absolute bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 28px; height: 28px; left: -39px; top: 0; background-color: #F57C00 !important; font-size: 12px;">3</div>
                            <h6 class="fw-bold text-dark mb-1">Day 3: Return to Varanasi & Departure</h6>
                            <p class="text-muted small">After breakfast, check out and drive back to Varanasi. Enjoy quick shopping for silk garments and drop-off at the Airport/Junction for your departure flight/train.</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning border-0 d-flex align-items-start gap-3 mt-4" style="background-color: rgba(245, 124, 0, 0.08); border-radius: 12px;">
                        <i class="bi bi-info-circle-fill text-warning fs-5" style="color: #F57C00 !important;"></i>
                        <div class="small text-dark">
                            <strong>Package Inclusions:</strong> AC cab for all transfers & long drives, hotel accommodation with breakfast, boat cruise, local guide support, and ritual co-ordination.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Close</button>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}?text={{ urlencode('Hello, I would like to book the KASHI + GAYA (2N 3D) package. Please provide more information.') }}" target="_blank" class="btn text-white px-4 py-2" style="background-color: #25D366; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-whatsapp"></i> Book Yatra on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                if ($('.heroSwiper').length > 0) {
                    new Swiper(".heroSwiper", {
                        slidesPerView: 1,
                        loop: true,
                        autoHeight: true,
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: ".hero-pagination",
                            clickable: true,
                        },
                        navigation: {
                            nextEl: ".hero-button-next",
                            prevEl: ".hero-button-prev",
                        },
                    });
                }

                if ($('.testimonialSwiper').length > 0) {
                    new Swiper(".testimonialSwiper", {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        autoplay: {
                            delay: 4500,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                        breakpoints: {
                            768: {
                                slidesPerView: 2,
                            },
                            1024: {
                                slidesPerView: 3,
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
