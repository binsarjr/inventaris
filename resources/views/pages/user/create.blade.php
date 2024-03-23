@extends('layouts.app')

@section('title', 'Tambah User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"> <a href="{{ route('user.index') }}"> User</a></div>
                    <div class="breadcrumb-item">Tambah User</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Tambah User</h2>
                <p class="section-lead">
                    Menambah data pengguna aplikasi Pro-X
                </p> --}}
                <div class="row">
                    <div class="col-8 ">
                        <div class="card">
                            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Form Tambah User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('nama_lengkap') is-invalid @else  @if (old('nama_lengkap')) is-valid @endif  @enderror"
                                            id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                            required>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text"
                                            class="form-control @error('username') is-invalid @else  @if (old('username')) is-valid @endif  @enderror"
                                            id="username" name="username" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password"
                                                class="form-control pwstrength @error('password') is-invalid @else  @if (old('password')) is-valid @endif  @enderror"
                                                data-indicator="pwindicator" id="password" name="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>

                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="d-block">Role</label>
                                        @foreach ($roles as $role)
                                            <div class="form-check-inline">
                                                <input class="form-check-input @error('role') is-invalid @else is-valid @enderror"
                                                    type="radio" name="role" id="{{ $role }}"
                                                    value="{{ $role }}" {{ $loop->first ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $role }}">
                                                    {{ ucfirst($role) }}
                                                </label>

                                            </div>
                                        @endforeach
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label>Role</label>
                                        <div>
                                            <div class="selectgroup w-100">
                                                @foreach ($roles as $role)
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="role" id="role"
                                                            value="{{ $role }}"
                                                            class="selectgroup-input @error('role') is-invalid @else  @if (old('role')) is-valid @endif  @enderror"
                                                            {{ old('role') == $role ? 'checked' : '' }}>
                                                        <span class="selectgroup-button"> {{ ucfirst($role) }}</span>
                                                        @error('role')
                                                            @if ($loop->first)
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @endif
                                                        @enderror
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <div class="row">
                                            <img class="img-preview mb-3 col-sm-3 d-block">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="foto">Choose File</label>
                                            <input type="file"
                                                class="form-control @error('foto') is-invalid  @elseif(request()->has('foto')) is-valid 
                                                @enderror"
                                                id="foto" name="foto" accept="image/*" id="foto"
                                                onchange="previewImage()">
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <button class="btn btn-secondary" type="reset" id="reset-button">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
