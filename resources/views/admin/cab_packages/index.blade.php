@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Cab Booking Packages</h2>
        <p class="text-muted mb-0">Manage vehicle classes, pricing, and seating capacities for cab bookings</p>
    </div>
    <a href="{{ route('admin.cab-packages.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add New Cab Package
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-3 py-3">Vehicle Details</th>
                        <th class="px-3 py-3">Vehicle Type</th>
                        <th class="px-3 py-3 text-center">Seating Capacity</th>
                        <th class="px-3 py-3">Price</th>
                        <th class="px-3 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cabPackages as $cab)
                    <tr>
                        <td class="px-4 py-3 text-muted fw-bold">#{{ $cab->id }}</td>
                        <td class="px-3 py-3">
                            <div class="d-flex align-items-center gap-3">
                                @if(!empty($cab->images) && count($cab->images) > 0)
                                    <img src="{{ asset('storage/' . $cab->images[0]) }}" alt="{{ $cab->cab_name }}" class="rounded-3 shadow-sm" style="width: 60px; height: 45px; object-fit: cover;">
                                @else
                                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 45px;">
                                        <i class="bi bi-car-front" style="font-size: 1.2rem;"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $cab->cab_name }}</div>
                                    @if($cab->description)
                                        <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">
                                            {{ Str::limit(strip_tags($cab->description), 50) }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                {{ $cab->vehicle_type }}
                            </span>
                        </td>
                        <td class="px-3 py-3 text-center">
                            <div class="fw-bold" style="font-size: 0.95rem;">
                                <i class="bi bi-people me-1 text-muted"></i>{{ $cab->seating_capacity }} Seater
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <div class="fw-bold text-primary-blue" style="font-size: 1rem; color: #1f2937;">
                                ₹{{ number_format($cab->price, 2) }}
                            </div>
                        </td>
                        <td class="px-3 py-3 text-center">
                            <span class="badge rounded-pill px-3 py-2 {{ $cab->status ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}" style="font-weight: 600; font-size: 0.75rem;">
                                {{ $cab->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.cab-packages.edit', $cab->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.cab-packages.destroy', $cab->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this cab package?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center gap-2">
                                <i class="bi bi-car-front text-muted" style="font-size: 2.5rem;"></i>
                                <span class="text-muted">No cab packages found. Click "Add New Cab Package" to get started.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($cabPackages->hasPages())
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Showing {{ $cabPackages->firstItem() }} to {{ $cabPackages->lastItem() }} of {{ $cabPackages->total() }} cabs
            </div>
            {{ $cabPackages->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
