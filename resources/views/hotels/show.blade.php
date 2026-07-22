@extends('layouts.app')

@section('content')
    @php
        $banner = $sections['hotel_banner'] ?? $sections->first();
    @endphp

    <!-- Hotel Page Header (GlobeTrek style breadcrumbs with background image) -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ !empty($banner->image) ? asset('storage/' . $banner->image) : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg') }}') center/cover no-repeat !important;">
        <div class="container">
            <div class="text-center mb-3">
                @for($i = 1; $i <= ($hotel->star_rating ?? 5); $i++)
                    <i class="bi bi-star-fill text-warning fs-5 mx-0.5"></i>
                @endfor
            </div>
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $hotel->name }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp text-center text-white opacity-90 mt-2" data-wow-delay="0.2s" data-wow-duration="1s">
                <i class="bi bi-geo-alt-fill text-warning me-1"></i> {{ $hotel->location }}
                @if($hotel->managed_by)
                &nbsp;|&nbsp; <i class="bi bi-shield-check-fill text-warning me-1"></i> Managed by {{ $hotel->managed_by }}
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content & Suites Sidebar -->
    <div class="flat-section bg-light-blue py-6" style="background-color:#f7f9fc;">
        <div class="container">
            <div class="row g-5">
                <!-- Left Details Column -->
                <div class="col-lg-8">
                    <!-- About the Hotel experience -->
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                        <h3 class="fw-bold mb-4 font-family-poppins text-dark">The Experience</h3>
                        <div class="description-content text-muted" style="line-height:1.7; font-size:15px;">
                            {!! $hotel->description ?? 'Experience luxury redefined. Every corner of our property is designed to provide you with the ultimate escape.' !!}
                        </div>
                    </div>

                    <!-- Amenities list -->
                    @if(!empty($hotel->amenities))
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                        <h4 class="fw-bold mb-4 font-family-poppins text-dark">Hotel Amenities</h4>
                        <div class="row g-3">
                            @foreach($hotel->amenities as $amenity)
                                <div class="col-md-4 col-6">
                                    <div class="d-flex align-items-center gap-2 p-3 bg-light rounded-3 border-0" style="transition:0.3s;">
                                        <i class="bi bi-check-circle-fill text-warning fs-5 flex-shrink-0"></i>
                                        <span class="small fw-bold text-dark">{{ $amenity }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Landmarks & Accessibility -->
                    @if(!empty($hotel->landmarks) || !empty($hotel->airports) || !empty($hotel->attractions))
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4 border-top border-warning border-3">
                        <h4 class="fw-bold mb-4 font-family-poppins text-dark">Nearby & Accessibility</h4>
                        <div class="row g-4">
                            @if(!empty($hotel->landmarks))
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                                        <i class="bi bi-map text-warning fs-5"></i> Landmarks
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($hotel->landmarks as $lm)
                                            <li class="d-flex justify-content-between mb-2 small pb-2 border-bottom text-muted">
                                                <span>{{ $lm['name'] ?? '' }}</span>
                                                <span class="fw-bold text-warning">{{ $lm['distance'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(!empty($hotel->airports))
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                                        <i class="bi bi-airplane-engines text-warning fs-5"></i> Airports
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($hotel->airports as $ap)
                                            <li class="d-flex justify-content-between mb-2 small pb-2 border-bottom text-muted">
                                                <span>{{ $ap['name'] ?? '' }}</span>
                                                <span class="fw-bold text-warning">{{ $ap['distance'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(!empty($hotel->attractions))
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                                        <i class="bi bi-camera text-warning fs-5"></i> Attractions
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($hotel->attractions as $att)
                                            <li class="d-flex justify-content-between mb-2 small pb-2 border-bottom text-muted">
                                                <span>{{ $att['name'] ?? '' }}</span>
                                                <span class="fw-bold text-warning">{{ $att['distance'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Location Map -->
                    @if($hotel->map_embed_url)
                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white mb-4">
                        <h4 class="fw-bold mb-4 font-family-poppins text-dark">Location Map</h4>
                        <div class="rounded-3 overflow-hidden shadow-sm" style="height: 350px; border: 1px solid #eee;">
                            <iframe src="{{ $hotel->map_embed_url }}" class="w-100 h-100 border-0" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    @endif

                    <!-- Property Gallery -->
                    @if(!empty($hotel->images) && count($hotel->images) > 1)
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                        <h4 class="fw-bold mb-4 font-family-poppins text-dark">Property Gallery</h4>
                        <div class="row g-3">
                            @foreach(array_slice($hotel->images, 1) as $img)
                                <div class="col-md-6">
                                    <div class="rounded-4 overflow-hidden shadow-sm" style="height: 220px; border: 1px solid #eee;">
                                        <img src="{{ asset('storage/' . $img) }}" class="w-100 h-100 object-fit-cover hover-scale transition-all" style="transition:0.4s;" alt="Gallery">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Suites/Rooms Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 105px; z-index: 5;">
                        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                            <div class="card-header bg-dark text-white p-4 border-0">
                                <h5 class="mb-0 fw-bold d-flex text-dark align-items-center gap-2">
                                    <i class="bi bi-house-heart text-warning fs-4"></i> Available Suites
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    @forelse($hotel->rooms as $room)
                                        <div class="p-4 border-bottom hover-bg-light transition-all" style="transition: 0.25s;">
                                            @if(!empty($room->images))
                                                <div class="rounded-4 overflow-hidden mb-3" style="height: 160px; border:1px solid #eee;">
                                                    <img src="{{ asset('storage/' . $room->images[0]) }}" class="w-100 h-100 object-fit-cover" alt="{{ $room->room_type }}">
                                                </div>
                                            @endif
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="fw-bold mb-0 text-dark font-family-poppins">{{ $room->room_type }}</h6>
                                                <span class="fw-bold text-warning h6 mb-0">₹{{ number_format($room->price) }}<small class="text-muted" style="font-size:11px;">/nt</small></span>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                @if($room->bed_type)
                                                    <span class="badge bg-light text-dark border-0 small px-2 py-1"><i class="bi bi-moon me-1 text-warning"></i>{{ $room->bed_type }}</span>
                                                @endif
                                                @if($room->capacity)
                                                    <span class="badge bg-light text-dark border-0 small px-2 py-1"><i class="bi bi-people me-1 text-warning"></i>{{ $room->capacity }} Guests</span>
                                                @endif
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-dark btn-sm w-100 rounded-pill fw-bold">Details</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('bookings.create', $room) }}" class="tf-btn primary hover-1 btn-sm w-100 rounded-pill fw-bold text-center text-white py-1.5 text-decoration-none">Book</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-5 text-center text-muted">
                                            <i class="bi bi-info-circle fs-2 mb-3 d-block text-warning"></i>
                                            <p class="small fw-bold">No suites are currently open for reservation at this property.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm d-flex gap-3 align-items-center" style="border-left:4px solid #e8900a;">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 text-warning d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-shield-fill-check fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Best Rate Guarantee</h6>
                                <p class="small text-muted mb-0">Book directly with us for the lowest prices and exclusive perks.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
