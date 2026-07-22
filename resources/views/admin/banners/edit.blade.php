@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Banner</h2>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm border-0">
    @csrf
    @method('PUT')
    <div class="card-body">
        @include('admin.banners._form', ['banner' => $banner])
    </div>
    <div class="card-footer bg-white text-end">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Update Banner
        </button>
    </div>
</form>
@endsection
