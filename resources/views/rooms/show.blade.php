@extends('layouts.app')

@section('content')
@php
    $primaryImage = !empty($room->images) ? asset('storage/'.$room->images[0]) : 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&q=80&w=1200';
    $galleryImages = !empty($room->images) ? $room->images : [];
    $ratePlanLabels = [
        'non_refundable' => ['label' => 'Non-Refundable', 'color' => '#dc3545', 'icon' => 'lock'],
        'flexible'       => ['label' => 'Free Cancellation', 'color' => '#198754', 'icon' => 'shield-check'],
        'bb'             => ['label' => 'Bed & Breakfast', 'color' => '#0dcaf0', 'icon' => 'coffee'],
        'half_board'     => ['label' => 'Half Board', 'color' => '#0d6efd', 'icon' => 'utensils'],
        'full_board'     => ['label' => 'Full Board', 'color' => '#ffc107', 'icon' => 'shopping-basket'],
        'package'        => ['label' => 'Special Package', 'color' => '#6c757d', 'icon' => 'gift'],
    ];
@endphp

    <!-- Page Title / Banner -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $primaryImage }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $room->room_type }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp text-center text-white opacity-90 mt-2" data-wow-delay="0.2s" data-wow-duration="1s">
                <i class="bi bi-building-fill text-warning me-1"></i> {{ $room->hotel->name ?? '' }} &nbsp;|&nbsp; 
                <i class="bi bi-geo-alt-fill text-warning me-1"></i> {{ $room->hotel->location ?? '' }}
            </div>
        </div>
    </div>

    <!-- Main Content & Reservation Sidebar -->
    <div class="flat-section bg-light-blue py-6" style="background-color:#f7f9fc;">
        <div class="container">
            <div class="row g-5">
                <!-- Left Column: Details -->
                <div class="col-lg-8">
                    <!-- Photo Gallery Slideshow / Grid -->
                    @if(count($galleryImages) > 1)
                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white mb-4">
                        <h4 class="fw-bold mb-4 font-family-poppins text-dark">Suite Gallery</h4>
                        <div class="row g-3">
                            @foreach($galleryImages as $img)
                                <div class="col-md-6 col-12">
                                    <a href="{{ asset('storage/' . $img) }}" data-fancybox="room-gallery" class="d-block rounded-3 overflow-hidden shadow-sm" style="height:210px; border:1px solid #eee;">
                                        <img src="{{ asset('storage/' . $img) }}" class="w-100 h-100 object-fit-cover hover-scale transition-all" style="transition:0.4s;" alt="{{ (is_array($room->alt_text) && isset($room->alt_text[$img])) ? $room->alt_text[$img] : ($room->room_type . ' - Photo') }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Specs Highlights -->
                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white mb-4">
                        <div class="row g-3 text-center">
                            <div class="col-3 col-md-3">
                                <div class="p-3 rounded-3 bg-light">
                                    <i class="bi bi-arrows-fullscreen text-warning fs-3 mb-2 d-block"></i>
                                    <span class="d-block small text-muted">Size</span>
                                    <span class="fw-bold text-dark">{{ $room->size ?? '45m²' }}</span>
                                </div>
                            </div>
                            <div class="col-3 col-md-3">
                                <div class="p-3 rounded-3 bg-light">
                                    <i class="bi bi-moon text-warning fs-3 mb-2 d-block"></i>
                                    <span class="d-block small text-muted">Bed Type</span>
                                    <span class="fw-bold text-dark">{{ $room->bed_type ?? 'King' }}</span>
                                </div>
                            </div>
                            <div class="col-3 col-md-3">
                                <div class="p-3 rounded-3 bg-light">
                                    <i class="bi bi-people text-warning fs-3 mb-2 d-block"></i>
                                    <span class="d-block small text-muted">Capacity</span>
                                    <span class="fw-bold text-dark">{{ $room->capacity ?? 2 }} Guests</span>
                                </div>
                            </div>
                            <div class="col-3 col-md-3">
                                <div class="p-3 rounded-3 bg-light">
                                    <i class="bi bi-eye text-warning fs-3 mb-2 d-block"></i>
                                    <span class="d-block small text-muted">View</span>
                                    <span class="fw-bold text-dark">{{ $room->view_type ?? 'Garden' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Suite description -->
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                        <h4 class="fw-bold mb-4 font-family-poppins text-dark">About This Sanctuary</h4>
                        <div class="description-content text-muted" style="line-height:1.7; font-size:15px;">
                            {!! $room->description !!}
                        </div>
                    </div>

                    <!-- Amenities list -->
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                        <h4 class="fw-bold mb-4 font-family-poppins text-dark">Room Amenities</h4>
                        <div class="row g-3">
                            @php 
                                $amenities = [
                                    ['label' => 'High-Speed WiFi', 'icon' => 'wifi'],
                                    ['label' => 'Smart TV with Netflix', 'icon' => 'tv'],
                                    ['label' => 'Climate Control AC', 'icon' => 'thermometer-snowflake'],
                                    ['label' => 'Mini Bar & Snacks', 'icon' => 'refrigerator'],
                                    ['label' => 'Luxury Toileteries', 'icon' => 'sparkles'],
                                    ['label' => 'Room Service 24/7', 'icon' => 'bell'],
                                    ['label' => 'Digital Safe', 'icon' => 'shield-check'],
                                    ['label' => 'Coffee & Tea Maker', 'icon' => 'coffee']
                                ];
                            @endphp
                            @foreach($amenities as $amenity)
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check2 text-warning fs-5"></i>
                                    <span class="text-muted small fw-bold">{{ $amenity['label'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Inclusions -->
                    @if(!empty($room->inclusions))
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4 border-top border-success border-3">
                        <h5 class="fw-bold mb-4 text-success font-family-poppins d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success fs-5"></i> Included in Your Stay
                        </h5>
                        <div class="row g-3">
                            @foreach($room->inclusions as $inc)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-2 text-muted small fw-semibold">
                                    <i class="bi bi-check-lg text-success mt-1"></i> {{ $inc }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Sidebar Plan Selector & Booking Form -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 105px; z-index: 5;">
                        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                            <div class="card-body p-4">
                                <div class="mb-4 pb-3 border-bottom">
                                    <span class="text-muted small d-block">Price starts from</span>
                                    <div class="d-flex align-items-baseline gap-2">
                                        <h2 class="fw-bold mb-0 text-warning">₹{{ number_format($room->price, 0) }}</h2>
                                        <span class="text-muted">/night</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3 text-dark small text-uppercase" style="letter-spacing:0.5px;">Choose a Rate Plan</h6>
                                    <div class="d-flex flex-column gap-3">
                                        @forelse($room->rate_plans ?? [] as $plan)
                                        @php $meta = $ratePlanLabels[$plan['type'] ?? 'flexible'] ?? ['label'=>'Standard Rate','color'=>'#e8900a','icon'=>'tag']; @endphp
                                        <label class="rate-plan-option border p-3 rounded-4 cursor-pointer transition-all hover-shadow d-block" style="border: 2px solid #eee; transition: 0.25s;">
                                            <input type="radio" name="plan" value="{{ $plan['type'] ?? '' }}" class="d-none" onchange="updatePrice('{{ $plan['price'] ?? $room->price }}', '{{ $plan['name'] }}')">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="bi bi-star-fill icon-sm" style="color: {{ $meta['color'] }}; font-size:12px;"></i>
                                                    <span class="fw-bold small text-dark">{{ $plan['name'] }}</span>
                                                </div>
                                                <span class="badge rounded-pill px-2 py-1 small" style="background-color: {{ $meta['color'] }}20; color: {{ $meta['color'] }}; font-size: 9px;">{{ $meta['label'] }}</span>
                                            </div>
                                            @if(!empty($plan['price']))
                                            <div class="fw-bold text-dark" style="font-size:14.5px;">₹{{ number_format($plan['price'], 0) }} <small class="text-muted fw-normal" style="font-size:11px;">/night</small></div>
                                            @endif
                                        </label>
                                        @empty
                                        <div class="text-muted small p-2 bg-light rounded-3">Standard rate applies for this room.</div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="d-grid gap-3">
                                    <a id="bookNowBtn" href="{{ route('bookings.create', $room) }}" class="w-100 tf-btn primary hover-1 py-3 text-white border-0 rounded-pill fw-bold text-center text-decoration-none">
                                        Book This Sanctuary
                                    </a>
                                    <p class="text-center text-muted small mb-0" style="font-size:11.5px;"><i class="bi bi-info-circle me-1"></i> No immediate payment required online</p>
                                </div>
                            </div>
                        </div>

                        <!-- Hotel mini info -->
                        @if($room->hotel)
                        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden mt-4 p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img src="{{ !empty($room->hotel->images) ? asset('storage/'.$room->hotel->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=200' }}" class="rounded-circle" width="50" height="50" style="object-fit: cover; border:1px solid #eee;">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark font-family-poppins">{{ $room->hotel->name }}</h6>
                                    <div class="d-flex gap-1 text-warning">
                                        @for($i=1; $i<=5; $i++)
                                        <i class="bi bi-star-fill" style="font-size:11px;"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted small mb-3" style="line-height:1.5; font-size:13px;">{{ Str::limit(strip_tags($room->hotel->description), 120) }}</p>
                            <a href="{{ route('hotels.show', $room->hotel->slug) }}" class="btn btn-outline-dark w-100 rounded-pill small fw-bold py-1.5 btn-sm">Explore Property</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Related Rooms list -->
            @if($relatedRooms->count() > 0)
            <div class="mt-5 pt-5">
                <h4 class="fw-bold mb-4 font-family-poppins text-dark">Other Suites at This Property</h4>
                <div class="row g-4">
                    @foreach($relatedRooms as $rel)
                    <div class="col-lg-4 col-md-6">
                        <div class="item hover-img bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100 d-flex flex-column">
                            <div class="position-relative" style="height:190px;">
                                <a href="{{ route('rooms.show', $rel) }}" class="d-block w-100 h-100">
                                    <img class="w-100 h-100 object-fit-cover" src="{{ !empty($rel->images) ? asset('storage/'.$rel->images[0]) : 'https://images.unsplash.com/photo-1590490359683-658d3d23f972?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $rel->room_type }}">
                                </a>
                                <div class="position-absolute bg-warning text-white rounded-pill px-3 py-1 fw-bold" style="top:12px; right:12px; font-size:10px;">
                                    ₹{{ number_format($rel->price) }} / nt
                                </div>
                            </div>
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <h6 class="fw-bold text-dark font-family-poppins mb-3">{{ $rel->room_type }}</h6>
                                <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3">
                                    <a href="{{ route('rooms.show', $rel) }}" class="tf-btn primary hover-1 px-3 py-1.5 rounded-pill font-size-12 text-white text-decoration-none">Details</a>
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

    <style>
        .rate-plan-option:has(input:checked) {
            border-color: #e8900a !important;
            background-color: #fff9f0 !important;
        }
    </style>
@endsection

@push('scripts')
<script>
    function updatePrice(price, planName) {
        const baseUrl = "{{ route('bookings.create', $room) }}";
        const plan = planName.toLowerCase().replace(/ /g, '_');
        document.getElementById('bookNowBtn').href = `${baseUrl}?plan=${plan}`;
    }
</script>
@endpush
