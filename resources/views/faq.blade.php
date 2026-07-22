@extends('layouts.app')

@section('content')
    @php
        $faqBanner = $sections['faq_banner'] ?? $sections->first() ?? null;
        $faqTitle = $faqBanner->title ?? 'Frequently Asked Questions';
        $faqDesc = $faqBanner->description ?? 'Find quick answers about travel itineraries, stays, custom routes, and payment policies.';
        $faqBg = ($faqBanner && !empty($faqBanner->image)) ? asset('storage/' . $faqBanner->image) : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg');
    @endphp

    <!-- Page Header (GlobeTrek Breadcrumb style) -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $faqBg }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $faqTitle }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp text-center text-white opacity-90 mt-2" data-wow-delay="0.2s" data-wow-duration="1s">
                {!! strip_tags($faqDesc) !!}
            </div>
        </div>
    </div>

    <!-- FAQ Accordion List -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion shadow-sm rounded-4 overflow-hidden border-0 bg-white" id="faqAccordion">
                        @forelse($faqs as $faq)
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }} py-4 px-4 fw-bold text-dark font-family-poppins" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}" style="box-shadow:none; font-size:16px;">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-4 text-muted border-top bg-light" style="line-height:1.6; font-size:14.5px;">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="bi bi-question-circle display-1 text-muted opacity-25 mb-4 d-block"></i>
                            <h3 class="fw-bold" style="color: #1f2937;">No FAQs available yet.</h3>
                            <p class="text-muted">Please check back later or contact us directly.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .accordion-button:not(.collapsed) {
            background-color: #fff9f0 !important;
            color: #e8900a !important;
        }
        .accordion-button::after {
            font-family: 'bootstrap-icons';
            content: "\f282";
            background-image: none !important;
            transform: none !important;
            font-size: 16px;
            color: #333;
            transition: 0.3s;
        }
        .accordion-button:not(.collapsed)::after {
            content: "\f27f";
            color: #e8900a;
        }
    </style>
@endsection
