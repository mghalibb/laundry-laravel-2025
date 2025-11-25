@php
    /** @var \App\Models\User $user */
@endphp
@php
    /** @var \Illuminate\Support\Collection $levels */
@endphp
@extends('layouts.vertical', ['title' => 'Edit User'])

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Edit User</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Edit User --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Details</h4>
                    <p class="text-muted mb-0">Change user details below.</p>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="form-label">User Photo (Optional)</label>
                            <div class="d-flex align-items-center">
                                {{-- <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('/images/users/avatar-2.jpg') }}"
                                    id="photoPreview" class="me-2 thumb-xl rounded border-dashed" alt="Photo Profile"> --}}
                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : '/images/users/avatar-2.jpg' }}"
                                    id="photoPreview" class="me-2 thumb-xl rounded border-dashed" alt="User Photo">
                                <div class="flex-grow-1 text-truncate">
                                    <label class="btn btn-primary text-light">
                                        Change Photo
                                        <input type="file" name="photo" id="photoInput" hidden="">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter full name" value="{{ $user->name }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Enter username" value="{{ $user->username }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter email address" value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Fill to change password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">Leave blank if you don't want to change the
                                password.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="id_level">Level</label>
                            <select class="form-select" name="id_level" id="id_level" required>
                                <option value="">--Select Level--</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}"
                                        {{ old('id_level', $user->id_level) == $level->id ? 'selected' : '' }}>
                                        {{ $level->nama_level }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === SCRIPT PREVIEW PHOTO ===
            const photoInput = document.getElementById('photoInput');
            const photoPreview = document.getElementById('photoPreview');

            if (photoInput) {
                photoInput.addEventListener('change', function(event) {
                    if (event.target.files && event.target.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            photoPreview.src = e.target.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                });
            }
            // === SCRIPT PREVIEW PHOTO ===

            // === SCRIPT TOGGLE PASSWORD ===
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    const icon = this.querySelector('i');
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                });
            }
            // === SCRIPT TOGGLE PASSWORD ===
        });
    </script>
@endsection
