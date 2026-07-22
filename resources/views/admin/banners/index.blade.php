@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Banner Management</h2>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-circle"></i> Add New Banner
    </a>
</div>

{{-- Flash messages --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Page</th>
                    <th>Title & Subtitle</th>
                    <th>Image</th>
                    <th>Button</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr>
                    <td>
                        @if($banner->page)
                            <span class="fw-semibold text-dark">{{ $banner->page->page_name }}</span>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold text-navy">{{ $banner->title ?? 'No Title' }}</div>
                        @if($banner->subtitle)
                            <div class="text-muted small">{{ $banner->subtitle }}</div>
                        @endif
                    </td>
                    <td>
                        @if($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="img-fluid rounded border" style="height: 50px; max-width: 100px; object-fit: cover;">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>
                        @if($banner->button_link)
                            <div>
                                <a href="{{ $banner->button_link }}" target="_blank" class="text-decoration-none small text-primary fw-bold">
                                    {{ $banner->button_text ?: 'Click Here' }}
                                </a>
                            </div>
                            <small class="text-muted text-break">{{ $banner->button_link }}</small>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $banner->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $banner->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-info" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this banner?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No banners found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">{{ $banners->links() }}</div>
    </div>
</div>
@endsection
