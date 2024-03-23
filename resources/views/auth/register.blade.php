@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')

    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('postRegister') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input id="nama_lengkap" type="nama_lengkap"
                        class="form-control @error('nama_lengkap') is-invalid
                        @else  @if (old('nama_lengkap')) is-valid @endif  @enderror"
                        name="nama_lengkap" autocomplete="off" tabindex="1" autofocus required
                        value="{{ old('nama_lengkap') }}">
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="username"
                        class="form-control @error('username') is-invalid
                        @else  @if (old('username')) is-valid @endif  @enderror"
                        name="username" autocomplete="off" tabindex="2" autofocus required value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid
                        @else  @if (old('password')) is-valid @endif  @enderror"
                        name="password" tabindex="3" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password-confirm" class="control-label">Confirm Password</label>
                    </div>
                    <input id="password-confirm" type="password"
                        class="form-control @error('password_confirmation') is-invalid
                        @else  @if (old('password_confirmation')) is-valid @endif  @enderror"
                        name="password_confirmation" tabindex="4" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <!-- Checkbox Persetujuan Kebijakan -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="agreement" class="custom-control-input" tabindex="5" id="agreement"
                            required>
                        <label class="custom-control-label" for="agreement">Saya setuju dengan Kebijakan Privasi dan
                            Syarat
                            & Ketentuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="5">
                        Register
                    </button>
                </div>
            </form>
            <div class="form-group">
                <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
