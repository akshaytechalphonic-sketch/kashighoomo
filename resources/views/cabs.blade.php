@extends('layouts.app')

@section('title', 'Cab Booking Packages | Kashi Tourism')
@section('meta_description', 'Book premium chauffeur-driven cabs in Varanasi. Sedan, SUV, Innova Crysta, and Tempo Travelers at best rates for local and outstation travel.')

@section('content')
    @php
        $cabBanner = $sections['gallery_banner'] ?? $sections->first() ?? null;
        $cabTitle = $cabBanner->title ?? 'Cab Sightseeing & Transfers';
        $cabDesc = $cabBanner->description ?? 'Chauffeur-driven air-conditioned cabs at transparent per-day pricing for your spiritual tour of Kashi.';
        $cabBg = ($cabBanner && !empty($cabBanner->image)) ? asset('storage/' . $cabBanner->image) : 'https://images.unsplash.com/photo-1549268955-4422e5f296c0?auto=format&fit=crop&q=80&w=1200';
    @endphp

    <!-- Page Header (GlobeTrek Breadcrumb style) -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $cabBg }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $cabTitle }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp text-center text-white opacity-90 mt-2" data-wow-delay="0.2s" data-wow-duration="1s">
                {!! strip_tags($cabDesc) !!}
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
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

            <div class="text-center mb-5">
                <h2 class="fw-bold font-family-poppins text-dark">Select Your Comfortable Ride</h2>
                <p class="text-muted">A wide fleet of clean vehicles driven by verified local tour chauffeurs.</p>
            </div>

            <div class="row g-4">
                @forelse($cabs as $cab)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-duration="1s">
                    <div class="item hover-img bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100 d-flex flex-column" style="border: 1px solid #eee !important;">
                        <div class="archive-top position-relative overflow-hidden" style="height:180px; background-color:#f3f4f6;">
                            @if(!empty($cab->images) && count($cab->images) > 0)
                                <img src="{{ asset('storage/' . $cab->images[0]) }}" alt="{{ (is_array($cab->alt_text) && isset($cab->alt_text[$cab->images[0]])) ? $cab->alt_text[$cab->images[0]] : $cab->cab_name }}" class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-car-front text-warning display-4"></i>
                                    <span class="small mt-1">Premium Ride</span>
                                </div>
                            @endif
                            <div class="position-absolute bg-dark text-white rounded-pill px-3 py-1 fw-bold" style="bottom:12px; right:12px; font-size:10px; z-index:3;">
                                <i class="bi bi-people-fill text-warning me-1"></i>{{ $cab->seating_capacity }} Seater
                            </div>
                        </div>
                        <div class="archive-bottom p-4 d-flex flex-column flex-grow-1">
                            <span class="badge bg-light text-dark border-0 rounded-pill px-3 py-1 mb-2 small fw-bold align-self-start" style="font-size:10.5px;">{{ $cab->vehicle_type }}</span>
                            <h3 class="tour-title h6 mb-3 fw-bold text-dark font-family-poppins">{{ $cab->cab_name }}</h3>
                            <div class="text-muted flex-grow-1" style="font-size:13px; line-height:1.5;">
                                {!! $cab->description !!}
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-3">
                                <div class="price">
                                    <span class="text-muted" style="font-size:11px; display:block; text-transform:uppercase;">Rates From</span>
                                    <span class="fw-extrabold text-primary h5 mb-0" style="color:#061624;">₹{{ number_format($cab->price) }}<small class="text-muted" style="font-size:10px;">/day</small></span>
                                </div>
                                <button type="button" class="tf-btn primary hover-1 px-4 py-2 rounded-pill font-size-13 text-white border-0 fw-bold" data-bs-toggle="modal" data-bs-target="#enquiryModal{{ $cab->id }}">
                                    Enquire
                                </button>
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
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-car-front text-muted display-3 mb-3"></i>
                    <p class="text-muted">No cabs available right now. Please check back later or contact us directly.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
