@extends('layouts.auth', ['title' => 'Login'])
<style>
    body {}

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
        background-image: url('/images/background/img-5.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;

        filter: blur(3px);
        transform: scale(1.05);
    }

    /* loading-overlay */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: #fff;
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .loading-overlay .spinner-border {
        width: 4rem;
        height: 4rem;
    }

    .loader-wrapper {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader-wrapper .spinner-border {
        width: 80px;
        height: 80px;
    }

    .loader-logo-inside {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
    }

    /* loading-overlay */

    #togglePasswordBtn {
        cursor: pointer;
    }
</style>
@section('content')
    <div id="pageLoader" class="loading-overlay">
        <div class="loader-wrapper">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <img src="{{ asset('/images/cleanify-logo.png') }}" alt="Cleanify Logo" class="loader-logo-inside">
        </div>
    </div>

    {{-- LOGIN FORM --}}
    <div class="card login-wrapper">
        <div class="card-body p-0 bg-black auth-header-box rounded-top">
            <div class="text-center p-3">
                <a href="{{ route('login') }}" class="logo logo-admin">
                    <img src="{{ asset('/images/logo-sm.png') }}" height="70" alt="logo" class="auth-logo">
                </a>
                <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Let's Get Started Cleanify</h4>
                <p class="text-muted fw-medium mb-0">Sign in to continue to dashboard.</p>
            </div>
        </div>

        <div class="card-body pt-0">
            <form id="loginForm" class="mt-4 mb-2" method="POST" action="{{ route('login') }}">
                @csrf
                {{-- EMAIL --}}
                <div class="form-group mb-2">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- EMAIL --}}

                {{-- PASSWORD --}}
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter Your Password" name="password">

                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>

                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- PASSWORD --}}

                {{-- REMEMBER ME --}}
                <div class="form-group row mt-3">
                    <div class="col-sm-6">
                        <div class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" id="customSwitchSuccess">
                            <label class="form-check-label" for="customSwitchSuccess">Remember me</label>
                        </div>
                    </div>
                </div>
                {{-- REMEMBER ME --}}

                {{-- LOGIN --}}
                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- LOGIN --}}
            </form>
        </div>
    </div>
    {{-- LOGIN FORM --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash) {
                history.replaceState(null, null, '{{ route('login') }}');
            }
            // --- SCRIPT SCRIPT TOGGLE PASSWORD ---
            const toggle = document.getElementById('togglePassword');
            const input = document.getElementById('password');

            if (toggle && input) {
                toggle.addEventListener('click', () => {
                    const isPassword = input.type === "password";
                    input.type = isPassword ? "text" : "password";
                    toggle.querySelector('i').classList.toggle('fa-eye-slash');
                    toggle.querySelector('i').classList.toggle('fa-eye');
                });
            }
            // --- SCRIPT SCRIPT TOGGLE PASSWORD ---

            // --- SCRIPT LOADING ---
            const loginForm = document.getElementById('loginForm');
            const pageLoader = document.getElementById('pageLoader');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            if (loginForm && emailInput && passwordInput) {
                loginForm.addEventListener('submit', function(event) {
                    if (emailInput.value.trim() === '' || passwordInput.value.trim() === '') {
                        return;
                    }

                    if (pageLoader) {
                        pageLoader.style.display = 'flex';
                    }
                });
            }
            // --- SCRIPT LOADING ---

            // --- SCRIPT SWEET ALERT---
            @if (session('logout_success'))

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'warning',
                    title: '{{ session('logout_success') }}'
                });
            @endif
            // --- SCRIPT SWEET ALERT---
        });
    </script>
@endsection
