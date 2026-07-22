@extends('layouts.app')

@section('title', 'Serene Ganga Boat Rides & Cruises | Kashi Tourism')
@section('meta_description', 'Book traditional row boat rides, sunset motor cruises, and private luxury double-deck bajras on the Ganges in Varanasi. Witness Ganga Aarti from the river.')

@section('content')
    @php
        $boatBanner = $sections['blog_banner'] ?? $sections->first() ?? null;
        $boatTitle = $boatBanner->title ?? 'Holy Ganges Boat Rides & Cruises';
        $boatDesc = $boatBanner->description ?? 'Sail along the 84 ghats of Varanasi. Witness magical sunrises and the grand evening Ganga Aarti from the holy river.';
        $boatBg = ($boatBanner && !empty($boatBanner->image)) ? asset('storage/' . $boatBanner->image) : 'https://images.unsplash.com/photo-1561361531-79f9048a6379?auto=format&fit=crop&q=80&w=1200';
    @endphp

    <!-- Page Header (GlobeTrek Breadcrumb style) -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $boatBg }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $boatTitle }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp text-center text-white opacity-90 mt-2" data-wow-delay="0.2s" data-wow-duration="1s">
                {!! strip_tags($boatDesc) !!}
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-5 p-4 d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-3 fs-3 text-success"></i>
                <div>
                    <h5 class="alert-heading fw-bold mb-1">Enquiry Submitted!</h5>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="text-center mb-5">
                <h2 class="fw-bold font-family-poppins text-dark">Serene Cruises &amp; Traditional Rides</h2>
                <p class="text-muted">Experience the spiritual divinity of Ganga Aarti and Subah-e-Banaras from the water.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse($packages as $pkg)
                <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__fadeInUp" data-wow-duration="1s">
                    <div class="item hover-img bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100 d-flex flex-column" style="border: 1px solid #eee !important;">
                        <div class="archive-top position-relative overflow-hidden" style="height:220px; background-color:#f3f4f6;">
                            @php
                                $fallbackImages = [
                                    'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=800',
                                    'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=800',
                                ];
                                $imgSrc = (!empty($pkg->images) && count($pkg->images) > 0) ? asset('storage/' . $pkg->images[0]) : $fallbackImages[$loop->index % count($fallbackImages)];
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ (!empty($pkg->images) && is_array($pkg->alt_text) && isset($pkg->alt_text[$pkg->images[0]])) ? $pkg->alt_text[$pkg->images[0]] : $pkg->title }}" class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;">
                            
                            <div class="position-absolute bg-dark text-white rounded-pill px-3 py-1 fw-bold" style="top:12px; left:12px; font-size:10px; z-index:3;">
                                <i class="bi bi-clock text-warning me-1"></i>{{ $pkg->duration }}
                            </div>
                        </div>
                        <div class="archive-bottom p-4 d-flex flex-column flex-grow-1">
                            <h3 class="tour-title h5 mb-3 fw-bold text-dark font-family-poppins">{{ $pkg->title }}</h3>
                            <div class="text-muted flex-grow-1 mb-3" style="font-size:13.5px; line-height:1.5;">
                                {!! Str::limit(strip_tags($pkg->description), 140) !!}
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-auto">
                                <div class="price">
                                    <span class="text-muted" style="font-size:11px; display:block; text-transform:uppercase;">Price from</span>
                                    <span class="fw-extrabold text-primary h5 mb-0" style="color:#061624;">₹{{ number_format($pkg->price) }}</span>
                                </div>
                                <button type="button" class="tf-btn primary hover-1 px-4 py-2 rounded-pill font-size-13 text-white border-0 fw-bold" data-bs-toggle="modal" data-bs-target="#enquiryModal{{ $pkg->id }}">
                                    Enquire Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enquiry Modal -->
                <div class="modal fade" id="enquiryModal{{ $pkg->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 border-0 shadow-lg">
                            <div class="modal-header border-bottom p-4 bg-light">
                                <div>
                                    <h5 class="modal-title fw-bold text-dark font-family-poppins">Enquire for {{ $pkg->title }}</h5>
                                    <span class="small text-muted" style="font-size:12px;">Complete details to request a custom boat booking.</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('packages.enquire', $pkg->id) }}" method="POST">
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
                                            <input type="number" name="adults" class="form-control rounded-3" min="1" max="100" value="1" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Children</label>
                                            <input type="number" name="children" class="form-control rounded-3" min="0" max="100" value="0">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold">Special Requests</label>
                                            <textarea name="message" class="form-control rounded-3" rows="3" placeholder="Let us know if you need specific ghat boarding, special decorations, local guides on board, group arrangements, etc."></textarea>
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
                    <i class="bi bi-water text-muted display-3 mb-3"></i>
                    <p class="text-muted">No boat rides available right now. Please check back later or contact us directly.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
