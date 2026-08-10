@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.cab-packages.index') }}" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-3" style="color: #1f2937; font-weight: 600;">
        <i class="bi bi-arrow-left"></i> Back to Cab Packages
    </a>
    <h2>Edit Cab Package: {{ $cabPackage->cab_name }}</h2>
    <p class="text-muted">Update vehicle listing details, pricing, and images</p>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.cab-packages.update', $cabPackage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <!-- Cab Name -->
                <div class="col-md-6">
                    <label for="cab_name" class="form-label fw-bold">Cab Name <span class="text-danger">*</span></label>
                    <input type="text" name="cab_name" id="cab_name" class="form-control @error('cab_name') is-invalid @enderror" value="{{ old('cab_name', $cabPackage->cab_name) }}" required>
                    @error('cab_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Custom Slug -->
                <div class="col-md-6">
                    <label for="slug" class="form-label fw-bold">Custom Slug (Optional)</label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $cabPackage->slug) }}" placeholder="e.g. maruti-suzuki-dzire">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted d-block mt-1">Will remain unchanged or auto-generated if left blank.</small>
                </div>

                <!-- Vehicle Type -->
                <div class="col-md-6">
                    <label for="vehicle_type" class="form-label fw-bold">Vehicle Type <span class="text-danger">*</span></label>
                    <select name="vehicle_type" id="vehicle_type" class="form-select @error('vehicle_type') is-invalid @enderror" required>
                        <option value="" disabled>Select Vehicle Type</option>
                        <option value="Sedan" {{ old('vehicle_type', $cabPackage->vehicle_type) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="SUV" {{ old('vehicle_type', $cabPackage->vehicle_type) == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Premium SUV" {{ old('vehicle_type', $cabPackage->vehicle_type) == 'Premium SUV' ? 'selected' : '' }}>Premium SUV</option>
                        <option value="Tempo Traveler" {{ old('vehicle_type', $cabPackage->vehicle_type) == 'Tempo Traveler' ? 'selected' : '' }}>Tempo Traveler</option>
                        <option value="Hatchback" {{ old('vehicle_type', $cabPackage->vehicle_type) == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                    </select>
                    @error('vehicle_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Seating Capacity -->
                <div class="col-md-6">
                    <label for="seating_capacity" class="form-label fw-bold">Seating Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="seating_capacity" id="seating_capacity" class="form-control @error('seating_capacity') is-invalid @enderror" value="{{ old('seating_capacity', $cabPackage->seating_capacity) }}" min="1" required>
                    @error('seating_capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Price -->
                <div class="col-md-6">
                    <label for="price" class="form-label fw-bold">Price (₹) <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $cabPackage->price) }}" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Existing Images & Alt Text -->
                <div class="col-12">
                    <label class="form-label fw-bold">Vehicle Images & Alt Text</label>
                    @if(!empty($cabPackage->images) && count($cabPackage->images) > 0)
                        <div class="row g-3 mb-3">
                            @foreach($cabPackage->images as $img)
                                <div class="col-md-3 col-sm-6 image-container">
                                    <div class="card h-100 border">
                                        <div class="position-relative text-center bg-light p-2" style="height:120px;">
                                            <img src="{{ asset('storage/' . $img) }}" class="h-100 w-auto object-fit-contain rounded">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 rounded-circle remove-image" 
                                                    style="width:20px; height:20px; line-height:1; transform: translate(-5px, 5px);"
                                                    data-path="{{ $img }}">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="card-body p-2">
                                            <label class="small fw-bold mb-1">Alt Text</label>
                                            <input type="text" name="alt_text[{{ $img }}]" class="form-control form-control-sm" value="{{ $cabPackage->alt_text[$img] ?? '' }}" placeholder="Image description">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-light border text-muted small py-2 mb-3">No images uploaded yet.</div>
                    @endif
                    
                    <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple accept="image/*">
                    <small class="text-muted d-block mt-1">Upload new images to add them. Existing images are preserved unless removed.</small>
                    @error('images')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea name="description" id="description" class="form-control editor @error('description') is-invalid @enderror" rows="5">{{ old('description', $cabPackage->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Status Checkbox -->
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', $cabPackage->status) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="status">Active (Available for booking)</label>
                    </div>
                </div>

                {{-- SEO Metadata --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">SEO Metadata</h5></div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $cabPackage->meta_title) }}" placeholder="SEO title for search results">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control" placeholder="Describe the cab package in 150-160 characters...">{{ old('meta_description', $cabPackage->meta_description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $cabPackage->meta_keywords) }}" placeholder="keyword1, keyword2, keyword3">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Custom Meta Tags (HTML)</label>
                    <textarea name="meta_tags" class="form-control" rows="4" placeholder="Enter custom HTML meta tags (e.g. Open Graph, Canonical, JSON-LD)">{{ old('meta_tags', $cabPackage->meta_tags) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-12 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4 py-2 me-2">Update Cab Package</button>
                    <a href="{{ route('admin.cab-packages.index') }}" class="btn btn-outline-secondary px-4 py-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.remove-image').forEach(button => {
    button.addEventListener('click', function() {
        if (!confirm('Are you sure you want to remove this vehicle image?')) return;

        const container = this.closest('.image-container');
        const path = this.dataset.path;

        fetch('{{ route("admin.cab-packages.remove-image", $cabPackage->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ image_path: path })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                container.remove();
            } else {
                alert(data.message || 'Failed to remove image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the image');
        });
    });
});
</script>
@endpush
@endsection
