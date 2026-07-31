@extends('layouts.app')

@push('styles')
<style>
/* ===== PACKAGES INDEX PAGE ===== */

/* Banner */
.pkg-banner {
    position: relative;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 82px;
    overflow: hidden;
}
.pkg-banner-bg {
    position: absolute;
    inset: 0;
    background-size: cover !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
}
.pkg-banner-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(5,20,33,0.88) 0%, rgba(5,20,33,0.72) 55%, rgba(100,30,0,0.50) 100%);
}
.pkg-banner-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 65px 20px 55px;
    width: 100%;
}
.pkg-banner-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(245,124,0,0.15);
    border: 1px solid rgba(245,124,0,0.32);
    color: #F57C00;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 6px 18px;
    border-radius: 50px;
    margin-bottom: 16px;
}
.pkg-banner-title {
    font-size: clamp(1.65rem, 4vw, 2.7rem) !important;
    font-weight: 700 !important;
    color: #fff !important;
    line-height: 1.2 !important;
    margin: 0 0 12px !important;
}
.pkg-banner-desc {
    color: rgba(255,255,255,0.62) !important;
    font-size: 0.93rem !important;
    max-width: 540px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Page body */
.pkg-body {
    background: #f5f0ea;
    padding: 48px 0 72px;
}

/* Filter bar */
.pkg-filter-bar {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px 26px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    margin-bottom: 44px;
    border: 1px solid #ebebeb;
}
.pkg-filter-bar .filter-label {
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #555;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.pkg-filter-bar .filter-label i { color: #F57C00; }
.pkg-filter-bar select {
    width: 100%;
    height: 42px;
    padding: 0 12px;
    border: 1.5px solid #e5e5e5;
    border-radius: 9px;
    font-size: 13.5px;
    font-weight: 500;
    color: #333;
    background: #fafafa;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23999' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 32px;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
    box-shadow: none !important;
}
.pkg-filter-bar select:focus {
    border-color: #F57C00;
    box-shadow: 0 0 0 3px rgba(245,124,0,0.08) !important;
    background-color: #fff;
}
.pkg-filter-btn {
    width: 100%;
    height: 42px;
    background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);
    color: #ffffff;
    border: none;
    border-radius: 9px;
    font-size: 13.5px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 4px 14px rgba(245,124,0,0.25);
    text-decoration: none;
}
.pkg-filter-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(245,124,0,0.35);
    color: #fff;
}
.pkg-reset-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11.5px;
    color: #aaa;
    text-decoration: none;
    margin-top: 8px;
    transition: color 0.2s;
}
.pkg-reset-link:hover { color: #F57C00; text-decoration: none; }

/* Active filter pills */
.pkg-active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 24px;
}
.pkg-filter-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #fff8f0;
    border: 1px solid rgba(245,124,0,0.25);
    color: #F57C00;
    font-size: 11.5px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 50px;
}
.pkg-filter-pill i { font-size: 9px; }

/* Results count */
.pkg-results-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 26px;
    flex-wrap: wrap;
    gap: 8px;
}
.pkg-results-count {
    font-size: 13px;
    color: #888;
    font-weight: 500;
}
.pkg-results-count strong { color: #0b1a29; }

/* Package cards grid */
.pkg-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}

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

/* Empty state */
.pkg-empty {
    background: #fff;
    border-radius: 20px;
    padding: 70px 30px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    grid-column: 1 / -1;
}
.pkg-empty i { font-size: 3rem; color: #ddd; display: block; margin-bottom: 16px; }

/* Pagination */
nav.pkg-pagination ul {
    display: flex !important;
    list-style: none !important;
    gap: 6px;
    justify-content: center;
    flex-wrap: wrap;
    padding: 0 !important;
    margin: 0 !important;
}
nav.pkg-pagination ul li a,
nav.pkg-pagination ul li span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 38px; height: 38px;
    padding: 0 10px;
    border-radius: 9px;
    border: 1.5px solid #e5e5e5;
    font-size: 13px;
    font-weight: 600;
    color: #333;
    text-decoration: none;
    transition: all 0.2s;
    background: #fff;
}
nav.pkg-pagination ul li a:hover { background: #fff8f0; border-color: #F57C00; color: #F57C00; }
nav.pkg-pagination ul li.active span,
nav.pkg-pagination ul li span[aria-current] {
    background: #F57C00 !important;
    border-color: #F57C00 !important;
    color: #fff !important;
}

/* Responsive */
@media (max-width: 991px) {
    .pkg-banner { margin-top: 76px; min-height: 270px; }
    .pkg-grid { grid-template-columns: repeat(2, 1fr); }
    .pkg-filter-bar { padding: 18px 20px; }
}
@media (max-width: 767px) {
    .pkg-banner { margin-top: 72px; min-height: 240px; }
    .pkg-banner-content { padding: 48px 16px 40px; }
    .pkg-body { padding: 30px 0 50px; }
    .pkg-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .pkg-card-img { height: 180px; }
}
@media (max-width: 480px) {
    .pkg-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
@php
    $bannerSection = $sections->get('package_banner');
    $pkgBg    = $bannerSection?->image ? asset('storage/' . $bannerSection->image) : null;
    $pkgTitle = $bannerSection?->title ?: 'Kashi Tour Packages';
    $pkgDesc  = $bannerSection?->description ?: 'Explore handpicked premium tours and spiritual itineraries across Kashi.';

    // Resolve the destination from the route parameter 'slug' or the 'destination_id' query parameter
    $selectedDestId = request('destination_id');
    $routeSlug = request()->route('slug');
    
    // Active filter labels for pills
    $activeFilters = [];
    if ($routeSlug) {
        $activeDest = $destinations->firstWhere('slug', $routeSlug);
        if ($activeDest) {
            $selectedDestId = $activeDest->id;
            $activeFilters[] = ['icon' => 'bi-geo-alt-fill', 'label' => $activeDest->name];
        }
    } elseif ($selectedDestId) {
        $activeDest = $destinations->firstWhere('id', $selectedDestId);
        if ($activeDest) {
            $activeFilters[] = ['icon' => 'bi-geo-alt-fill', 'label' => $activeDest->name];
        }
    }

    if(request('service_id')) {
        $activeSvc = $services->firstWhere('id', request('service_id'));
        if($activeSvc) $activeFilters[] = ['icon' => 'bi-compass-fill', 'label' => $activeSvc->title];
    }
    if(request('difficulty')) {
        $activeFilters[] = ['icon' => 'bi-activity', 'label' => request('difficulty')];
    }
    $hasFilters = count($activeFilters) > 0;
@endphp

{{-- ===== BANNER ===== --}}
<div class="pkg-banner">
    <div class="pkg-banner-bg"
         style="background: {{ $pkgBg ? "url('{$pkgBg}')" : "linear-gradient(135deg,#0b1a29,#1a3a5c)" }} center/cover no-repeat;">
    </div>
    <div class="pkg-banner-content">
        <div class="pkg-banner-eyebrow"><i class="bi bi-grid-fill"></i> Tour Packages</div>
        <h1 class="pkg-banner-title">{{ $pkgTitle }}</h1>
        <p class="pkg-banner-desc">{!! strip_tags($pkgDesc) !!}</p>
    </div>
</div>

{{-- ===== PAGE BODY ===== --}}
<div class="pkg-body">
    <div class="container">

        {{-- ===== FILTER BAR ===== --}}
        <div class="pkg-filter-bar">
            <form action="{{ route('packages.index') }}" method="GET" id="pkgFilterForm">
                <div class="row g-3 align-items-end">

                    {{-- Destination --}}
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="filter-label">
                            <i class="bi bi-geo-alt-fill"></i> Destination
                        </label>
                        <select name="destination_id">
                            <option value="">All Destinations</option>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest->id }}" {{ $selectedDestId == $dest->id ? 'selected' : '' }}>
                                    {{ $dest->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category / Service --}}
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="filter-label">
                            <i class="bi bi-compass-fill"></i> Category / Service
                        </label>
                        <select name="service_id">
                            <option value="">All Categories</option>
                            @foreach($services as $srv)
                                <option value="{{ $srv->id }}" {{ request('service_id') == $srv->id ? 'selected' : '' }}>
                                    {{ $srv->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Difficulty --}}
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="filter-label">
                            <i class="bi bi-activity"></i> Difficulty
                        </label>
                        <select name="difficulty">
                            <option value="">All Difficulties</option>
                            <option value="Easy"     {{ request('difficulty') == 'Easy'     ? 'selected' : '' }}>Easy</option>
                            <option value="Moderate" {{ request('difficulty') == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                            <option value="Hard"     {{ request('difficulty') == 'Hard'     ? 'selected' : '' }}>Hard</option>
                        </select>
                    </div>

                    {{-- Submit --}}
                    <div class="col-lg-3 col-md-6 col-12">
                        <button type="submit" class="pkg-filter-btn">
                            <i class="bi bi-funnel-fill"></i> Apply Filters
                        </button>
                        @if($hasFilters)
                            <a href="{{ route('packages.index') }}" class="pkg-reset-link">
                                <i class="bi bi-x-circle"></i> Clear filters
                            </a>
                        @endif
                    </div>

                </div>
            </form>
        </div>

        {{-- Active filter pills --}}
        @if($hasFilters)
        <div class="pkg-active-filters">
            <span style="font-size:11.5px; color:#888; font-weight:600; align-self:center;">Filtering by:</span>
            @foreach($activeFilters as $f)
            <span class="pkg-filter-pill"><i class="bi {{ $f['icon'] }}"></i> {{ $f['label'] }}</span>
            @endforeach
        </div>
        @endif

        {{-- Results count --}}
        <div class="pkg-results-bar">
            <p class="pkg-results-count">
                Showing <strong>{{ $packages->firstItem() ?? 0 }}–{{ $packages->lastItem() ?? 0 }}</strong>
                of <strong>{{ $packages->total() }}</strong> package{{ $packages->total() !== 1 ? 's' : '' }}
            </p>
        </div>

        {{-- ===== PACKAGES GRID ===== --}}
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
            <div class="pkg-empty">
                <i class="bi bi-emoji-frown"></i>
                <h4 style="font-weight:700; color:#444;">No packages match your filters</h4>
                <p style="color:#aaa; font-size:.88rem; margin-bottom:20px;">
                    Try removing some filters or browse all packages.
                </p>
                <a href="{{ route('packages.index') }}"
                   style="display:inline-flex; align-items:center; gap:7px; background:#F57C00; color:#fff; padding:10px 24px; border-radius:9px; font-weight:700; font-size:13px; text-decoration:none;">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset Filters
                </a>
            </div>
            @endforelse
        </div>

        {{-- ===== PAGINATION ===== --}}
        @if($packages->hasPages())
        <nav class="pkg-pagination">{{ $packages->links() }}</nav>
        @endif

    </div>
</div>
@endsection
