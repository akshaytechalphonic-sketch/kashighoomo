@extends('layouts.app')

{{-- @section('title', $package->meta_title ?: ($package->title . ' | Kashi Tourism'))
@section('meta_description', $package->meta_description ?: ($page->meta_description ?? ''))
@section('meta_keywords', $package->meta_keywords ?: ($page->meta_keywords ?? '')) --}}

@push('styles')
    <style>
        .collage-main-wrapper img,
        .collage-side-wrapper img {
            transition: transform 0.5s ease;
        }
        .collage-main-wrapper:hover img,
        .collage-side-wrapper:hover img {
            transform: scale(1.02);
        }
        .show-all-photos-btn {
            bottom: 20px;
            right: 20px;
            font-size: 13px;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 10px;
            background: #FFFFFF !important;
            color: #2C2C2C !important;
            border: 1px solid #E8E8E8 !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
            z-index: 10;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.3s;
        }
        .show-all-photos-btn:hover {
            background-color: #FFF8F0 !important;
            border-color: #D4AF37 !important;
            transform: scale(1.02);
        }
        .itinerary-timeline {
            border-left: 2px solid #8B1E1E !important;
        }
        .itinerary-timeline .badge {
            background-color: #8B1E1E !important;
        }
        .itinerary-timeline .rounded-circle {
            background-color: #F57C00 !important;
            border-color: #FFFFFF !important;
        }
        /* Mobile collage responsiveness */
        @media(max-width: 767px) {
            .package-collage-grid .col-md-4 {
                display: none !important;
            }
            .collage-main-wrapper {
                border-radius: 12px !important;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Clean Header Breadcrumb & Title Section -->
    <div class="bg-white py-4 border-bottom" style="margin-top: 85px; border-color: #E8E8E8 !important;">
        <div class="container">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2" style="font-size: 13px;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: #8B1E1E; font-weight: 600;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('packages.index') }}" class="text-decoration-none" style="color: #8B1E1E; font-weight: 600;">Tour Packages</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">{{ $package->title }}</li>
                </ol>
            </nav>
            <!-- Title -->
            <h1 class="fw-extrabold font-family-poppins mb-2" style="font-size: 32px; font-weight: 800; color: #2C2C2C;">
                {{ $package->title }}
            </h1>
            <!-- Ratings & Category Tag Row -->
            <div class="d-flex align-items-center flex-wrap gap-3 text-muted" style="font-size: 13.5px;">
                <div class="d-flex align-items-center text-warning" style="color: #D4AF37 !important;">
                    <i class="bi bi-star-fill me-1"></i>
                    <i class="bi bi-star-fill me-1"></i>
                    <i class="bi bi-star-fill me-1"></i>
                    <i class="bi bi-star-fill me-1"></i>
                    <i class="bi bi-star-fill me-1"></i>
                    <span class="text-dark fw-bold ms-1" style="color: #2C2C2C !important;">5.0</span>
                </div>
                <span>•</span>
                <span class="fw-bold" style="color: #2C2C2C;">318+ Packages Booked</span>
                <span>•</span>
                <span class="badge text-white px-3 py-1 rounded-pill" style="background-color: #8B1E1E;">{{ $package->service->title ?? 'Tour Package' }}</span>
                <span>•</span>
                @if($package->service && (stripos($package->service->title, 'Cab') !== false || stripos($package->service->slug, 'cab') !== false))
                    <span class="fw-bold" style="color: #2C2C2C;">{{ $package->duration }} | Private Cab • Professional Driver • Sightseeing</span>
                @elseif($package->service && (stripos($package->service->title, 'Boat') !== false || stripos($package->service->slug, 'boat') !== false))
                    <span class="fw-bold" style="color: #2C2C2C;">{{ $package->duration }} | Boat Cruise • Ganga Aarti Guide • Life Jackets</span>
                @else
                    <span class="fw-bold" style="color: #2C2C2C;">{{ $package->duration }} | Stay • Cab • Boat Ride</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content & Sidebar Form -->
    <div class="flat-section bg-light-blue py-5" style="background-color:#FFF8F0;">
        <div class="container" style="border-color: #E8E8E8 !important;">
            <!-- Airbnb-style Photo Grid Collage -->
            @php
                $images = !empty($package->images) && count($package->images) > 0 ? $package->images : [];
                $altTexts = is_array($package->alt_text) ? $package->alt_text : [];
                $defaultImages = [
                    'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=1000', // Ganga ghats
                    'https://images.unsplash.com/photo-1561361060-61992518e1b8?auto=format&fit=crop&q=80&w=600',  // Ganga Aarti
                    'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=600'   // Sarnath Stupa
                ];
                
                $displayImages = [];
                for ($i = 0; $i < 3; $i++) {
                    if (isset($images[$i])) {
                        $displayImages[] = asset('storage/' . $images[$i]);
                    } else {
                        $displayImages[] = $defaultImages[$i];
                    }
                }
            @endphp

            <!-- Airbnb-style Photo Grid Collage -->
            <div class="package-collage-grid mb-5">
                <div class="row g-2">
                    <!-- Left Main Image -->
                    <div class="col-md-8 col-12">
                        <div class="collage-main-wrapper position-relative rounded-4 overflow-hidden" style="height: 400px; border: 1px solid #E8E8E8;">
                            <img src="{{ $displayImages[0] }}" class="w-100 h-100 object-fit-cover" alt="{{ (isset($images[0]) && isset($altTexts[$images[0]])) ? $altTexts[$images[0]] : ($package->title . ' - Cover') }}">
                        </div>
                    </div>
                    <!-- Right Stacking Images -->
                    <div class="col-md-4 col-12 d-flex flex-column gap-2">
                        <div class="collage-side-wrapper position-relative rounded-4 overflow-hidden" style="height: 196px; border: 1px solid #E8E8E8;">
                            <img src="{{ $displayImages[1] }}" class="w-100 h-100 object-fit-cover" alt="{{ (isset($images[1]) && isset($altTexts[$images[1]])) ? $altTexts[$images[1]] : ($package->title . ' - Sightseeing') }}">
                        </div>
                        <div class="collage-side-wrapper position-relative rounded-4 overflow-hidden" style="height: 196px; border: 1px solid #E8E8E8;">
                            <img src="{{ $displayImages[2] }}" class="w-100 h-100 object-fit-cover" alt="{{ (isset($images[2]) && isset($altTexts[$images[2]])) ? $altTexts[$images[2]] : ($package->title . ' - Attractions') }}">
                            <button class="btn btn-light position-absolute show-all-photos-btn" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                <i class="bi bi-grid-3x3-gap-fill me-2"></i> Show all {{ max(count($images), 3) }} photos
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row g-5">
                <!-- Left Details Area -->
                <div class="col-lg-8">
                    <!-- Left details start -->

                    <!-- Detail Navigation Tabs (GlobeTrek styled tabs) -->
                    <ul class="nav nav-pills nav-fill border-0 mb-4 bg-white p-2 rounded-4 shadow-sm" id="packageTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active border-0 rounded-3 py-3 fw-bold text-dark" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true" style="transition:0.3s;">
                                <i class="bi bi-card-text me-2"></i> Overview
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link border-0 rounded-3 py-3 fw-bold text-dark" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary" type="button" role="tab" aria-controls="itinerary" aria-selected="false" style="transition:0.3s;">
                                <i class="bi bi-map me-2"></i> Itinerary
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link border-0 rounded-3 py-3 fw-bold text-dark" id="inc-exc-tab" data-bs-toggle="tab" data-bs-target="#inc-exc" type="button" role="tab" aria-controls="inc-exc" aria-selected="false" style="transition:0.3s;">
                                <i class="bi bi-check-circle me-2"></i> Inclusions
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="packageTabsContent">
                        <!-- Overview Content -->
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                                <h3 class="fw-bold mb-4 font-family-poppins text-dark">About This Tour</h3>
                                <div class="description-content text-muted" style="line-height:1.7; font-size:15px;">
                                     {!! html_entity_decode($package->description) !!}
                                </div>
                            </div>
                        </div>

                        <!-- Itinerary Content -->
                        <div class="tab-pane fade" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                            <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                                <h3 class="fw-bold mb-4 font-family-poppins text-dark">Tour Itinerary Plan</h3>
                                
                                @if(!empty($package->itinerary) && count($package->itinerary) > 0)
                                    <div class="itinerary-timeline position-relative ps-4 border-start border-2 ms-2 mt-4" style="border-color:#8B1E1E !important;">
                                        @foreach($package->itinerary as $day)
                                            <div class="itinerary-item position-relative mb-4 pb-2">
                                                <!-- timeline Node dot -->
                                                <div class="position-absolute bg-warning rounded-circle border border-white border-3" style="width: 18px; height: 18px; left: -34px !important; top: 8px;"></div>
                                                
                                                <span class="badge bg-warning text-white fw-bold mb-2">{{ $day['day'] ?? 'Day X' }}</span>
                                                <h5 class="fw-bold mb-2 text-dark font-family-poppins">{{ $day['title'] ?? 'Day Title' }}</h5>
                                                <p class="text-muted mb-0" style="font-size:14px; line-height:1.6;">{{ $day['description'] ?? 'Day details...' }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">Detailed day-by-day itinerary will be provided by our tour expert shortly.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Inclusions & Exclusions Content -->
                        <div class="tab-pane fade" id="inc-exc" role="tabpanel" aria-labelledby="inc-exc-tab">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100 border-top border-success border-3">
                                        <h4 class="fw-bold text-success mb-3"><i class="bi bi-check-circle-fill me-2"></i> What's Included</h4>
                                        @if(!empty($package->inclusions) && count($package->inclusions) > 0)
                                            <ul class="list-unstyled">
                                                @foreach($package->inclusions as $inc)
                                                    <li class="mb-3 d-flex align-items-start gap-2">
                                                        <i class="bi bi-check-lg text-success mt-1"></i>
                                                        <span class="text-muted" style="font-size:14px;">{{ $inc }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted small">Standard inclusions apply. Please enquire for details.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100 border-top border-danger border-3">
                                        <h4 class="fw-bold text-danger mb-3"><i class="bi bi-x-circle-fill me-2"></i> What's Excluded</h4>
                                        @if(!empty($package->exclusions) && count($package->exclusions) > 0)
                                            <ul class="list-unstyled">
                                                @foreach($package->exclusions as $exc)
                                                    <li class="mb-3 d-flex align-items-start gap-2">
                                                        <i class="bi bi-x-lg text-danger mt-1"></i>
                                                        <span class="text-muted" style="font-size:14px;">{{ $exc }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted small">Personal expenses, travel insurance, and extra amenities are excluded.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Form -->
                <div class="col-lg-4">
                    <!-- Enquiry Form Card -->
                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white sticky-top" style="top: 105px; z-index: 5;">
                        <h4 class="fw-bold mb-1 text-dark font-family-poppins">
                            <i class="bi bi-calendar-check me-2" style="color: #D4AF37 !important;"></i> 
                            @if($package->service && (stripos($package->service->title, 'Cab') !== false || stripos($package->service->slug, 'cab') !== false))
                                Book Cab Tour
                            @elseif($package->service && (stripos($package->service->title, 'Boat') !== false || stripos($package->service->slug, 'boat') !== false))
                                Book Boat Ride
                            @else
                                Book This Tour
                            @endif
                        </h4>
                        <p class="text-muted mb-4" style="font-size:13px;">Starting From: <strong class="h5 fw-bold" style="color: #D4AF37 !important;">₹{{ number_format($package->price) }}</strong> / person</p>
                        
                        <form action="{{ route('packages.enquire', $package) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark mb-1" style="font-size:12px;">Full Name *</label>
                                <input type="text" name="name" class="form-control bg-light border-0 py-2.5 rounded-3" placeholder="John Doe" required value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark mb-1" style="font-size:12px;">Email Address *</label>
                                <input type="email" name="email" class="form-control bg-light border-0 py-2.5 rounded-3" placeholder="john@example.com" required value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark mb-1" style="font-size:12px;">Phone Number *</label>
                                <input type="text" name="phone" class="form-control bg-light border-0 py-2.5 rounded-3" placeholder="Phone number" required value="{{ old('phone') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark mb-1" style="font-size:12px;">Preferred Travel Date *</label>
                                <input type="date" name="travel_date" class="form-control bg-light border-0 py-2.5 rounded-3" required min="{{ date('Y-m-d') }}" value="{{ old('travel_date') }}">
                            </div>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-bold text-dark mb-1" style="font-size:12px;">Adults *</label>
                                    <input type="number" name="adults" class="form-control bg-light border-0 py-2.5 rounded-3" min="1" value="{{ old('adults', 2) }}" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-bold text-dark mb-1" style="font-size:12px;">Children</label>
                                    <input type="number" name="children" class="form-control bg-light border-0 py-2.5 rounded-3" min="0" value="{{ old('children', 0) }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark mb-1" style="font-size:12px;">Special Requests / Messages</label>
                                <textarea name="message" class="form-control bg-light border-0 py-2 rounded-3" rows="3" placeholder="Tell us if you need extra cabs, customization, hotel upgrades...">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="w-100 tf-btn primary hover-1 py-3 text-white border-0 rounded-pill fw-bold">
                                Submit Booking Enquiry
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Related Packages Slider -->
            @if($relatedPackages->count() > 0)
            <div class="py-5 mt-5">
                <h3 class="fw-bold mb-4 font-family-poppins text-dark">Other Packages You Might Like</h3>
                <div class="row g-4">
                    @foreach($relatedPackages as $rp)
                    <div class="col-lg-4 col-md-6">
                        <div class="item hover-img bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100 d-flex flex-column">
                            <div class="position-relative" style="height:190px;">
                                <a href="{{ route('packages.show', $rp->slug) }}" class="d-block w-100 h-100">
                                    <img src="{{ !empty($rp->images) ? asset('storage/'.$rp->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800' }}" class="w-100 h-100 object-fit-cover" alt="{{ (!empty($rp->images) && is_array($rp->alt_text) && isset($rp->alt_text[$rp->images[0]])) ? $rp->alt_text[$rp->images[0]] : $rp->title }}">
                                </a>
                                <div class="position-absolute text-white rounded-pill px-3 py-1 fw-bold" style="background-color: #F57C00 !important; top:12px; right:12px; font-size:10px;">
                                    {{ $rp->duration }}
                                </div>
                            </div>
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <h5 class="fw-bold mb-2 text-dark font-family-poppins">{{ $rp->title }}</h5>
                                <div class="d-flex align-items-center justify-content-between mt-auto border-top pt-3">
                                    <span class="fw-bold text-dark font-size-16">₹{{ number_format($rp->price) }}</span>
                                    <a href="{{ route('packages.show', $rp->slug) }}" class="tf-btn primary hover-1 px-3 py-1.5 rounded-pill font-size-12 text-white text-decoration-none">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Gallery Modal for "Show all photos" -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content rounded-4 border-0 mt-5 shadow-lg" style="background-color: #FFF8F0;">
                <div class="modal-header border-bottom" style="border-color: #E8E8E8 !important;">
                    <h5 class="modal-title fw-bold font-family-poppins" id="galleryModalLabel" style="color: #2C2C2C;">All Tour Photos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row g-3">
                        @if(count($images) > 0)
                            @foreach($images as $img)
                                <div class="col-md-6 col-12">
                                    <div class="rounded-3 overflow-hidden shadow-sm h-100" style="border: 1px solid #E8E8E8;">
                                        <img src="{{ asset('storage/'.$img) }}" class="w-100 h-100 object-fit-cover" style="min-height: 250px;" alt="{{ (is_array($package->alt_text) && isset($package->alt_text[$img])) ? $package->alt_text[$img] : ($package->title . ' - Gallery Photo') }}">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($defaultImages as $dimg)
                                <div class="col-md-6 col-12">
                                    <div class="rounded-3 overflow-hidden shadow-sm h-100" style="border: 1px solid #E8E8E8;">
                                        <img src="{{ $dimg }}" class="w-100 h-100 object-fit-cover" style="min-height: 250px;" alt="Tour photo">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
