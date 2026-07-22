@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.blogs.index') }}" class="text-decoration-none">&larr; Back to Blogs</a>
    <h2 class="mt-2">Create New Blog Post</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Post Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-4 mb-3 d-flex align-items-end pb-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Publish Post</label>
                    </div>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Post Content</label>
                    <textarea name="content" rows="10" class="form-control editor @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label">Featured Image Alt Text</label>
                    <input type="text" name="alt_text" class="form-control" value="{{ old('alt_text') }}" placeholder="Describe the featured image for screen readers & search engines">
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
                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Brief summary of the blog post">{{ old('meta_description') }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label fw-bold">Custom Meta Tags (HTML)</label>
                    <textarea name="meta_tags" class="form-control" rows="4" placeholder="Enter custom HTML meta tags (e.g. Open Graph, Canonical, JSON-LD)">{{ old('meta_tags') }}</textarea>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary px-4">Save Post</button>
        </form>
    </div>
</div>
@endsection
