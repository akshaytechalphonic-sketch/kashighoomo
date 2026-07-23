@extends('layouts.app')

@push('styles')
    <style>
        /* ===== Full Screen Premium Login Layout ===== */
        body.login-page-bg {
            background: linear-gradient(135deg, rgba(6, 22, 36, 0.95) 0%, rgba(20, 10, 5, 0.9) 100%),
                url('https://images.unsplash.com/photo-1561361513-2d000a50f0dc?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 20px;
            margin: 0 auto;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            padding: 40px 35px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            max-height: 65px;
            object-fit: contain;
            margin-left:80px;
        }

        .login-title {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #1a1a2e;
            text-align: center;
            margin-bottom: 6px;
        }

        .login-subtitle {
            font-size: 13px;
            color: #777;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 11px;
            font-weight: 700;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1.5px solid #e8e8e8 !important;
            border-radius: 12px !important;
            padding: 12px 16px !important;
            font-size: 14px !important;
            background: #fcfcfc !important;
            color: #333 !important;
            transition: all 0.25s !important;
        }

        .form-control:focus {
            border-color: #F57C00 !important;
            box-shadow: 0 0 0 3px rgba(245, 124, 0, 0.08) !important;
            background: #ffffff !important;
        }

        .form-check-input:checked {
            background-color: #F57C00 !important;
            border-color: #F57C00 !important;
        }

        .btn-login {
            background: linear-gradient(135deg, #F57C00 0%, #E65100 100%);
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 50px;
            border: none;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(245, 124, 0, 0.25);
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 124, 0, 0.35);
        }

        .forgot-link {
            font-size: 12.5px;
            color: #F57C00 !important;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #E65100 !important;
        }

        .back-home {
            text-align: center;
            margin-top: 24px;
        }

        .back-home a {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7) !important;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .back-home a:hover {
            color: #ffffff !important;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
        }
    </style>
@endpush

@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('login-page-bg');
    });
</script>

<div class="login-wrapper">
    <div class="login-card wow animate__animated animate__fadeInUp">
        <div class="login-logo">
            <a href="{{ url('/') }}" class="text-decoration-none">
                @if(!empty($settings->site_logo))
                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name ?? 'visitKashi' }}">
                @else
                    <span style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; letter-spacing: -0.5px; line-height: 1;">
                        <span style="color: #F57C00;"><i class="bi bi-water me-1"></i>Kashi</span><span style="color: #8B1E1E;">Tourism</span>
                    </span>
                @endif
            </a>
        </div>
        
        <h2 class="login-title">Welcome Back</h2>
        <p class="login-subtitle">Sign in to access your administrative dashboard.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="admin@visitkashi.com" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert" style="display:block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label mb-0">Password</label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Forgot?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert" style="display:block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-muted" for="remember" style="font-size: 13px;">
                        Keep me logged in
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Sign In
            </button>
        </form>
    </div>

    <div class="back-home">
        <a href="{{ url('/') }}">
            <i class="bi bi-arrow-left"></i> Back to Homepage
        </a>
    </div>
</div>
@endsection
