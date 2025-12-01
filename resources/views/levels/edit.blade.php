@php
    /** @var \App\Models\Level $level */
@endphp

@extends('layouts.vertical', ['title' => 'Edit Level'])

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Edit Level</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('levels.index') }}">Levels & Permissions</a></li>
                        <li class="breadcrumb-item active">Edit Level</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM EDIT LEVEL --}}
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Level Details</h4>
                    <p class="text-muted mb-0">Change details for this level.</p>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('levels.update', $level->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- LEVEL NAME --}}
                        <div class="mb-3 mt-3">
                            <label class="form-label" for="nama_level">Level Name</label>
                            <input type="text" class="form-control @error('nama_level') is-invalid @enderror" name="nama_level"
                                id="nama_level" placeholder="Enter level name" required
                                value="{{ old('nama_level', $level->nama_level) }}">
                            @error('nama_level')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- LEVEL NAME --}}

                        {{-- DESCRIPTION --}}
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                rows="3" placeholder="Enter a short description">{{ old('description', $level->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- DESCRIPTION --}}

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="Active" {{ old('status', $level->status) == 'Active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="Inactive" {{ old('status', $level->status) == 'Inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                        {{-- STATUS --}}

                        {{-- BUTTON ACTION --}}
                        <div class="modal-footer">
                            <a href="{{ route('levels.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Level</button>
                        </div>
                        {{-- BUTTON ACTION --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- FORM EDIT LEVEL --}}
@endsection
