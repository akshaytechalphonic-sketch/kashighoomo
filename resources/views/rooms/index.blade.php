@extends('layouts.app')

@section('content')
    @php
        $banner = $sections['banner'] ?? $sections->first();
    @endphp

    <!-- Page Title / Banner -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $banner && $banner->image ? asset('storage/'.$banner->image) : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg') }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $banner->title ?? 'Our Rooms & Suites' }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                <div class="breadcrumb breadcrumb-dynamic justify-content-center text-white opacity-75">
                    {!! strip_tags($banner->description ?? 'Discover the perfect retreat — crafted for those who appreciate the finest details.') !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar & Listing Grid -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
            <!-- Filter form card -->
            <div class="form-s1 shadow-sm bg-white p-4 rounded-4 mb-5 border border-light animate__animated animate__fadeInUp">
                <form action="{{ route('rooms.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1"><i class="bi bi-people text-warning me-1"></i> Guests</label>
                            <select name="capacity" class="form-select border-0 bg-light py-2 rounded-3">
                                <option value="">Any</option>
                                <option value="1" {{ request('capacity')==1?'selected':'' }}>1 Guest</option>
                                <option value="2" {{ request('capacity')==2?'selected':'' }}>2 Guests</option>
                                <option value="3" {{ request('capacity')==3?'selected':'' }}>3+ Guests</option>
                                <option value="4" {{ request('capacity')==4?'selected':'' }}>4+ Guests</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1"><i class="bi bi-moon text-warning me-1"></i> Bed Type</label>
                            <select name="bed_type" class="form-select border-0 bg-light py-2 rounded-3">
                                <option value="">Any</option>
                                @foreach($bedTypes as $bt)
                                    <option value="{{ $bt }}" {{ request('bed_type')==$bt?'selected':'' }}>{{ $bt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1"><i class="bi bi-eye text-warning me-1"></i> View</label>
                            <select name="view_type" class="form-select border-0 bg-light py-2 rounded-3">
                                <option value="">Any</option>
                                @foreach($viewTypes as $vt)
                                    <option value="{{ $vt }}" {{ request('view_type')==$vt?'selected':'' }}>{{ $vt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-bold text-dark mb-1"><i class="bi bi-currency-rupee text-warning me-1"></i> Max Price (per night)</label>
                            <input type="number" name="max_price" class="form-control border-0 bg-light py-2.5 rounded-3 fw-semibold text-dark" placeholder="e.g. 10000" value="{{ request('max_price') }}">
                        </div>
                        <div class="col-lg-2 col-md-12 d-flex gap-2">
                            <a href="{{ route('rooms.index') }}" class="btn btn-outline-dark w-50 py-2.5 rounded-pill fw-bold" style="font-size:12px;">Clear</a>
                            <button type="submit" class="w-50 tf-btn primary hover-1 py-2 rounded-pill text-center border-0 text-white fw-bold d-flex align-items-center justify-content-center" style="font-size:12px;">
                                Apply
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Room listings -->
            <div class="row g-4">
                @forelse($rooms as $room)
                @php 
                    $roomImage = !empty($room->images) ? asset('storage/'.$room->images[0]) : 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&q=80&w=800'; 
                @endphp
                <div class="col-lg-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-duration="1s">
                    <div class="item hover-img bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100 d-flex flex-column">
                        <div class="archive-top position-relative overflow-hidden" style="height:230px;">
                            <a href="{{ route('rooms.show', $room) }}" class="images-group img-style d-block h-100">
                                <img src="{{ $roomImage }}" alt="{{ $room->room_type }}" class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;">
                            </a>
                            <div class="position-absolute bg-warning text-white rounded-pill px-3 py-1 fw-bold shadow-sm" style="top:12px; right:12px; font-size:11px; z-index:5;">
                                ₹{{ number_format($room->price) }} / nt
                            </div>
                            @if($room->bed_type)
                            <div class="position-absolute bg-dark text-white rounded-pill px-3 py-1 fw-bold" style="top:12px; left:12px; font-size:10px; z-index:5; letter-spacing:0.5px;">
                                <i class="bi bi-moon me-1 text-warning"></i>{{ $room->bed_type }} Bed
                            </div>
                            @endif
                        </div>
                        <div class="archive-bottom p-4 d-flex flex-column flex-grow-1">
                            <span class="text-muted small fw-semibold mb-1">
                                <i class="bi bi-building me-1" style="color:#e8900a;"></i>
                                {{ $room->hotel->name ?? 'Luxury Sanctuary' }}
                            </span>
                            <h3 class="tour-title h5 mb-3 fw-bold">
                                <a href="{{ route('rooms.show', $room) }}" class="link text-dark text-decoration-none hover-warning transition-all">{{ $room->room_type }}</a>
                            </h3>
                            
                            <!-- Specs details -->
                            <div class="row g-2 mb-3 mt-1">
                                @if($room->size)
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3 text-muted">
                                        <i class="bi bi-aspect-ratio text-warning fs-6"></i>
                                        <small class="fw-medium" style="font-size:11.5px;">{{ $room->size }}</small>
                                    </div>
                                </div>
                                @endif
                                @if($room->capacity)
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3 text-muted">
                                        <i class="bi bi-people text-warning fs-6"></i>
                                        <small class="fw-medium" style="font-size:11.5px;">{{ $room->capacity }} Guests</small>
                                    </div>
                                </div>
                                @endif
                                @if($room->view_type)
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3 text-muted">
                                        <i class="bi bi-eye text-warning fs-6"></i>
                                        <small class="fw-medium" style="font-size:11.5px;">{{ $room->view_type }}</small>
                                    </div>
                                </div>
                                @endif
                                @if($room->bed_type)
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3 text-muted">
                                        <i class="bi bi-moon text-warning fs-6"></i>
                                        <small class="fw-medium" style="font-size:11.5px;">{{ $room->bed_type }} Bed</small>
                                    </div>
                                </div>
                                @endif
                            </div>

                            @if(!empty($room->inclusions))
                            <div class="mb-3 d-flex flex-wrap gap-1 mt-1">
                                @foreach(array_slice($room->inclusions, 0, 2) as $inc)
                                    <span class="badge bg-success bg-opacity-10 text-success border-0 small"><i class="bi bi-check-circle me-1"></i>{{ $inc }}</span>
                                @endforeach
                            </div>
                            @endif

                            <div class="d-flex gap-2 mt-auto border-top pt-3">
                                <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-dark w-50 rounded-pill fw-bold py-2 btn-sm text-center">Details</a>
                                <a href="{{ route('bookings.create', $room) }}" class="tf-btn primary hover-1 w-50 rounded-pill fw-bold py-2 btn-sm text-center text-white text-decoration-none d-flex align-items-center justify-content-center">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 border shadow-sm max-w-800 mx-auto">
                        <i class="bi bi-emoji-frown fs-1 text-muted mb-3 d-block"></i>
                        <h4 class="fw-bold">No Suites Found</h4>
                        <p class="text-muted">No suites matched your search criteria. Try removing views or filter ranges.</p>
                        <a href="{{ route('rooms.index') }}" class="tf-btn primary hover-1 px-4 py-2.5 rounded-pill text-white text-decoration-none d-inline-block mt-3">Reset Filters</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($rooms->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
