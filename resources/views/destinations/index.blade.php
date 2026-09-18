@extends('layouts.app')

@section('content')
    <!-- Page Header (GlobeTrek Breadcrumb style) -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $sections['destination_banner']->image ? asset('storage/'.$sections['destination_banner']->image) : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg') }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $sections['destination_banner']->title ?? 'Breathtaking Destinations' }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                <div class=" justify-content-center text-white opacity-75">
                    {!! strip_tags($sections['destination_banner']->description ?? 'Explore our curated selection of the world\'s most beautiful and iconic locations.') !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Destinations Grid Showcase -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
            <div class="row g-4">
                @forelse($destinations as $destination)
                <div class="col-lg-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-duration="1s">
                    <div class="item hover-img bg-light border-0 rounded-4 overflow-hidden position-relative" style="height: 390px;">
                        <a class="images-group img-style d-block w-100 h-100" href="{{ route('destinations.show', $destination->slug) }}">
                            <img src="{{ $destination->image ? asset('storage/'.$destination->image) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $destination->name }}" class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;">
                        </a>
                        <div class="tag position-absolute bg-warning text-white px-3 py-1 rounded-pill" style="top:15px; left:15px; font-size:11px; z-index:3;">
                            Featured
                        </div>
                        <div class="archive-bottom position-absolute w-100 p-4" style="bottom:0; left:0; background: linear-gradient(transparent, rgba(6, 22, 36, 0.95)); z-index:2;">
                            <div class="tour-title h3 mb-1">
                                <a href="{{ route('destinations.show', $destination->slug) }}" class="link text-white text-decoration-none fw-bold">{{ $destination->name }}</a>
                            </div>
                            <div class="subtitle text-white opacity-75 multi-ellipsis mb-3" style="font-size:13px; line-height:1.4;">
                                {{ Str::limit(strip_tags($destination->description), 90) }}
                            </div>
                            <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-warning rounded-pill px-4 py-2 small fw-bold text-white text-decoration-none" style="font-size: 13px;">
                                Explore Details <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 border shadow-sm max-w-800 mx-auto">
                        <i class="bi bi-emoji-frown fs-1 text-muted mb-3 d-block"></i>
                        <h4 class="fw-bold">No Destinations Listed</h4>
                        <p class="text-muted">There are no destinations available in our directory right now. Please check back later.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
