@extends('layouts.app')

@section('title', 'Tambah Penanggung Jawab')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Penanggung Jawab</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"> <a href="{{ route('penanggung-jawab.index') }}"> Penanggung Jawab</a>
                    </div>
                    <div class="breadcrumb-item">Tambah Penanggung Jawab</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Tambah Penanggung Jawab</h2>
                <p class="section-lead">
                    Menambah data pengguna aplikasi Pro-X
                </p> --}}
                <div class="row">
                    <div class="col-8 ">
                        <div class="card">
                            <form action="{{ route('penanggung-jawab.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Form Tambah Penanggung Jawab</h4>
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
                                        <label for="no_hp">Nomor Handphone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="tel"
                                                class="form-control phone-number @error('no_hp') is-invalid @else @if (old('no_hp')) is-valid @endif @enderror"
                                                name="no_hp" value="{{ old('no_hp') }}" id="no_hp" pattern="[0-9]*">
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea data-height="75"
                                            class="form-control @error('alamat') is-invalid @else @if (old('alamat')) is-valid @endif @enderror"
                                            id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
    {{-- <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.id.js') }}"></script> --}}

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
