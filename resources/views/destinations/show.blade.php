@extends('layouts.app')

@section('content')
@php
    $banner = $sections->first();
@endphp

    <!-- Page Title / Banner (GlobeTrek style) -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $destination->image ? asset('storage/' . $destination->image) : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg') }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $destination->name }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                <div class=" justify-content-center text-center text-white opacity-75">
                    {!! strip_tags($banner->description ?? 'Discover the unique charm and breathtaking beauty of this curated destination.') !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content & Sidebar -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
            <div class="row g-5">
                <!-- Left Details Area -->
                <div class="col-lg-8">
                    <!-- About Section -->
                    <div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
                        <h2 class="display-6 fw-bold mb-4 font-family-poppins text-dark">Discover the Essence of {{ $destination->name }}</h2>
                        <div class="description-content text-muted lh-lg mb-4" style="font-size:15px; line-height:1.75;">
                            {!! nl2br(e($destination->description)) !!}
                        </div>
                        
                        <div class="rounded-4 overflow-hidden shadow-sm mt-4" style="height: 400px; border:1px solid #eee;">
                            <img src="{{ $destination->image ? asset('storage/' . $destination->image) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=1200' }}"
                                class="w-100 h-100 object-fit-cover" alt="{{ $destination->name }}">
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Column -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 105px; z-index: 5;">
                        <!-- Action Card -->
                        <div class="card border-0 shadow-sm p-4 rounded-4 bg-white">
                            <h4 class="fw-bold mb-4 text-dark font-family-poppins">Book This Experience</h4>
                            
                            <div class="d-flex flex-column gap-3 mb-4">
                                <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                                    <span class="small fw-bold text-muted">Location</span>
                                    <span class="text-warning fw-bold">{{ $destination->location ?? 'Global' }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                                    <span class="small fw-bold text-muted">Price Range</span>
                                    <span class="text-warning fw-bold">₹{{ $minprice ?? 2000 }} - ₹{{ $maxprice ?? 5000 }}</span>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-3">
                                <a href="{{ route('hotels.index', ['destination' => $destination->id]) }}"
                                    class="tf-btn primary hover-1 py-3 rounded-pill fw-bold text-center text-white text-decoration-none">
                                    Explore Hotels in {{ $destination->name }}
                                </a>
                                <a href="{{ route('contact') }}" class="btn btn-outline-dark py-2.5 rounded-pill fw-bold text-center">
                                    Request Inquiry
                                </a>
                            </div>
                            <p class="text-center text-muted small mt-4 mb-0">* Prices are subject to seasonal changes and package choices.</p>
                        </div>

                        <!-- Guide Alert Box -->
                        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm d-flex gap-3 align-items-center" style="border-left: 4px solid #e8900a;">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 text-warning d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-info-circle-fill fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Local Travel Guide</h6>
                                <p class="small text-muted mb-0">Our concierge can help you plan the perfect itinerary for {{ $destination->name }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
