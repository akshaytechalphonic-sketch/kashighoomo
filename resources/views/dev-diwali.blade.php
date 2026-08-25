@extends('layouts.app')

{{-- @section('title', $page->meta_title ?? 'Contact Us | Visit Kashi')
@section('meta_description',
    $page->meta_description ??
    'Get in touch with Visit Kashi. Plan your Varanasi holiday,
    local cabs, boat rides, and yatra packages.')
@section('meta_keywords', $page->meta_keywords ?? 'contact visit kashi, varanasi tour planner') --}}

@push('styles')
    <style>
        :root {
            --primary-orange: #e65100;
            --accent-orange: #ff5722;
            --btn-orange: #ff6e40;
            --bg-cream: #fbf7f0;
            --card-bg: #ffffff;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --border-light: #f3f4f6;
        }

        .dev-diwali-wrapper {
            background-color: var(--bg-cream) !important;
            color: var(--text-dark) !important;
            line-height: 1.5 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .dev-diwali-wrapper * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .dev-diwali-wrapper *:not(i) {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .dev-diwali-wrapper a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 5%;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-orange);
        }

        nav {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        nav a {
            font-weight: 600;
            font-size: 15px;
            color: #334155;
            transition: color 0.2s;
        }

        nav a:hover {
            color: var(--primary-orange);
        }

        .nav-badge {
            background: #fff3e0;
            color: var(--primary-orange);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url('https://commons.wikimedia.org/wiki/Special:Redirect/file/The%20Ganga%20Aarti.jpg?utm_source=chatgpt.com') center/cover no-repeat;
            color: #ffffff;
            text-align: center;
            padding: 110px 20px;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .mantra {
            font-size: 15px;
            color: #ffe0b2;
            font-style: italic;
            margin-bottom: 15px;
        }

        .hero h1 {
            font-size: 42px !important;
            font-weight: 800 !important;
            max-width: 900px;
            margin: 0 auto 20px;
            line-height: 1.25 !important;
            color: #ffffff !important;
        }

        .hero p {
            font-size: 16px !important;
            max-width: 750px;
            margin: 0 auto 30px;
            color: #e2e8f0 !important;
            line-height: 1.5 !important;
        }

        .hero-btns {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background-color: var(--primary-orange);
            color: #fff;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background-color: #bf360c;
        }

        .btn-whatsapp {
            background-color: #25d366;
            color: #fff;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-whatsapp:hover {
            background-color: #1da851;
        }

        /* Container & Header */
        .dev-diwali-wrapper .container {
            max-width: 1240px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .dev-diwali-wrapper .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .sub-title {
            color: var(--primary-orange);
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .section-header h2 {
            font-size: 32px !important;
            color: var(--text-dark) !important;
            font-weight: 800 !important;
            line-height: 1.3 !important;
        }

        .section-header p {
            color: var(--text-muted) !important;
            margin-top: 8px;
            font-size: 15px !important;
            line-height: 1.5 !important;
        }

        /* Packages Grid Layout */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            align-items: stretch;
        }

        /* New Card Styling matching image */
        .pkg-card {
            background: var(--card-bg);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            display: flex;
            flex-direction: column;
            padding-top: 35px;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        /* Corner Ribbon Tag */
        .ribbon-tag {
            position: absolute;
            top: 18px;
            right: -35px;
            transform: rotate(35deg);
            padding: 6px 40px;
            font-size: 12px;
            font-weight: 800;
            color: #ffffff;
            text-transform: capitalize;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
            z-index: 2;
            letter-spacing: 0.5px;
        }

        .ribbon-red {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .ribbon-green {
            background: linear-gradient(135deg, #059669, #047857);
        }

        .ribbon-yellow {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .ribbon-purple {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        /* Top Icon Container */
        .card-icon-wrapper {
            width: 70px;
            height: 70px;
            background-color: #fff8f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
        }

        .card-icon-wrapper i {
            font-size: 28px;
            color: var(--primary-orange);
        }

        .pkg-body {
            padding: 0 20px 20px 20px;
            text-align: center;
            flex-grow: 1;
        }

        .pkg-title {
            font-size: 22px !important;
            font-weight: 800 !important;
            color: #111827 !important;
            margin-bottom: 12px;
            line-height: 1.3 !important;
        }

        .pkg-price {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .pkg-price .original {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: 18px;
            font-weight: 600;
        }

        .pkg-price .current {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary-orange);
        }

        .per-person-pill {
            display: inline-block;
            background: #f3f4f6;
            color: #6b7280;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 12px;
            margin-bottom: 16px;
            border: 1px solid #e5e7eb;
        }

        .photo-btn {
            background: linear-gradient(135deg, #ff7043, #ff5722);
            color: #ffffff;
            border: none;
            width: 100%;
            padding: 10px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.25);
            transition: transform 0.2s;
        }

        .photo-btn:hover {
            transform: translateY(-1px);
        }

        /* Detail Boxes */
        .info-pill-box {
            background-color: #fafafa;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            padding: 10px 12px;
            margin-bottom: 10px;
            font-size: 12px;
            color: #374151;
            font-weight: 600;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-pill-box i {
            color: var(--primary-orange);
            font-size: 14px;
        }

        .pkg-desc {
            font-style: italic;
            color: #4b5563;
            font-size: 12px;
            margin: 15px 0;
            text-align: left;
        }

        .pkg-section-title {
            font-weight: 800;
            font-size: 13px;
            margin-top: 15px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            text-align: left;
            color: var(--text-dark);
        }

        .pkg-list {
            list-style: none;
            margin-bottom: 10px;
            text-align: left;
        }

        .pkg-list li {
            font-size: 12px;
            color: #4b5563;
            margin-bottom: 6px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .pkg-list li i.fa-circle-dot {
            color: var(--primary-orange);
            font-size: 8px;
            margin-top: 4px;
        }

        .pkg-list li i.fa-circle-check {
            color: #10b981;
            font-size: 11px;
            margin-top: 3px;
        }

        .pkg-footer {
            padding: 0 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-full {
            width: 100%;
            text-align: center;
            justify-content: center;
        }

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .feature-card {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .feature-card i {
            font-size: 28px;
            color: var(--primary-orange);
            margin-bottom: 15px;
        }

        .feature-card h3 {
            font-size: 20px !important;
            margin-bottom: 10px;
            font-weight: 700 !important;
            color: var(--text-dark) !important;
        }

        .feature-card p {
            color: var(--text-muted) !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
        }

        /* Stats Bar */
        .stats-bar {
            background: #0f172a;
            color: #fff;
            padding: 40px 20px;
            margin: 60px 0;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 36px !important;
            color: var(--primary-orange) !important;
            font-weight: 800 !important;
            line-height: 1.2 !important;
        }

        .stat-item p {
            font-size: 13px !important;
            color: #94a3b8 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
            line-height: 1.5 !important;
        }

        /* FAQ Section */
        .faq-item {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 15px;
            padding: 20px;
        }

        .faq-question {
            font-weight: 700;
            font-size: 16px;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .faq-answer {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Footer */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 60px 20px 20px;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid #1e293b;
        }

        .footer-col h4 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            font-size: 14px;
            transition: color 0.2s;
        }

        .footer-col ul li a:hover {
            color: #fff;
        }

        .copyright {
            text-align: center;
            padding-top: 25px;
            font-size: 13px;
        }

        /* Floating Widgets */
        .floating-widgets {
            position: fixed;
            bottom: 25px;
            right: 25px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 999;
        }

        .float-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .float-wa {
            background: #25d366;
        }

        .float-call {
            background: #3b82f6;
        }


        .gallery-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .gallery-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .gallery-header .sub-title {
            color: #f97316;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 6px;
        }

        .gallery-header h2 {
            font-size: 36px !important;
            color: #0f172a !important;
            font-weight: 800 !important;
            line-height: 1.3 !important;
        }

        .gallery-header h2 span {
            color: #f97316;
        }

        .gallery-header p {
            color: #64748b !important;
            margin-top: 8px;
            font-size: 15px !important;
            line-height: 1.5 !important;
        }

        /* Grid Layout */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            height: 260px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
        }

        /* Hover Overlay */
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0) 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            color: #ffffff;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .gallery-overlay p {
            font-size: 13px;
            color: #cbd5e1;
        }
    </style>
@endpush

@section('content')
    <div class="dev-diwali-wrapper">

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-badge">🪔 24 NOVEMBER 2026 🪔</div>
            <div class="mantra">सर्वे भवन्तु सुखिनः — MAY ALL BEINGS BE HAPPY</div>
            <h1>Experience Dev Deepawali from the Heart of the Ganges</h1>
            <p>Witness the celestial festival where millions of glowing diyas meet the sacred river. Reserve your premium
                boat seat for an unobstructed, mesmerizing view of Varanasi's grandest night.</p>
            <div class="hero-btns">
                <a href="{{route('contact')}}" class="btn-primary">BOOK YOUR BOAT NOW</a>
                <a href="https://wa.me/919214191918" class="btn-whatsapp"><i class="fa-brands fa-whatsapp"></i> WHATSAPP
                    INQUIRY</a>
            </div>
        </section>

        <!-- Why Varanasi Section -->
        <div class="container">
            <div class="section-header">
                <div class="sub-title">The Festival of Gods</div>
                <h2>Why Celebrate Dev Deepawali in Varanasi?</h2>
                <p>Varanasi, the spiritual capital of India, hosts the grandest Dev Deepawali celebration in the world. On
                    Kartik Purnima, the Gods themselves descend to earth to bathe in the holy Ganges.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                 <i class="fa-solid fa-lightbulb"></i>
                    <h3>Spiritual Significance</h3>
                    <p>Experience profound peace as millions of devotees gather to offer prayers, honoring Lord Shiva's
                        victory over the demon Tripurasur.</p>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-lightbulb"></i>
                    <h3>Visual Spectacle of 84 Ghats</h3>
                    <p>Witness an unbroken chain of light as all 84 ghats of Varanasi are continuously illuminated with
                        millions of earthen diyas.</p>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-shield-halved"></i>
                    <h3>Why Book With IndiTirth?</h3>
                    <p>Booking a boat can be chaotic. We ensure a seamless, luxurious, and safe experience away from crowds
                        with our verified fleet.</p>
                </div>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>84+</h3>
                    <p>Ghats Illuminated</p>
                </div>
                <div class="stat-item">
                    <h3>1M+</h3>
                    <p>Glowing Diyas</p>
                </div>
                <div class="stat-item">
                    <h3>100k+</h3>
                    <p>Devotees</p>
                </div>
                <div class="stat-item">
                    <h3>1</h3>
                    <p>Magical Night</p>
                </div>
            </div>
        </div>

        <!-- Packages Section -->
        <div class="container" id="packages">
            <div class="section-header">
                <div class="sub-title">Reserve Your Seat</div>
                <h2>Premium Boat Packages</h2>
                <p>Book early to secure the best rates.</p>
            </div>

            <div class="packages-grid">

                <!-- Package 1 -->
                <div class="pkg-card">
                    <div class="ribbon-tag ribbon-red">Most Economical</div>
                    <div class="card-icon-wrapper">
                        <i class="fa-solid fa-ship"></i>
                    </div>
                    <div class="pkg-body">
                        <div class="pkg-title">Shared Motor Boat</div>
                        <div class="pkg-price">
                            <span class="original">₹4,499</span>
                            <span class="current">₹2,999</span>
                        </div>
                        <div>
                            <span class="per-person-pill">Per Person*</span>
                        </div>

                        <button class="photo-btn">
                            <i class="fa-solid fa-rotate"></i> Tap here to view boat photo
                        </button>

                        <div class="info-pill-box">
                            <i class="fa-solid fa-users"></i>
                            <span>Boat seating capacity 100+ Passengers</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Seating limited to 60% of total capacity</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-regular fa-clock"></i>
                            <span>5:00 PM - 8:30 PM (Approx. 3.5 Hours)</span>
                        </div>

                        <div class="pkg-desc">"Experience the divine celebration aboard our spacious shared motor boat."
                        </div>

                        <div class="pkg-section-title"><i class="fa-solid fa-star" style="color:var(--primary-orange);"></i>
                            Tour Highlights</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-dot"></i> Grand Fireworks Display on the Ganga</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Spectacular Laser Show at Chet Singh Ghat</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Divine Ganga Aarti at Dashashwamedh</li>
                        </ul>

                        <div class="pkg-section-title"><i class="fa-solid fa-shield-cat" style="color:#10b981;"></i>
                            Included Services</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-check"></i> Clean & Sanitized Life Jacket</li>
                            <li><i class="fa-solid fa-circle-check"></i> Experienced Captain & Tour Guide</li>
                            <li><i class="fa-solid fa-circle-check"></i> Mineral Water Bottle</li>
                        </ul>
                    </div>
                    <div class="pkg-footer">
                        <a href="{{route('contact')}}" class="btn-primary btn-full">Book Now - ₹2,999</a>
                        <a href="https://wa.me/919214191918" class="btn-whatsapp btn-full"><i
                                class="fa-brands fa-whatsapp"></i> Book via WhatsApp</a>
                    </div>
                </div>

                <!-- Package 2 -->
                <div class="pkg-card">
                    <div class="ribbon-tag ribbon-green">Best Value</div>
                    <div class="card-icon-wrapper">
                        <i class="fa-solid fa-sailboat"></i>
                    </div>
                    <div class="pkg-body">
                        <div class="pkg-title">Premium Shared Light Motor Boat</div>
                        <div class="pkg-price">
                            <span class="original">₹4,500</span>
                            <span class="current">₹3,999</span>
                        </div>
                        <div>
                            <span class="per-person-pill">Per Person*</span>
                        </div>

                        <button class="photo-btn">
                            <i class="fa-solid fa-rotate"></i> Tap here to view boat photo
                        </button>

                        <div class="info-pill-box">
                            <i class="fa-solid fa-users"></i>
                            <span>Boat seating capacity 100+ Passengers</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Seating limited to 45% of total capacity</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-regular fa-clock"></i>
                            <span>5:00 PM - 8:30 PM (Approx. 3.5 Hours)</span>
                        </div>

                        <div class="pkg-desc">"Upgrade your experience with our beautifully decorated boat featuring fewer
                            passengers."</div>

                        <div class="pkg-section-title"><i class="fa-solid fa-star" style="color:var(--primary-orange);"></i>
                            Tour Highlights</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-dot"></i> Grand Fireworks & Laser Show</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Divine Ganga Aarti viewing</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Complete 84 Ghats Heritage Ride</li>
                        </ul>

                        <div class="pkg-section-title"><i class="fa-solid fa-shield-cat" style="color:#10b981;"></i>
                            Included Services</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-check"></i> Light Snacks & Mineral Water</li>
                            <li><i class="fa-solid fa-circle-check"></i> Professional Captain & Certified Guide</li>
                            <li><i class="fa-solid fa-circle-check"></i> Dedicated Service Boy</li>
                        </ul>
                    </div>
                    <div class="pkg-footer">
                        <a href="{{route('contact')}}" class="btn-primary btn-full">Book Now - ₹3,999</a>
                        <a href="https://wa.me/919214191918" class="btn-whatsapp btn-full"><i
                                class="fa-brands fa-whatsapp"></i> Book via WhatsApp</a>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="pkg-card">
                    <div class="ribbon-tag ribbon-yellow">Spiritual Choice</div>
                    <div class="card-icon-wrapper">
                        <i class="fa-solid fa-house-chimney-window"></i>
                    </div>
                    <div class="pkg-body">
                        <div class="pkg-title">Double Decker Maharaja Boat</div>
                        <div class="pkg-price">
                            <span class="original">₹6,000</span>
                            <span class="current">₹4,999</span>
                        </div>
                        <div>
                            <span class="per-person-pill">Per Person*</span>
                        </div>

                        <button class="photo-btn">
                            <i class="fa-solid fa-rotate"></i> Tap here to view boat photo
                        </button>

                        <div class="info-pill-box">
                            <i class="fa-solid fa-users"></i>
                            <span>Boat seating capacity 130+ Passengers</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Allowed Passenger Only 50 Guests</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-regular fa-clock"></i>
                            <span>5:00 PM - 8:30 PM (Approx. 3.5 Hours)</span>
                        </div>

                        <div class="pkg-desc">"The elevated upper deck provides uninterrupted panoramic views."</div>

                        <div class="pkg-section-title"><i class="fa-solid fa-star"
                                style="color:var(--primary-orange);"></i> Tour Highlights</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-dot"></i> Grand Fireworks & Laser Show</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Panoramic Upper Deck views</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Live Musical Performance onboard</li>
                        </ul>

                        <div class="pkg-section-title"><i class="fa-solid fa-shield-cat" style="color:#10b981;"></i>
                            Included Services</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-check"></i> Chair Seating on Upper Deck</li>
                            <li><i class="fa-solid fa-circle-check"></i> Light Snacks & Mineral Water</li>
                            <li><i class="fa-solid fa-circle-check"></i> Professional Photographer on Boat</li>
                        </ul>
                    </div>
                    <div class="pkg-footer">
                        <a href="{{route('contact')}}" class="btn-primary btn-full">Book Now - ₹4,999</a>
                        <a href="https://wa.me/919214191918" class="btn-whatsapp btn-full"><i
                                class="fa-brands fa-whatsapp"></i> Book via WhatsApp</a>
                    </div>
                </div>

                <!-- Package 4 -->
                <div class="pkg-card">
                    <div class="ribbon-tag ribbon-purple">VIP Luxury</div>
                    <div class="card-icon-wrapper">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <div class="pkg-body">
                        <div class="pkg-title">Premium Luxury Cruise</div>
                        <div class="pkg-price">
                            <span class="original">₹9,000</span>
                            <span class="current">₹8,499</span>
                        </div>
                        <div>
                            <span class="per-person-pill">Per Person*</span>
                        </div>

                        <button class="photo-btn">
                            <i class="fa-solid fa-rotate"></i> Tap here to view boat photo
                        </button>

                        <div class="info-pill-box">
                            <i class="fa-solid fa-crown"></i>
                            <span>Luxury Cruise | Limited VIP Seating</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Fully Air-Conditioned Lounge</span>
                        </div>
                        <div class="info-pill-box">
                            <i class="fa-regular fa-clock"></i>
                            <span>5:00 PM - 8:30 PM (Approx. 3.5 Hours)</span>
                        </div>

                        <div class="pkg-desc">"The most luxurious cruise on the River Ganga with live entertainment."</div>

                        <div class="pkg-section-title"><i class="fa-solid fa-star"
                                style="color:var(--primary-orange);"></i> Tour Highlights</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-dot"></i> Ultimate VIP Dev Deepawali Experience</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Best Elevated Viewing Deck</li>
                            <li><i class="fa-solid fa-circle-dot"></i> Drone Photography & Cinematic Videos</li>
                        </ul>

                        <div class="pkg-section-title"><i class="fa-solid fa-shield-cat" style="color:#10b981;"></i>
                            Included Services</div>
                        <ul class="pkg-list">
                            <li><i class="fa-solid fa-circle-check"></i> Welcome Drink & Live Snacks Counter</li>
                            <li><i class="fa-solid fa-circle-check"></i> Western Washroom Facility</li>
                            <li><i class="fa-solid fa-circle-check"></i> Premium Hospitality & Staff</li>
                        </ul>
                    </div>
                    <div class="pkg-footer">
                        <a href="{{route('contact')}}" class="btn-primary btn-full">Book Now - ₹8,499</a>
                        <a href="https://wa.me/919214191918" class="btn-whatsapp btn-full"><i
                                class="fa-brands fa-whatsapp"></i> Book via WhatsApp</a>
                    </div>
                </div>

            </div>
        </div>

        <!-- FAQ Section -->
        <div class="container">
            <div class="section-header">
                <div class="sub-title">Got Questions?</div>
                <h2>Frequently Asked Questions</h2>
            </div>

            <div style="max-width: 800px; margin: 0 auto;">
                @foreach($faqs as $faq)
                <div class="faq-item">
                    <div class="faq-question">Q{{ $loop->iteration }}. {{ $faq->question }}</div>
                    <div class="faq-answer">{!! $faq->answer !!}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Gallery Section HTML -->
        <section class="gallery-container">
            <div class="gallery-header">
                <div class="sub-title">Visual Journey</div>
                <h2>Glimpses of <span>Divinity</span></h2>
                <p>Explore the mesmerizing beauty and magical atmosphere of Dev Deepawali in Varanasi.</p>
            </div>

            <div class="gallery-grid">
                @foreach($galleries as $gallery)
                <div class="gallery-item">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title ?? 'Gallery Image' }}">
                    <div class="gallery-overlay">
                        <h4>{{ $gallery->title ?? 'Gallery' }}</h4>
                        @if($gallery->category)
                        <p>{{ $gallery->category }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Floating Quick Buttons -->
        <div class="floating-widgets">
            <a href="https://wa.me/919214191918" class="float-btn float-wa" target="_blank"><i
                    class="fa-brands fa-whatsapp"></i></a>
            <a href="tel:+919214191918" class="float-btn float-call"><i class="fa-solid fa-phone"></i></a>
        </div>
    </div>
@endsection
