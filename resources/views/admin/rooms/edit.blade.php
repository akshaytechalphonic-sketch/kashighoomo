@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.rooms.index') }}" class="text-decoration-none">&larr; Back to Rooms</a>
    <h2 class="mt-2">Edit Room: {{ $room->room_type }}</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hotel *</label>
                    <select name="hotel_id" class="form-select @error('hotel_id') is-invalid @enderror" required>
                        <option value="">Select Hotel</option>
                        @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ (old('hotel_id', $room->hotel_id) == $hotel->id) ? 'selected':'' }}>{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                    @error('hotel_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Room Type / Name *</label>
                    <input type="text" name="room_type" class="form-control @error('room_type') is-invalid @enderror" value="{{ old('room_type', $room->room_type) }}" required>
                    @error('room_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Price per Night (₹) *</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', (float)$room->price) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Max Occupancy *</label>
                    <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $room->capacity) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Room Size</label>
                    <input type="text" name="size" class="form-control" value="{{ old('size', $room->size) }}" placeholder="350 sq ft">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Bed Type</label>
                    <select name="bed_type" class="form-select">
                        <option value="">Select</option>
                        @foreach(['King','Queen','Twin','Double','Single','Bunk'] as $b)
                        <option value="{{ $b }}" {{ old('bed_type',$room->bed_type) == $b ? 'selected':'' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">View Type</label>
                    <select name="view_type" class="form-select">
                        <option value="">Select</option>
                        @foreach(['City View','Garden View','Pool View','Sea View','Mountain View','No View'] as $v)
                        <option value="{{ $v }}" {{ old('view_type',$room->view_type) == $v ? 'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end pb-1">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $room->is_available) ? 'checked':'' }}>
                        <label class="form-check-label" for="is_available">Available for Booking</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Room Description</label>
                    <textarea name="description" rows="3" class="form-control editor">{{ old('description', $room->description) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Inclusions (comma separated)</label>
                    <input type="text" name="inclusions" class="form-control" value="{{ old('inclusions', $room->inclusions ? implode(', ', $room->inclusions) : '') }}" placeholder="Free WiFi, Breakfast">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Exclusions (comma separated)</label>
                    <input type="text" name="exclusions" class="form-control" value="{{ old('exclusions', $room->exclusions ? implode(', ', $room->exclusions) : '') }}" placeholder="Resort fee, Laundry">
                </div>

                {{-- Rate Plans --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Rate Plans</h5></div>
                <div class="col-12" id="rate-plans-container">
                    @forelse($room->rate_plans ?? [] as $plan)
                    <div class="row g-2 mb-2 rate-plan-row align-items-center">
                        <div class="col-md-5"><input type="text" name="plan_name[]" class="form-control" value="{{ $plan['name'] ?? '' }}" placeholder="Plan name"></div>
                        <div class="col-md-4"><input type="number" step="0.01" name="plan_price[]" class="form-control" value="{{ $plan['price'] ?? '' }}" placeholder="Price (₹)"></div>
                        <div class="col-md-2"><select name="plan_type[]" class="form-select">
                            @foreach(['non_refundable'=>'Non-Refundable','flexible'=>'Free Cancellation','bb'=>'Bed & Breakfast','half_board'=>'Half Board','full_board'=>'Full Board','package'=>'Special Package'] as $val=>$label)
                            <option value="{{ $val }}" {{ ($plan['type']??'') == $val ? 'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select></div>
                        <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.rate-plan-row').remove()">&times;</button></div>
                    </div>
                    @empty
                    <div class="row g-2 mb-2 rate-plan-row align-items-center">
                        <div class="col-md-5"><input type="text" name="plan_name[]" class="form-control" placeholder="Plan name" value="Non-Refundable"></div>
                        <div class="col-md-4"><input type="number" step="0.01" name="plan_price[]" class="form-control" placeholder="Price (₹)"></div>
                        <div class="col-md-3"><select name="plan_type[]" class="form-select"><option value="non_refundable" selected>Non-Refundable</option><option value="flexible">Free Cancellation</option><option value="bb">Bed & Breakfast</option><option value="half_board">Half Board</option><option value="full_board">Full Board</option><option value="package">Special Package</option></select></div>
                    </div>
                    @endforelse
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addRatePlan()">+ Add Rate Plan</button>
                </div>

                {{-- Images --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Room Images</h5></div>
                @if(!empty($room->images))
                <div class="col-12">
                    <label class="form-label text-muted small">Existing Images & Alt Text:</label>
                    <div class="row g-3">
                        @foreach($room->images as $img)
                        <div class="col-md-3 col-sm-6 image-container">
                            <div class="card h-100 border">
                                <div class="position-relative text-center bg-light p-2" style="height:120px;">
                                    <img src="{{ asset('storage/'.$img) }}" class="h-100 w-auto object-fit-contain rounded">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 rounded-circle remove-image" 
                                            style="width:20px; height:20px; line-height:1; transform: translate(-5px, 5px);"
                                            data-path="{{ $img }}">
                                        &times;
                                    </button>
                                </div>
                                <div class="card-body p-2">
                                    <label class="small fw-bold mb-1">Alt Text</label>
                                    <input type="text" name="alt_text[{{ $img }}]" class="form-control form-control-sm" value="{{ $room->alt_text[$img] ?? '' }}" placeholder="Image description">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <small class="text-muted d-block mt-2">Upload new images below to add more. Existing ones are kept.</small>
                </div>
                @endif
                <div class="col-12">
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                </div>

                {{-- SEO Metadata --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">SEO Metadata</h5></div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $room->meta_title) }}" placeholder="SEO title for search results">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control" placeholder="Describe the room in 150-160 characters...">{{ old('meta_description', $room->meta_description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $room->meta_keywords) }}" placeholder="keyword1, keyword2, keyword3">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Custom Meta Tags (HTML)</label>
                    <textarea name="meta_tags" class="form-control" rows="4" placeholder="Enter custom HTML meta tags (e.g. Open Graph, Canonical, JSON-LD)">{{ old('meta_tags', $room->meta_tags) }}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-5">Update Room</button>
            </div>
        </form>
    </div>
</div>

<script>
function addRatePlan() {
    const container = document.getElementById('rate-plans-container');
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 rate-plan-row align-items-center';
    row.innerHTML = `
        <div class="col-md-5"><input type="text" name="plan_name[]" class="form-control" placeholder="Plan name"></div>
        <div class="col-md-4"><input type="number" step="0.01" name="plan_price[]" class="form-control" placeholder="Price (₹)"></div>
        <div class="col-md-2"><select name="plan_type[]" class="form-select">
            <option value="non_refundable">Non-Refundable</option><option value="flexible">Free Cancellation</option>
            <option value="bb">Bed & Breakfast</option><option value="half_board">Half Board</option>
            <option value="full_board">Full Board</option><option value="package">Special Package</option>
        </select></div>
        <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.rate-plan-row').remove()">&times;</button></div>`;
    container.appendChild(row);
}
</script>

@push('scripts')
<script>
document.querySelectorAll('.remove-image').forEach(button => {
    button.addEventListener('click', function() {
        if (!confirm('Are you sure you want to remove this image?')) return;

        const container = this.closest('.image-container');
        const path = this.dataset.path;

        fetch('{{ route("admin.rooms.remove-image", $room) }}', {
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
