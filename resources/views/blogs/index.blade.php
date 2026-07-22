@extends('layouts.app')

@push('styles')
<style>
/* ======================================================
   BLOG LIST PAGE — CLEAN PREMIUM DESIGN
   ====================================================== */

/* ----- Banner ----- */
.vk-blog-banner {
    position: relative;
    min-height: 340px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 82px;
    overflow: hidden;
}
.vk-blog-banner-inner {
    position: absolute;
    inset: 0;
    background-size: cover !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
}
.vk-blog-banner-inner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(5,20,33,0.90) 0%, rgba(5,20,33,0.75) 50%, rgba(100,30,0,0.50) 100%);
}
.vk-blog-banner-text {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 65px 20px 55px;
    width: 100%;
}
.vk-blog-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(245,124,0,0.18);
    border: 1px solid rgba(245,124,0,0.35);
    color: #F57C00;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 6px 18px;
    border-radius: 50px;
    margin-bottom: 16px;
}
.vk-blog-banner-title {
    font-size: clamp(1.65rem, 4vw, 2.7rem) !important;
    font-weight: 700 !important;
    color: #fff !important;
    line-height: 1.2 !important;
    margin: 0 0 12px !important;
}
.vk-blog-banner-desc {
    color: rgba(255,255,255,0.62) !important;
    font-size: 0.93rem !important;
    max-width: 520px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ----- Page body ----- */
.vk-blog-body {
    background: #f5f0ea;
    padding: 52px 0 72px;
}

/* ----- Featured card ----- */
.vk-feat {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 6px 32px rgba(0,0,0,0.07);
    margin-bottom: 48px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 340px;
    text-decoration: none !important;
    color: inherit !important;
    transition: transform .3s, box-shadow .3s;
}
.vk-feat:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 50px rgba(0,0,0,0.11);
}
.vk-feat-img {
    position: relative;
    overflow: hidden;
    min-height: 320px;
}
.vk-feat-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .6s ease;
}
.vk-feat:hover .vk-feat-img img { transform: scale(1.04); }
.vk-feat-badge {
    position: absolute;
    top: 16px; left: 16px;
    background: #F57C00;
    color: #fff;
    font-size: 9.5px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 50px;
    z-index: 2;
}
.vk-feat-body {
    padding: 38px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.vk-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 14px;
}
.vk-meta span {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11.5px;
    color: #888;
    font-weight: 500;
}
.vk-meta span i { color: #F57C00; font-size: 10.5px; }
.vk-feat-title {
    font-size: 1.35rem !important;
    font-weight: 700 !important;
    color: #0b1a29 !important;
    line-height: 1.35 !important;
    margin-bottom: 12px !important;
}
.vk-feat-excerpt {
    font-size: 0.87rem !important;
    color: #666 !important;
    line-height: 1.65 !important;
    margin-bottom: 22px !important;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.vk-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #F57C00 !important;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none !important;
    transition: gap .2s;
}
.vk-read-btn:hover { gap: 12px; color: #E65100 !important; }

/* ----- Section header ----- */
.vk-section-bar {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 8px;
}
.vk-section-bar .eyebrow {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    color: #F57C00;
    margin-bottom: 3px;
}
.vk-section-bar h2 {
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    color: #0b1a29 !important;
    margin: 0 !important;
}
.vk-section-bar .count { font-size: 12px; color: #aaa; }

/* ----- Grid cards ----- */
.vk-card-wrap {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}
.vk-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 3px 16px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    text-decoration: none !important;
    color: inherit !important;
    transition: transform .3s, box-shadow .3s;
}
.vk-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 36px rgba(0,0,0,0.09);
}
.vk-card-img {
    position: relative;
    height: 200px;
    overflow: hidden;
    flex-shrink: 0;
}
.vk-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .5s ease;
}
.vk-card:hover .vk-card-img img { transform: scale(1.06); }
.vk-card-badge {
    position: absolute;
    top: 12px; left: 12px;
    background: #F57C00;
    color: #fff;
    font-size: 8.5px;
    font-weight: 800;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    padding: 4px 11px;
    border-radius: 50px;
    z-index: 2;
}
.vk-card-body {
    padding: 20px 18px 18px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.vk-card-title {
    font-size: 0.97rem !important;
    font-weight: 700 !important;
    color: #0b1a29 !important;
    line-height: 1.4 !important;
    margin-bottom: 9px !important;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.vk-card-excerpt {
    font-size: 0.8rem !important;
    color: #777 !important;
    line-height: 1.55 !important;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 14px !important;
}
.vk-card-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid #f2f2f2;
    margin-top: auto;
}
.vk-card-date {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10.5px;
    color: #aaa;
    font-weight: 500;
}
.vk-card-date i { color: #F57C00; }
.vk-card-arrow {
    width: 28px; height: 28px;
    border-radius: 50%;
    background: #fff8f0;
    border: 1px solid rgba(245,124,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #F57C00;
    font-size: 12px;
    transition: all .2s;
    flex-shrink: 0;
}
.vk-card:hover .vk-card-arrow { background: #F57C00; color: #fff; border-color: #F57C00; }

/* ----- Empty state ----- */
.vk-blog-empty {
    background: #fff;
    border-radius: 20px;
    padding: 80px 30px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.vk-blog-empty i { font-size: 3rem; color: #ddd; display: block; margin-bottom: 16px; }

/* ----- Pagination ----- */
nav.vk-pagination ul {
    display: flex !important;
    list-style: none !important;
    gap: 6px;
    justify-content: center;
    flex-wrap: wrap;
    padding: 0 !important;
    margin: 0 !important;
}
nav.vk-pagination ul li a,
nav.vk-pagination ul li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px; height: 38px;
    border-radius: 9px;
    border: 1.5px solid #e5e5e5;
    font-size: 13px;
    font-weight: 600;
    color: #333;
    text-decoration: none;
    transition: all .2s;
    background: #fff;
}
nav.vk-pagination ul li a:hover { background: #fff8f0; border-color: #F57C00; color: #F57C00; }
nav.vk-pagination ul li.active span,
nav.vk-pagination ul li span[aria-current] {
    background: #F57C00 !important;
    border-color: #F57C00 !important;
    color: #fff !important;
}

/* ----- Responsive ----- */
@media (max-width: 991px) {
    .vk-blog-banner { margin-top: 76px; min-height: 280px; }
    .vk-feat { grid-template-columns: 1fr; }
    .vk-feat-img { min-height: 240px; }
    .vk-feat-body { padding: 26px 24px 28px; }
    .vk-card-wrap { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 767px) {
    .vk-blog-banner { margin-top: 72px; min-height: 250px; }
    .vk-blog-banner-text { padding: 48px 16px 40px; }
    .vk-blog-body { padding: 32px 0 50px; }
    .vk-feat-img { min-height: 200px; }
    .vk-feat-body { padding: 20px 18px 22px; }
    .vk-feat-title { font-size: 1.1rem !important; }
    .vk-card-wrap { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
@media (max-width: 480px) {
    .vk-card-wrap { grid-template-columns: 1fr; }
    .vk-card-img { height: 180px; }
}
</style>
@endpush

@section('content')
@php
    $bannerSection = $sections->get('blog_banner');
    $bannerBg    = $bannerSection?->image
        ? asset('storage/' . $bannerSection->image)
        : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg');
    $bannerTitle = $bannerSection?->title ?: 'Travel Chronicles & Guides';
    $bannerDesc  = $bannerSection?->description ?: 'Discover travel tips, local secrets, and insider guides from Kashi.';

    $allBlogs     = $blogs->getCollection();
    $featuredBlog = $allBlogs->first();
    $gridBlogs    = $allBlogs->values();
@endphp

{{-- ======= BANNER ======= --}}
<div class="vk-blog-banner">
    <div class="vk-blog-banner-inner" style="background: url('{{ $bannerBg }}') center/cover no-repeat;"></div>
    <div class="vk-blog-banner-text">
        <div class="vk-blog-eyebrow"><i class="bi bi-journal-text"></i> Our Blog</div>
        <h1 class="vk-blog-banner-title">{{ $bannerTitle }}</h1>
        <p class="vk-blog-banner-desc">{!! strip_tags($bannerDesc) !!}</p>
    </div>
</div>

{{-- ======= BODY ======= --}}
<div class="vk-blog-body">
    <div class="container">

        @if($blogs->isEmpty())
        {{-- Empty --}}
        <div class="vk-blog-empty">
            <i class="bi bi-journal-x"></i>
            <h4 style="color:#555;font-weight:700;">No articles published yet</h4>
            <p style="color:#aaa;font-size:.88rem;">Check back soon — great content is coming.</p>
        </div>

        @else

    

        {{-- ======= GRID CARDS ======= --}}
        @if($gridBlogs->count() > 0)
        <div class="vk-section-bar">
            <div>
                <p class="eyebrow">Latest Articles</p>
                <h2>More from our blog</h2>
            </div>
            <span class="count">{{ $blogs->total() }} article{{ $blogs->total() !== 1 ? 's' : '' }}</span>
        </div>

        <div class="vk-card-wrap">
            @foreach($gridBlogs as $blog)
            <a href="{{ route('blogs.show', $blog->slug) }}" class="vk-card">
                <div class="vk-card-img">
                    <span class="vk-card-badge">Article</span>
                    <img src="{{ $blog->featured_image ? asset('storage/'.$blog->featured_image) : 'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=600' }}"
                         alt="{{ $blog->title }}">
                </div>
                <div class="vk-card-body">
                    <h3 class="vk-card-title">{{ $blog->title }}</h3>
                    <p class="vk-card-excerpt">{{ $blog->short_description ?: Str::limit(strip_tags($blog->content), 110) }}</p>
                    <div class="vk-card-foot">
                        <span class="vk-card-date"><i class="bi bi-calendar3"></i> {{ $blog->created_at->format('d M Y') }}</span>
                        <span class="vk-card-arrow"><i class="bi bi-arrow-right"></i></span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        {{-- ======= PAGINATION ======= --}}
        @if($blogs->hasPages())
        <nav class="vk-pagination">{{ $blogs->links() }}</nav>
        @endif

        @endif
    </div>
</div>
@endsection
