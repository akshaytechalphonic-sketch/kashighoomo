@php
    // Determine if we have a banner instance (edit) or are creating a new one
    $isEdit = isset($banner);
@endphp

<div class="mb-3">
    <label for="page_id" class="form-label">Page <span class="text-danger">*</span></label>
    <select name="page_id" id="page_id" class="form-select" required>
        <option value="">Select Page</option>
        @foreach($pages as $p)
            <option value="{{ $p->id }}" {{ old('page_id', $isEdit ? $banner->page_id : '') == $p->id ? 'selected' : '' }}>
                {{ $p->page_name }} ({{ $p->slug }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="title" class="form-label">Title (optional)</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $isEdit ? $banner->title : '') }}">
</div>

<div class="mb-3">
    <label for="subtitle" class="form-label">Subtitle (optional)</label>
    <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle', $isEdit ? $banner->subtitle : '') }}">
</div>

<div class="mb-3">
    <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
    @if($isEdit && $banner->image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" style="height: 80px;" class="border rounded">
        </div>
    @endif
    <input type="file" name="image" id="image" class="form-control" {{ $isEdit ? '' : 'required' }} accept="image/*">
    <small class="form-text text-muted">Recommended size: 1200×400px.</small>
</div>

<div class="mb-3">
    <label for="button_text" class="form-label">Button Text (optional)</label>
    <input type="text" name="button_text" id="button_text" class="form-control" value="{{ old('button_text', $isEdit ? $banner->button_text : '') }}" placeholder="e.g. Book Yatra Now">
</div>

<div class="mb-3">
    <label for="button_link" class="form-label">Button Link (optional)</label>
    <input type="text" name="button_link" id="button_link" class="form-control" value="{{ old('button_link', $isEdit ? $banner->button_link : '') }}" placeholder="e.g. /packages or https://...">
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="status" id="status" class="form-check-input" value="1" {{ old('status', $isEdit ? $banner->status : true) ? 'checked' : '' }}>
    <label class="form-check-label" for="status">Active</label>
</div>
