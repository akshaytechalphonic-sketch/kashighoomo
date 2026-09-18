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

                <!-- Existing Images -->
                <div class="col-12">
                    <label class="form-label fw-bold">Vehicle Images</label>
                    @if(!empty($cabPackage->images) && count($cabPackage->images) > 0)
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            @foreach($cabPackage->images as $img)
                                <div class="position-relative image-container">
                                    <img src="{{ asset('storage/' . $img) }}" alt="Cab" class="rounded border shadow-sm" style="height: 100px; width: 140px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 rounded-circle remove-image" 
                                            style="width: 24px; height: 24px; line-height: 1; transform: translate(35%, -35%);"
                                            data-path="{{ $img }}">
                                        &times;
                                    </button>
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
