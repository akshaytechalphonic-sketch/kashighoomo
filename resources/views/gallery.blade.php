@extends('layouts.app')

@section('content')
@php
    $banner = $sections['banner'] ?? $sections->first();
    $allCategories = ['Rooms', 'Amenities', 'Dining', 'Pool', 'Spa', 'Events'];
    $dynamicCats = $galleries->pluck('category')->unique()->filter()->values()->toArray();
    $categories = array_unique(array_merge($allCategories, $dynamicCats));
@endphp

    <!-- Page Header (GlobeTrek Breadcrumb style) -->
    <div class="page-title" style="background: linear-gradient(rgba(6, 22, 36, 0.75), rgba(6, 22, 36, 0.9)), url('{{ $banner && $banner->image ? asset('storage/'.$banner->image) : asset('frontend-theme/images/backgrounds/bg-hero-1.jpg') }}') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                {{ $banner->title ?? 'Kashi Visual Gallery' }}
            </h1>
            <div class="breadcrumb-content wow animate__animated animate__fadeInUp text-center text-white opacity-90 mt-2" data-wow-delay="0.2s" data-wow-duration="1s">
                {!! strip_tags($banner->description ?? 'Explore the majestic landscapes, adventure packages, premium hotels, and cultural experiences in Kashi.') !!}
            </div>
        </div>
    </div>

    <!-- Gallery Grid with Filters -->
    <div class="flat-section bg-light-blue py-6" style="background-color: #f7f9fc;">
        <div class="container">
            <!-- Category Filters -->
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-5 pb-4">
                <button class="btn btn-warning text-white rounded-pill px-4 fw-bold filter-btn active" data-category="all" style="font-size:13px;">All Photos</button>
                @foreach($categories as $category)
                    @if($galleries->where('category', $category)->count() > 0)
                        <button class="btn btn-outline-dark rounded-pill px-4 fw-bold filter-btn" data-category="{{ $category }}" style="font-size:13px;">{{ $category }}</button>
                    @endif
                @endforeach
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4" id="gallery-container">
                @forelse($galleries as $gallery)
                <div class="col-lg-4 col-md-6 gallery-item-card" data-category="{{ $gallery->category }}">
                    <div class="card border-0 shadow-sm overflow-hidden gallery-item rounded-4 cursor-pointer position-relative bg-white" 
                         style="height: 290px; border:1px solid #eee;"
                         data-img="{{ asset('storage/'.$gallery->image) }}"
                         data-title="{{ $gallery->title ?? 'Visual Showcase' }}"
                         data-category="{{ $gallery->category }}">
                        <img src="{{ asset('storage/'.$gallery->image) }}" class="w-100 h-100 object-fit-cover transition-all" style="transition:0.4s;" alt="{{ $gallery->alt_text ?? $gallery->title }}">
                        
                        <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center text-white text-center p-3 rounded-4">
                            <div class="bg-warning p-3 rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                <i class="bi bi-arrows-fullscreen fs-5"></i>
                            </div>
                            <h5 class="fw-bold mb-1 font-family-poppins text-white">{{ $gallery->title ?? 'Visual Showcase' }}</h5>
                            <span class="badge bg-warning px-3 py-1 rounded-pill small text-white">{{ $gallery->category }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 border shadow-sm max-w-800 mx-auto">
                        <i class="bi bi-image-alt fs-1 text-muted mb-3 d-block"></i>
                        <h4 class="text-muted">No images found in the gallery.</h4>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div class="modal fade" id="lightboxModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 position-relative text-center">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4 shadow-none" style="z-index: 10;" data-bs-dismiss="modal"></button>
                    <div class="bg-dark rounded-4 overflow-hidden p-2 d-inline-block shadow-lg max-w-800">
                        <img id="lightboxImg" src="" class="img-fluid rounded-3" style="max-height:70vh; object-fit:contain;">
                        <div class="p-3 text-white text-center mt-2">
                            <h4 id="lightboxTitle" class="fw-bold mb-1 font-family-poppins"></h4>
                            <span id="lightboxCategory" class="badge bg-warning px-3 py-1.5 rounded-pill small text-white"></span>
                        </div>
                    </div>
                    <!-- Navigation Arrows -->
                    <button id="lightboxPrev" class="btn btn-outline-light position-absolute top-50 start-0 translate-middle-y ms-3 rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;"><i class="bi bi-chevron-left"></i></button>
                    <button id="lightboxNext" class="btn btn-outline-light position-absolute top-50 end-0 translate-middle-y me-3 rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;"><i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .gallery-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(6, 22, 36, 0.85); opacity: 0; transition: all 0.4s ease;
            backdrop-filter: blur(2px);
        }
        .gallery-item:hover .gallery-overlay { opacity: 1; }
        .max-w-800 { max-width: 800px; }
    </style>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter Logic
        const filterBtns = document.querySelectorAll('.filter-btn');
        const items = document.querySelectorAll('.gallery-item-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'btn-warning', 'text-white');
                    b.classList.add('btn-outline-dark');
                });
                this.classList.add('active', 'btn-warning', 'text-white');
                this.classList.remove('btn-outline-dark');
                const cat = this.dataset.category;
                let visible = [];
                items.forEach(item => {
                    if (cat === 'all' || item.dataset.category === cat) {
                        item.style.display = 'block';
                        visible.push(item);
                    } else {
                        item.style.display = 'none';
                    }
                });
                currentVisible = visible.map(el => el.querySelector('.gallery-item'));
                currentIndex = 0;
            });
        });

        // Lightbox Logic
        let currentVisible = [...document.querySelectorAll('.gallery-item')];
        let currentIndex = 0;

        function openLightbox(index) {
            const item = currentVisible[index];
            document.getElementById('lightboxImg').src = item.dataset.img;
            document.getElementById('lightboxTitle').textContent = item.dataset.title;
            document.getElementById('lightboxCategory').textContent = item.dataset.category;
            currentIndex = index;
            const modal = new bootstrap.Modal(document.getElementById('lightboxModal'));
            modal.show();
        }

        document.querySelectorAll('.gallery-item').forEach((item, i) => {
            item.addEventListener('click', () => {
                const indexInVisible = currentVisible.indexOf(item);
                if (indexInVisible !== -1) openLightbox(indexInVisible);
            });
        });

        document.getElementById('lightboxPrev').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + currentVisible.length) % currentVisible.length;
            updateLightbox();
        });

        document.getElementById('lightboxNext').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % currentVisible.length;
            updateLightbox();
        });

        function updateLightbox() {
            const item = currentVisible[currentIndex];
            document.getElementById('lightboxImg').src = item.dataset.img;
            document.getElementById('lightboxTitle').textContent = item.dataset.title;
            document.getElementById('lightboxCategory').textContent = item.dataset.category;
        }

        // Keyboard navigation
        document.addEventListener('keydown', e => {
            const modal = document.getElementById('lightboxModal');
            if (!modal.classList.contains('show')) return;
            if (e.key === 'ArrowLeft') document.getElementById('lightboxPrev').click();
            if (e.key === 'ArrowRight') document.getElementById('lightboxNext').click();
        });
    });
    </script>
    @endpush
@endsection
