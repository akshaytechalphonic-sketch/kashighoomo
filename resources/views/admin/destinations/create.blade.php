@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.destinations.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO DESTINATIONS</a>
    <h2 class="fw-bold mt-2">Add New Destination</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Destination Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required placeholder="e.g. Maldives Turquoise Atolls" value="{{ old('name') }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Custom Slug (Optional)</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="e.g. maldives-turquoise-atolls" value="{{ old('slug') }}">
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted d-block mt-1">Will be auto-generated from Name if left blank.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Detailed Description</label>
                        <textarea name="description" class="form-control" rows="8" placeholder="Tell the story of this location..."></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Specific Location (City/Country)</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g. Island Nation, Asia">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Featured Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Image Alt Text</label>
                        <input type="text" name="alt_text" class="form-control" placeholder="Alt text description for accessibility">
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">SEO Settings</h5>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="SEO title for search results">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Brief summary of the destination page">{{ old('meta_description') }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label fw-bold">Custom Meta Tags (HTML)</label>
                    <textarea name="meta_tags" class="form-control" rows="4" placeholder="Enter custom HTML meta tags (e.g. Open Graph, Canonical, JSON-LD)">{{ old('meta_tags') }}</textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">SAVE DESTINATION</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
