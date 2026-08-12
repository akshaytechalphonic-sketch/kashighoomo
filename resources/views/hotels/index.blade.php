@extends('layouts.app')

@section('content')
    <!-- Page Title / Banner -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $sections['hotel_banner']->image ? asset('storage/'.$sections['hotel_banner']->image) : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg') }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $sections['hotel_banner']->title ?? 'Our Signature Hotels' }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                <div class="text-center justify-content-center text-white opacity-75">
                    {!! strip_tags($sections['hotel_banner']->description ?? 'Discover the perfect blend of architectural grandeur and refined comfort across our premium properties.') !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Search Overlay & Listings -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
            <!-- Search Form -->
            {{-- <div class="form-s1 shadow-sm bg-white p-4 rounded-pill mb-5 max-w-800 mx-auto border border-light">
                <form action="{{ route('hotels.index') }}" method="GET">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-9 px-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-search text-warning me-3 fs-5"></i>
                                <input type="text" name="location" class="form-control border-0 shadow-none p-0 fw-semibold text-dark bg-transparent" placeholder="Search by destination or hotel name..." value="{{ request('location') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="w-100 tf-btn primary hover-1 py-2.5 rounded-pill text-center border-0 text-white fw-bold">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div> --}}

            <!-- Hotels Grid -->
            <div class="row g-4">
                @forelse($hotels as $hotel)
                <div class="col-lg-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-duration="1s">
                    <div class="item hover-img bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100 d-flex flex-column">
                        <div class="archive-top position-relative overflow-hidden" style="height:230px;">
                            <a href="{{ route('hotels.show', $hotel->slug) }}" class="images-group img-style d-block h-100">
                                @php
                                    $coverImage = !empty($hotel->images) ? asset('storage/'.$hotel->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800';
                                @endphp
                                <img src="{{ $coverImage }}" alt="{{ (!empty($hotel->images) && is_array($hotel->alt_text) && isset($hotel->alt_text[$hotel->images[0]])) ? $hotel->alt_text[$hotel->images[0]] : $hotel->name }}" class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;">
                            </a>
                            <div class="position-absolute bg-white text-dark rounded-pill px-3 py-1 fw-bold shadow-sm d-flex align-items-center gap-1" style="top:12px; left:12px; font-size:11.5px; z-index:5;">
                                <i class="bi bi-star-fill text-warning"></i> 4.9
                            </div>
                        </div>
                        <div class="archive-bottom p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small fw-semibold mb-2">
                                <i class="bi bi-geo-alt-fill me-1" style="color: #e8900a;"></i>
                                {{ $hotel->location }}
                            </div>
                            <h3 class="tour-title h5 mb-3 fw-bold">
                                <a href="{{ route('hotels.show', $hotel->slug) }}" class="link text-dark text-decoration-none hover-warning transition-all">{{ $hotel->name }}</a>
                            </h3>
                            <p class="text-muted flex-grow-1" style="font-size:13.5px; line-height:1.5;">
                                {{ Str::limit(strip_tags($hotel->description), 110) }}
                            </p>
                            
                            <!-- Amenities -->
                            <div class="d-flex gap-3 mb-4 text-muted border-top border-bottom py-3 mt-3" style="font-size: 14px;">
                                <span title="Free WiFi"><i class="bi bi-wifi text-warning me-1"></i> WiFi</span>
                                <span title="Water Supply"><i class="bi bi-water text-warning me-1"></i> Water</span>
                                <span title="Secure Parking"><i class="bi bi-car-front text-warning me-1"></i> Parking</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="price">
                                    <span class="text-muted" style="font-size:11px; display:block; text-transform:uppercase;">Rates From</span>
                                    <span class="fw-extrabold text-primary h4 mb-0" style="color:#061624;">₹{{ rand(2999, 5999) }}</span>
                                    <small class="text-muted" style="font-size:10px;">/nt</small>
                                </div>
                                <a href="{{ route('hotels.show', $hotel->slug) }}" class="tf-btn primary hover-1 px-4 py-2 rounded-pill font-size-13 text-white text-decoration-none">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 border shadow-sm max-w-800 mx-auto">
                        <i class="bi bi-emoji-frown fs-1 text-muted mb-3 d-block"></i>
                        <h4 class="fw-bold">No Hotels Found</h4>
                        <p class="text-muted">No accommodation matched your search parameters. Try searching for general areas.</p>
                        <a href="{{ route('hotels.index') }}" class="tf-btn primary hover-1 px-4 py-2.5 rounded-pill text-white text-decoration-none d-inline-block mt-3">Reset Search</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($hotels->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $hotels->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .max-w-800 { max-width: 800px; }
    </style>
@endsection
