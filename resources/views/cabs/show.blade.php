@extends('layouts.app')

@push('styles')
<style>
/* ===== CAB DETAIL BANNER ===== */
.cab-hero {
    position: relative;
    min-height: 580px;
    display: flex;
    align-items: flex-end;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    overflow: hidden;
}

/* dark gradient overlay - stronger at bottom */
.cab-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(11,34,64,0.35) 0%,
        rgba(11,34,64,0.55) 40%,
        rgba(11,34,64,0.92) 100%
    );
    z-index: 1;
}

/* subtle red accent line at top */
.cab-hero::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(to right, #e8900a, #ff4444, #e8900a);
    z-index: 3;
}

.cab-hero-content {
    position: relative;
    z-index: 2;
    padding-bottom: 56px;
    padding-top: 48px;
    width: 100%;
}

/* Breadcrumb in hero */
.hero-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    flex-wrap: wrap;
}
.hero-breadcrumb a,
.hero-breadcrumb span {
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    color: rgba(255,255,255,0.65);
    text-decoration: none;
    transition: color 0.2s;
}
.hero-breadcrumb a:hover { color: #fff; }
.hero-breadcrumb .sep { color: rgba(255,255,255,0.3); }
.hero-breadcrumb .current { color: rgba(255,255,255,0.9); }

/* Category pill */
.cab-category-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(201,0,0,0.25);
    border: 1px solid rgba(201,0,0,0.5);
    color: #ffaaaa;
    padding: 5px 16px;
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 16px;
}

.cab-hero h1 {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.1;
    margin-bottom: 16px;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
}

.cab-hero-desc {
    color: rgba(255,255,255,0.78);
    font-size: 1rem;
    max-width: 600px;
    line-height: 1.7;
    margin-bottom: 28px;
}

/* Stats strip at bottom of banner */
.hero-stats-strip {
    display: flex;
    gap: 32px;
    flex-wrap: wrap;
}
.hero-stat {
    display: flex;
    align-items: center;
    gap: 10px;
}
.hero-stat-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: rgba(255,255,255,0.12);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    color: #ffaaaa;
    flex-shrink: 0;
}
.hero-stat-text strong {
    display: block;
    color: #fff;
    font-size: 0.92rem;
    font-weight: 700;
    line-height: 1.2;
}
.hero-stat-text span {
    color: rgba(255,255,255,0.5);
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* CTA buttons in hero */
.hero-cta-row {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 36px;
}
.btn-hero-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #e8900a;
    color: #fff;
    font-weight: 700;
    font-size: 0.88rem;
    letter-spacing: 0.5px;
    padding: 12px 28px;
    border-radius: 50px;
    text-decoration: none;
    border: none;
    box-shadow: 0 8px 24px rgba(201,0,0,0.35);
    transition: all 0.3s;
}
.btn-hero-primary:hover {
    background: #be7007;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(201,0,0,0.45);
}
.btn-hero-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.12);
    color: #fff;
    font-weight: 600;
    font-size: 0.88rem;
    padding: 12px 28px;
    border-radius: 50px;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.35);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    transition: all 0.3s;
}
.btn-hero-outline:hover {
    background: rgba(255,255,255,0.22);
    color: #fff;
    border-color: rgba(255,255,255,0.6);
}

/* divider line in stats */
.hero-divider {
    width: 1px;
    height: 36px;
    background: rgba(255,255,255,0.15);
    display: none;
}
@media (min-width: 576px) { .hero-divider { display: block; } }
/* Individual card */
.pkg-card-item {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 3px 16px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.pkg-card-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 40px rgba(0,0,0,0.1);
}
.pkg-card-img {
    position: relative;
    height: 220px;
    overflow: hidden;
    flex-shrink: 0;
}
.pkg-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.pkg-card-item:hover .pkg-card-img img { transform: scale(1.05); }
.pkg-img-badge {
    position: absolute;
    z-index: 3;
    font-size: 9.5px;
    font-weight: 800;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 50px;
}
.pkg-img-badge.diff {
    top: 12px; left: 12px;
    background: rgba(5,20,33,0.82);
    color: #fff;
}
.pkg-img-badge.dur {
    top: 12px; right: 12px;
    background: #F57C00;
    color: #fff;
}
.pkg-card-body {
    padding: 20px 18px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.pkg-card-dest {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}
.pkg-card-dest .dest-name {
    font-size: 11.5px;
    color: #888;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}
.pkg-card-dest .dest-name i { color: #F57C00; font-size: 11px; }
.pkg-card-dest .season {
    font-size: 11px;
    color: #aaa;
    display: flex;
    align-items: center;
    gap: 3px;
}
.pkg-card-dest .season i { color: #F57C00; font-size: 10px; }
.pkg-card-title {
    font-size: 0.97rem !important;
    font-weight: 700 !important;
    color: #0b1a29 !important;
    line-height: 1.4 !important;
    margin-bottom: 8px !important;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-decoration: none;
}
.pkg-card-title:hover { color: #F57C00 !important; text-decoration: none; }
.pkg-card-desc {
    font-size: 0.8rem !important;
    color: #888 !important;
    line-height: 1.55 !important;
    margin-bottom: 16px !important;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex-grow: 1;
}
.pkg-card-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid #f2f2f2;
    margin-top: auto;
    gap: 8px;
    flex-wrap: wrap;
}
.pkg-price-block .from-label {
    font-size: 9.5px;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 1px;
}
.pkg-price-block .price-val {
    font-size: 1.15rem;
    font-weight: 800;
    color: #0b1a29;
    line-height: 1;
}
.pkg-card-actions {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}
.pkg-icon-btn {
    width: 34px; height: 34px;
    border-radius: 50%;
    border: 1.5px solid #e5e5e5;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    text-decoration: none;
    transition: all 0.2s;
    flex-shrink: 0;
}
.pkg-icon-btn.call { color: #dc3545; }
.pkg-icon-btn.call:hover { background: #dc3545; border-color: #dc3545; color: #fff; }
.pkg-icon-btn.wa { color: #25D366; }
.pkg-icon-btn.wa:hover { background: #25D366; border-color: #25D366; color: #fff; }
.pkg-details-btn {
    background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);
    color: #fff !important;
    font-size: 12px;
    font-weight: 700;
    padding: 7px 16px;
    border-radius: 8px;
    text-decoration: none !important;
    transition: all 0.2s;
    white-space: nowrap;
}
.pkg-details-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245,124,0,0.3);
}

/* Grid layout */
.pkg-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
@media (max-width: 991px) {
    .pkg-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 767px) {
    .pkg-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
@media (max-width: 480px) {
    .pkg-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

{{-- ===== HERO BANNER ===== --}}
@php
    $coverImg = !empty($cab->images) && count($cab->images) > 0 ? asset('storage/' . $cab->images[0]) : 'https://images.unsplash.com/photo-1549268955-4422e5f296c0?auto=format&fit=crop&q=80&w=1200';
@endphp
<div class="cab-hero" style="background-image: url('{{ $coverImg }}');">

    <div class="container cab-hero-content">

        {{-- Breadcrumb --}}
        <nav class="hero-breadcrumb">
            <a href="{{ route('home') }}"><i class="bi bi-house-fill me-1"></i>Home</a>
            <span class="sep">/</span>
            <a href="{{ route('cabs.index') }}">Cabs</a>
            <span class="sep">/</span>
            <span class="current">{{ $cab->cab_name }}</span>
        </nav>

        {{-- Category pill --}}
        <div class="cab-category-pill">
            <i class="bi bi-stars"></i> {{ $cab->vehicle_type }}
        </div>

        {{-- Title --}}
        <h1 class="text-white">{{ $cab->cab_name }}</h1>

        {{-- Price starts from --}}
        <p class="cab-hero-desc">
            Rates start from <strong>₹{{ number_format($cab->price) }} / day</strong>. High-quality, safe, and air-conditioned travel package transfers in Varanasi and outstation tours.
        </p>

        {{-- CTA Buttons --}}
        <div class="hero-cta-row">
            <button type="button" class="btn-hero-primary" data-bs-toggle="modal" data-bs-target="#enquiryModal{{ $cab->id }}">
                <i class="bi bi-telephone"></i> Book / Enquire Now
            </button>
            <a href="#packages" class="btn-hero-outline">
                <i class="bi bi-compass"></i> View Tour Packages
            </a>
        </div>

        {{-- Stats strip --}}
        <div class="hero-stats-strip">
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-people"></i></div>
                <div class="hero-stat-text">
                    <strong>{{ $cab->seating_capacity }} Seater</strong>
                    <span>Capacity</span>
                </div>
            </div>
            <div class="hero-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-box-seam"></i></div>
                <div class="hero-stat-text">
                    <strong>{{ $packages->total() }} Package{{ $packages->total() != 1 ? 's' : '' }}</strong>
                    <span>Using this Cab</span>
                </div>
            </div>
            <div class="hero-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-shield-check"></i></div>
                <div class="hero-stat-text">
                    <strong>100% Safe</strong>
                    <span>Verified Chauffeurs</span>
                </div>
            </div>
            <div class="hero-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-currency-rupee"></i></div>
                <div class="hero-stat-text">
                    <strong>Best Rate</strong>
                    <span>No Hidden Fees</span>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div class="container py-5 mt-2" id="packages">
    <div class="row g-5">
        <div class="col-lg-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-5 p-4 d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-3 fs-3 text-success"></i>
                <div>
                    <h5 class="alert-heading fw-bold mb-1">Thank You!</h5>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <h2 class="fw-bold text-navy mb-4">
                About <span style="color:#e8900a;">{{ $cab->cab_name }}</span> Service
            </h2>
            <div class=" mb-5">
                {!! $cab->description !!}
            </div>

            <!-- Packages List Section -->
            <div class="mt-5">
                <h3 class="fw-bold mb-4 pb-2 border-bottom text-black">Available Tour Packages with {{ $cab->cab_name }}</h3>

                <div class="pkg-grid">
                    @forelse($packages as $package)
                    @php
                        $fallbacks = [
                            'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800',
                        ];
                        $imgUrl = ($package->images && count($package->images) > 0)
                            ? asset('storage/' . $package->images[0])
                            : $fallbacks[$loop->index % 3];
                    @endphp
                    <div class="pkg-card-item">
                        <div class="pkg-card-img">
                            <a href="{{ route('packages.show', $package->slug) }}" class="d-block w-100 h-100">
                                <img src="{{ $imgUrl }}" alt="{{ (!empty($package->images) && is_array($package->alt_text) && isset($package->alt_text[$package->images[0]])) ? $package->alt_text[$package->images[0]] : $package->title }}">
                            </a>
                            @if($package->difficulty)
                                <span class="pkg-img-badge diff">{{ $package->difficulty }}</span>
                            @endif
                            @if($package->duration)
                                <span class="pkg-img-badge dur"><i class="bi bi-clock me-1"></i>{{ $package->duration }}</span>
                            @endif
                        </div>
                        <div class="pkg-card-body">
                            <div class="pkg-card-dest">
                                <span class="dest-name">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    {{ $package->destination?->name ?? 'Kashi' }}
                                </span>
                                @if($package->best_season)
                                <span class="season"><i class="bi bi-sun"></i> {{ $package->best_season }}</span>
                                @endif
                            </div>
                            <a href="{{ route('packages.show', $package->slug) }}" class="pkg-card-title d-block">
                                {{ $package->title }}
                            </a>
                            <p class="pkg-card-desc">
                                {{ Str::limit(strip_tags($package->description), 100) }}
                            </p>
                            <div class="pkg-card-foot">
                                <div class="pkg-price-block">
                                    <span class="from-label">From</span>
                                    <span class="price-val">₹{{ number_format($package->price) }}</span>
                                </div>
                                <div class="pkg-card-actions">
                                    @if($settings->contact_phone)
                                    <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}"
                                       class="pkg-icon-btn call" title="Call Us">
                                        <i class="bi bi-telephone-fill"></i>
                                    </a>
                                    @endif
                                    @if($settings->whatsapp_number)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}"
                                       target="_blank" class="pkg-icon-btn wa" title="WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('packages.show', $package->slug) }}" class="pkg-details-btn">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="pkg-empty" style="grid-column: 1 / -1; background: #fff; border-radius: 20px; padding: 70px 30px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                        <i class="bi bi-emoji-frown" style="font-size: 3rem; color: #ddd; display: block; margin-bottom: 16px;"></i>
                        <h4 style="font-weight:700; color:#444;">No packages associated with this cab model</h4>
                        <p style="color:#aaa; font-size:.88rem;">
                            Please check back later or explore other packages.
                        </p>
                    </div>
                    @endforelse
                </div>

                @if($packages->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $packages->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Enquiry Modal -->
<div class="modal fade" id="enquiryModal{{ $cab->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-bottom p-4 bg-light">
                <div>
                    <h5 class="modal-title fw-bold text-dark font-family-poppins">Enquire for {{ $cab->cab_name }}</h5>
                    <span class="small text-muted" style="font-size:12px;">Submit details to get an instant customized quote.</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cabs.enquire', $cab->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label small fw-bold">Full Name *</label>
                            <input type="text" name="name" class="form-control rounded-3" placeholder="Enter your name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address *</label>
                            <input type="email" name="email" class="form-control rounded-3" placeholder="name@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Phone Number *</label>
                            <input type="tel" name="phone" class="form-control rounded-3" placeholder="e.g. +91 99999 99999" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Travel Date *</label>
                            <input type="date" name="travel_date" class="form-control rounded-3" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Adults *</label>
                            <input type="number" name="adults" class="form-control rounded-3" min="1" max="50" value="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Children</label>
                            <input type="number" name="children" class="form-control rounded-3" min="0" max="50" value="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Special Requests / Itinerary</label>
                            <textarea name="message" class="form-control rounded-3" rows="3" placeholder="Let us know if you need airport transfer, Sarnath sightseeing, multi-day yatra, etc."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-top bg-light">
                    <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="tf-btn primary hover-1 px-4 py-2 rounded-pill text-white border-0 fw-bold">Submit Enquiry</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
