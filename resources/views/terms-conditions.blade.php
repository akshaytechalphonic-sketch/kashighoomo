@extends('layouts.app')

@section('content')

@php
    $bannerSection = $sections->get('terms-and-condition');
    $bannerImage   = $bannerSection?->image ? asset('storage/' . $bannerSection->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920';
    $bannerTitle   = $bannerSection?->title ?: 'Terms & Conditions';
    $bannerDesc    = $bannerSection?->description ?: 'Please read our terms and conditions carefully before using our services.';
@endphp

<div class="page-header" style="background-image: url('{{ $bannerImage }}'); min-height: 300px; background-size: cover; background-position: center; position: relative; margin-top: 82px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(5,20,33,0.6); z-index: 1;"></div>
    <div class="container py-5 text-center position-relative" style="z-index: 2;">
        <h1 class="fw-bold animate__animated animate__fadeInDown text-white" style="font-size: 2rem !important;">
            {{ $bannerTitle }}
        </h1>
        <div class="animate__animated animate__fadeInUp mt-2" style="color: rgba(254, 245, 245, 0.75) !important; font-size: 0.95rem;">
            {!! $bannerDesc !!}
        </div>
    </div>
</div>

<div class="container py-5 my-3">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0 shadow-premium p-4 p-md-5 rounded-4 bg-white">
               {!! $sections->get('terms_and_content')?->description ?? '' !!}
            </div>
        </div>
    </div>
</div>

<style>
.shadow-premium { box-shadow: 0 1rem 3rem rgba(0,0,0,0.05) !important; }
.card h2 { border-left: 4px solid #F57C00; padding-left: 15px; }
</style>
@endsection
