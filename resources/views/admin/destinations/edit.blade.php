@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.destinations.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO DESTINATIONS</a>
    <h2 class="fw-bold mt-2">Edit Destination</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Destination Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', $destination->name) }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Custom Slug (Optional)</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $destination->slug) }}" placeholder="e.g. maldives-turquoise-atolls">
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted d-block mt-1">Will remain unchanged or auto-generated if left blank.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Detailed Description</label>
                        <textarea name="description" class="form-control" rows="8">{{ old('description', $destination->description) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Specific Location (City/Country)</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $destination->location) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Featured Image</label>
                        @if($destination->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $destination->image) }}" class="rounded-3" width="100" height="60" style="object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave empty to keep existing image.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Image Alt Text</label>
                        <input type="text" name="alt_text" class="form-control" value="{{ old('alt_text', $destination->alt_text) }}" placeholder="Describe the image for SEO and screen readers">
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">SEO Settings</h5>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $destination->meta_title) }}" placeholder="SEO title for search results">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Brief summary of the destination page">{{ old('meta_description', $destination->meta_description) }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $destination->meta_keywords) }}" placeholder="keyword1, keyword2, keyword3">
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label fw-bold">Custom Meta Tags (HTML)</label>
                    <textarea name="meta_tags" class="form-control" rows="4" placeholder="Enter custom HTML meta tags (e.g. Open Graph, Canonical, JSON-LD)">{{ old('meta_tags', $destination->meta_tags) }}</textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">UPDATE DESTINATION</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
