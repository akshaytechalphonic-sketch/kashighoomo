@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.cab-packages.index') }}" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-3" style="color: #1f2937; font-weight: 600;">
        <i class="bi bi-arrow-left"></i> Back to Cab Packages
    </a>
    <h2>Add New Cab Package</h2>
    <p class="text-muted">Create a new vehicle listing for cab bookings and packages</p>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.cab-packages.store') }}" method="POST" enctype="multipart/form-images" id="cabForm">
            @csrf
            
            <div class="row g-4">
                <!-- Cab Name -->
                <div class="col-md-6">
                    <label for="cab_name" class="form-label fw-bold">Cab Name <span class="text-danger">*</span></label>
                    <input type="text" name="cab_name" id="cab_name" class="form-control @error('cab_name') is-invalid @enderror" value="{{ old('cab_name') }}" placeholder="e.g. Maruti Suzuki Dzire" required>
                    @error('cab_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Vehicle Type -->
                <div class="col-md-6">
                    <label for="vehicle_type" class="form-label fw-bold">Vehicle Type <span class="text-danger">*</span></label>
                    <select name="vehicle_type" id="vehicle_type" class="form-select @error('vehicle_type') is-invalid @enderror" required>
                        <option value="" disabled selected>Select Vehicle Type</option>
                        <option value="Sedan" {{ old('vehicle_type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Premium SUV" {{ old('vehicle_type') == 'Premium SUV' ? 'selected' : '' }}>Premium SUV</option>
                        <option value="Tempo Traveler" {{ old('vehicle_type') == 'Tempo Traveler' ? 'selected' : '' }}>Tempo Traveler</option>
                        <option value="Hatchback" {{ old('vehicle_type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                    </select>
                    @error('vehicle_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Seating Capacity -->
                <div class="col-md-6">
                    <label for="seating_capacity" class="form-label fw-bold">Seating Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="seating_capacity" id="seating_capacity" class="form-control @error('seating_capacity') is-invalid @enderror" value="{{ old('seating_capacity') }}" min="1" placeholder="e.g. 4" required>
                    @error('seating_capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Price -->
                <div class="col-md-6">
                    <label for="price" class="form-label fw-bold">Price (₹) <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="e.g. 2500" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Multiple Images -->
                <div class="col-12">
                    <label for="images" class="form-label fw-bold">Upload Vehicle Images</label>
                    <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror" multiple accept="image/*">
                    <small class="text-muted d-block mt-1">You can upload multiple images. Max size 4MB per image.</small>
                    @error('images')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea name="description" id="description" class="form-control editor @error('description') is-invalid @enderror" rows="5" placeholder="Enter details about inclusions, exclusions, route, per km charges, driver allowance, etc.">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Status Checkbox -->
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                        <label class="form-check-label fw-bold" for="status">Active (Available for booking)</label>
                    </div>
                </div>

                {{-- SEO Metadata --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">SEO Metadata</h5></div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="SEO title for search results">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control" placeholder="Describe the cab package in 150-160 characters...">{{ old('meta_description') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Custom Meta Tags (HTML)</label>
                    <textarea name="meta_tags" class="form-control" rows="4" placeholder="Enter custom HTML meta tags (e.g. Open Graph, Canonical, JSON-LD)">{{ old('meta_tags') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-12 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4 py-2 me-2">Create Cab Package</button>
                    <a href="{{ route('admin.cab-packages.index') }}" class="btn btn-outline-secondary px-4 py-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Enforce file input type fix (Laravel sometimes gets confused without files attribute inside controller, but standard HTML form is multipart/form-data)
    document.getElementById('cabForm').setAttribute('enctype', 'multipart/form-data');
</script>
@endsection
