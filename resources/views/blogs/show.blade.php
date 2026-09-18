@extends('layouts.app')

@push('styles')
<style>
/* ===== BLOG DETAIL PAGE ===== */

/* Reading progress bar */
#reading-progress {
    position: fixed; top: 0; left: 0; height: 3px;
    background: linear-gradient(to right, #F57C00, #E65100);
    z-index: 99999; width: 0%;
    transition: width 0.08s linear;
}

/* Hero Banner */
.blog-detail-banner {
    position: relative;
    min-height: 420px;
    display: flex;
    align-items: flex-end;
    margin-top: 82px;
    overflow: hidden;
}
.blog-detail-banner-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    z-index: 0;
    transition: transform 8s ease;
}
.blog-detail-banner:hover .blog-detail-banner-bg { transform: scale(1.03); }
.blog-detail-banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(5,20,33,0.3) 0%, rgba(5,20,33,0.92) 100%);
    z-index: 1;
}
.blog-detail-banner-content {
    position: relative;
    z-index: 2;
    width: 100%;
    padding: 0 0 50px;
}
.blog-detail-cat {
    display: inline-block;
    background: #F57C00;
    color: #fff;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 5px 16px;
    border-radius: 50px;
    margin-bottom: 14px;
}
.blog-detail-title {
    font-size: clamp(1.5rem, 3.5vw, 2.4rem) !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    line-height: 1.25 !important;
    margin-bottom: 18px;
}
.blog-detail-meta {
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
}
.blog-detail-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: rgba(255,255,255,0.7);
    font-size: 12px;
    font-weight: 500;
}
.blog-detail-meta-item i { color: #F57C00; font-size: 11px; }

/* Layout */
.blog-detail-section {
    background: #f5f0ea;
    padding: 50px 0 70px;
}

/* Article card */
.blog-article-card {
    background: #fff;
    border-radius: 20px;
    padding: 44px 48px;
    box-shadow: 0 6px 30px rgba(0,0,0,0.05);
    margin-bottom: 28px;
}

/* Content typography */
.blog-content-body {
    font-size: 15.5px;
    line-height: 1.85;
    color: #444;
}
.blog-content-body p { margin-bottom: 1.4rem; }
.blog-content-body a {
    color: #F57C00 !important;
    text-decoration: underline !important;
    font-weight: 600;
    transition: all 0.2s ease;
    word-break: break-word;
}
.blog-content-body a:hover {
    color: #E65100 !important;
    text-decoration: underline !important;
    background-color: rgba(245, 124, 0, 0.08);
    border-radius: 3px;
}
.blog-content-body h2 {
    font-size: 1.35rem !important;
    font-weight: 700 !important;
    color: #0b1a29 !important;
    margin: 2.2rem 0 1rem;
    padding-left: 14px;
    border-left: 3px solid #F57C00;
}
.blog-content-body h3 {
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: #1a2e42 !important;
    margin: 1.8rem 0 0.8rem;
}
.blog-content-body ul, .blog-content-body ol {
    padding-left: 1.5rem;
    margin-bottom: 1.4rem;
}
.blog-content-body li { margin-bottom: 0.4rem; }
.blog-content-body blockquote {
    border-left: 4px solid #F57C00;
    padding: 18px 24px;
    background: #fff8f0;
    border-radius: 0 12px 12px 0;
    font-style: italic;
    color: #555;
    margin: 2rem 0;
    font-size: 15px;
}
.blog-content-body img {
    border-radius: 12px;
    max-width: 100%;
    height: auto;
    margin: 1rem 0;
}

/* Tags */
.blog-tag {
    display: inline-block;
    background: #f4f4f4;
    color: #333;
    padding: 5px 15px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid #ebebeb;
}
.blog-tag:hover { background: #F57C00; color: #fff; border-color: #F57C00; text-decoration: none; }

/* Share buttons */
.share-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1.5px solid #e5e5e5;
    display: flex; align-items: center; justify-content: center;
    color: #555; text-decoration: none;
    font-size: 14px;
    transition: all 0.2s;
    background: #fff;
}
.share-btn:hover { background: #F57C00; border-color: #F57C00; color: #fff; text-decoration: none; }

/* Author card */
.blog-author-card {
    background: linear-gradient(135deg, #0b1a29 0%, #1a3a5c 100%);
    border-radius: 16px;
    padding: 24px 26px;
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
}
.blog-author-avatar {
    width: 56px; height: 56px;
    border-radius: 50%;
    background: #F57C00;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; font-weight: 800; color: #fff;
    flex-shrink: 0;
    border: 3px solid rgba(255,255,255,0.15);
}
.blog-author-name { font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 2px; }
.blog-author-role { font-size: 11px; color: rgba(255,255,255,0.55); }
.blog-author-byline { font-size: 11px; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }

/* CTA banner inside article */
.blog-cta-card {
    background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);
    border-radius: 18px;
    padding: 40px 36px;
    text-align: center;
    color: #fff;
    margin-bottom: 28px;
}
.blog-cta-card h4 { font-size: 1.2rem !important; font-weight: 700 !important; color: #fff !important; margin-bottom: 8px; }
.blog-cta-card p { color: rgba(255,255,255,0.85) !important; font-size: 0.85rem !important; margin-bottom: 22px; }

/* ===== SIDEBAR ===== */
.blog-sidebar-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,0.05);
    margin-bottom: 24px;
}
.blog-sidebar-header {
    background: #0b1a29;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
}
.blog-sidebar-header i { color: #F57C00; font-size: 14px; }
.blog-sidebar-body { padding: 18px 18px; }

/* Contact sidebar */
.sidebar-contact-card {
    background: linear-gradient(160deg, #0b1a29 0%, #1a3a5c 100%);
    border-radius: 16px;
    padding: 26px 22px;
    margin-bottom: 24px;
    text-align: center;
}
.sidebar-contact-card h5 { font-size: 1rem !important; font-weight: 700 !important; color: #fff !important; margin-bottom: 6px; }
.sidebar-contact-card p { color: rgba(255,255,255,0.55) !important; font-size: 0.77rem !important; margin-bottom: 18px; }

/* Recent post item */
.recent-post-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f3f3f3;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s;
}
.recent-post-item:last-child { border-bottom: none; padding-bottom: 0; }
.recent-post-item:hover { text-decoration: none; color: inherit; }
.recent-post-item:hover .recent-post-title { color: #F57C00; }
.recent-post-thumb {
    width: 68px; height: 54px;
    flex-shrink: 0;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #f0f0f0;
}
.recent-post-thumb img { width: 100%; height: 100%; object-fit: cover; }
.recent-post-title {
    font-size: 12.5px;
    font-weight: 600;
    color: #0b1a29;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s;
    margin-bottom: 5px;
}
.recent-post-date { font-size: 10.5px; color: #aaa; display: flex; align-items: center; gap: 4px; }
.recent-post-date i { color: #F57C00; }

/* Back link */
.blog-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: rgba(255,255,255,0.7);
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 20px;
    transition: color 0.2s;
}
.blog-back-link:hover { color: #F57C00; text-decoration: none; }

/* Responsive */
@media (max-width: 991px) {
    .blog-detail-banner { min-height: 340px; margin-top: 76px; }
    .blog-article-card { padding: 28px 24px; }
}
@media (max-width: 767px) {
    .blog-detail-banner { min-height: 300px; margin-top: 72px; }
    .blog-detail-banner-content { padding: 0 0 36px; }
    .blog-article-card { padding: 22px 18px; }
    .blog-cta-card { padding: 28px 20px; }
    .blog-content-body { font-size: 14.5px; }
}
</style>
@endpush

@section('content')

@php
    $heroBg = $blog->featured_image
        ? asset('storage/' . $blog->featured_image)
        : 'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=1920';

    $readTime = $blog->reading_time
        ?? max(1, ceil(str_word_count(strip_tags($blog->content)) / 200));

    $fallbackImages = [
        'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=400',
        'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=400',
        'https://images.unsplash.com/photo-1512100356956-c1227c331f01?auto=format&fit=crop&q=80&w=400',
    ];

    $settings = \App\Models\Setting::first();
@endphp

{{-- Reading progress --}}
<div id="reading-progress"></div>

{{-- ===== HERO BANNER ===== --}}
<div class="blog-detail-banner">
    <div class="blog-detail-banner-bg" style="background-image: url('{{ $heroBg }}');"></div>
    <div class="blog-detail-banner-overlay"></div>
    <div class="blog-detail-banner-content">
        <div class="container">
            <a href="{{ route('blogs.index') }}" class="blog-back-link">
                <i class="bi bi-arrow-left"></i> Back to Blog
            </a>
            <div>
                <span class="blog-detail-cat">Article</span>
            </div>
            <h1 class="blog-detail-title">{{ $blog->title }}</h1>
            <div class="blog-detail-meta">
                <span class="blog-detail-meta-item">
                    <i class="bi bi-person-fill"></i>
                    {{ $blog->user?->name ?? 'Visit Kashi Team' }}
                </span>
                <span class="blog-detail-meta-item">
                    <i class="bi bi-calendar3"></i>
                    {{ $blog->created_at->format('d M Y') }}
                </span>
                <span class="blog-detail-meta-item">
                    <i class="bi bi-clock"></i>
                    {{ $readTime }} min read
                </span>
            </div>
        </div>
    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div class="blog-detail-section">
    <div class="container">
        <div class="row g-5">

            {{-- ===== LEFT: ARTICLE ===== --}}
            <div class="col-lg-8">

                {{-- Short description if available --}}
                @if($blog->short_description)
                <div class="mb-4 px-1" style="font-size:1rem; color:#555; line-height:1.7; font-style:italic; border-left:3px solid #F57C00; padding-left:16px;">
                    {{ $blog->short_description }}
                </div>
                @endif

                {{-- Article body --}}
                <div class="blog-article-card">
                    <div class="blog-content-body">
                        {!! $blog->content !!}
                    </div>

                    <hr style="border-color:#f0f0f0; margin:30px 0;">

                    {{-- Tags --}}
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <a href="{{ route('blogs.index') }}" class="blog-tag">#Kashi</a>
                        <a href="{{ route('blogs.index') }}" class="blog-tag">#Varanasi</a>
                        <a href="{{ route('blogs.index') }}" class="blog-tag">#GangaAarti</a>
                        <a href="{{ route('blogs.index') }}" class="blog-tag">#YatraPackages</a>
                    </div>

                    {{-- Share --}}
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <span style="font-size:13px; font-weight:700; color:#0b1a29;">Share this article:</span>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank" class="share-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                               target="_blank" class="share-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title.' '.request()->url()) }}"
                               target="_blank" class="share-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                            <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(request()->url()) }}"
                               class="share-btn" title="Email"><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Author card --}}
                <div class="blog-author-card mb-4">
                    <div class="blog-author-avatar">{{ substr($blog->user?->name ?? 'V', 0, 1) }}</div>
                    <div>
                        <div class="blog-author-byline">Written by</div>
                        <div class="blog-author-name">{{ $blog->user?->name ?? 'Visit Kashi Team' }}</div>
                        <div class="blog-author-role">Travel Expert &amp; Varanasi Yatra Specialist</div>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="blog-cta-card">
                    <i class="bi bi-compass fs-2 mb-2 d-block" style="opacity:0.9;"></i>
                    <h4>Ready to Experience Kashi?</h4>
                    <p>Let our experts craft your perfect spiritual journey to Varanasi.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('packages.index') }}"
                           class="btn fw-bold px-4 py-2 rounded-pill text-decoration-none"
                           style="background:#fff; color:#F57C00; font-size:13px;">
                            <i class="bi bi-grid me-1"></i> View Packages
                        </a>
                        <a href="{{ route('contact') }}"
                           class="btn btn-outline-light fw-bold px-4 py-2 rounded-pill text-decoration-none"
                           style="font-size:13px;">
                            <i class="bi bi-chat me-1"></i> Contact Us
                        </a>
                    </div>
                </div>

            </div>

            {{-- ===== RIGHT: SIDEBAR ===== --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top:105px;">

                    {{-- Contact widget --}}
                    <div class="sidebar-contact-card">
                        <h5>Plan Your Kashi Trip</h5>
                        <p>Free consultation with our Varanasi travel experts.</p>
                        @if($settings?->contact_phone)
                        <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}"
                           class="btn btn-warning fw-bold rounded-pill w-100 mb-2 py-2 text-decoration-none"
                           style="font-size:13px;">
                            <i class="bi bi-telephone me-2"></i>{{ $settings->contact_phone }}
                        </a>
                        @endif
                        @if($settings?->whatsapp_number)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}"
                           target="_blank"
                           class="btn fw-bold rounded-pill w-100 mb-2 py-2 text-decoration-none"
                           style="background:#25D366; color:#fff; font-size:13px;">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp Us
                        </a>
                        @endif
                        <a href="{{ route('contact') }}"
                           class="btn btn-outline-light fw-bold rounded-pill w-100 py-2 text-decoration-none"
                           style="font-size:13px;">
                            <i class="bi bi-chat me-2"></i>Send a Message
                        </a>
                    </div>

                    {{-- Recent posts --}}
                    @if($relatedBlogs->count() > 0)
                    <div class="blog-sidebar-card">
                        <div class="blog-sidebar-header">
                            <i class="bi bi-clock-history"></i> Recent Posts
                        </div>
                        <div class="blog-sidebar-body">
                            @foreach($relatedBlogs->take(5) as $i => $rb)
                            <a href="{{ route('blogs.show', $rb->slug) }}" class="recent-post-item">
                                <div class="recent-post-thumb">
                                    <img src="{{ $rb->featured_image ? asset('storage/'.$rb->featured_image) : $fallbackImages[$i % count($fallbackImages)] }}"
                                         alt="{{ $rb->title }}">
                                </div>
                                <div style="min-width:0; flex:1;">
                                    <div class="recent-post-title">{{ $rb->title }}</div>
                                    <div class="recent-post-date">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $rb->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- You may also like (grid) --}}
                    @if($relatedBlogs->count() > 5)
                    <div class="blog-sidebar-card">
                        <div class="blog-sidebar-header">
                            <i class="bi bi-hand-thumbs-up"></i> You May Also Like
                        </div>
                        <div class="blog-sidebar-body" style="padding:14px;">
                            <div class="row g-2">
                                @foreach($relatedBlogs->slice(5) as $i => $rb)
                                <div class="col-6">
                                    <a href="{{ route('blogs.show', $rb->slug) }}"
                                       class="d-block text-decoration-none rounded-3 overflow-hidden position-relative"
                                       style="height:88px; border:1px solid #f0f0f0;">
                                        <img src="{{ $rb->featured_image ? asset('storage/'.$rb->featured_image) : $fallbackImages[$i % count($fallbackImages)] }}"
                                             alt="{{ $rb->title }}"
                                             style="width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease;">
                                        <div class="position-absolute w-100 p-1"
                                             style="bottom:0; left:0; background:linear-gradient(transparent,rgba(5,20,33,0.92)); z-index:2;">
                                            <span class="text-white fw-bold d-block" style="font-size:9px; line-height:1.3; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                                {{ Str::limit($rb->title, 30) }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
window.addEventListener('scroll', function () {
    const el  = document.getElementById('reading-progress');
    const doc = document.documentElement;
    const scrollTop    = doc.scrollTop || document.body.scrollTop;
    const scrollHeight = doc.scrollHeight - doc.clientHeight;
    el.style.width = scrollHeight > 0 ? (scrollTop / scrollHeight * 100) + '%' : '0%';
});
</script>
@endpush
