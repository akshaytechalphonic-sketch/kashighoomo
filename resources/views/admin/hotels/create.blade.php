@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.hotels.index') }}" class="text-decoration-none">&larr; Back to Hotels</a>
    <h2 class="mt-2">Add New Hotel</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                {{-- Basic Info --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hotel Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Custom Slug <span class="text-muted fw-normal">(Optional)</span></label>
                    <div class="input-group">
                        <span class="input-group-text text-muted small">/hotels/</span>
                        <input type="text" name="slug" id="hotel-slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="e.g. taj-ganges-varanasi">
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <small class="text-muted">Leave blank to auto-generate from hotel name.</small>
                </div>
                {{-- <div class="col-md-4">
                    <label class="form-label fw-bold">Location *</label>
                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div> --}}
                <div class="col-md-4">
                    <label class="form-label fw-bold">Destinaitons</label>
                    <select name="destination_id" class="form-select">
                       <option value="">Select One</option>
                       @foreach ($destinations as $item)
                       <option value="{{$item->id}}">{{$item->name}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Star Rating</label>
                    <select name="star_rating" class="form-select">
                        @for($i=1;$i<=5;$i++)
                        <option value="{{ $i }}" {{ old('star_rating',5) == $i ? 'selected':'' }}>{{ $i }} Star</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Managed By</label>
                    <input type="text" name="managed_by" class="form-control" value="{{ old('managed_by') }}" placeholder="e.g. Taj Hotels & Resorts">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Unique Selling Points (USPs)</label>
                    <input type="text" name="usps" class="form-control" value="{{ old('usps') }}" placeholder="Comma separated: Infinity Pool, Private Beach, Butler Service">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" rows="4" class="form-control editor @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Amenities</label>
                    <input type="text" name="amenities" class="form-control" value="{{ old('amenities') }}" placeholder="Free WiFi, Pool, Spa, Gym, Parking">
                </div>

                {{-- Location Details --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Location & Proximity</h5></div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Landmarks</label>
                    <textarea name="landmarks" rows="4" class="form-control" placeholder="One per line: Name|Distance&#10;City Center|2.3 km&#10;Mall|1.1 km">{{ old('landmarks') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Airports</label>
                    <textarea name="airports" rows="4" class="form-control" placeholder="One per line: Name|Distance&#10;International Airport|15 km">{{ old('airports') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Attractions</label>
                    <textarea name="attractions" rows="4" class="form-control" placeholder="One per line: Name|Distance&#10;Eiffel Tower|0.5 km">{{ old('attractions') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Google Maps Embed URL</label>
                    <input type="text" name="map_embed_url" class="form-control" value="{{ old('map_embed_url') }}" placeholder="Paste embed src URL from Google Maps">
                </div>

                {{-- Images --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Hotel Images</h5></div>
                <div class="col-12">
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted">First image will be used as the cover photo.</small>
                </div>
                {{-- SEO Metadata --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">SEO Metadata</h5></div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="SEO title for search results">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control" placeholder="Describe the hotel in 150-160 characters...">{{ old('meta_description') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Custom Meta Tags (HTML)</label>
                    <textarea name="meta_tags" class="form-control" rows="4" placeholder="Enter custom HTML meta tags (e.g. Open Graph, Canonical, JSON-LD)">{{ old('meta_tags') }}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-5">Save Hotel</button>
            </div>
        </form>
    </div>
</div>
@endsection
