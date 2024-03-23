@extends('layouts.app')

@section('title', 'Tambah Penanggung Jawab')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
<section class="section">
<div class="section-header">
<h1>Edit Kategori Barang</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"> <a href="{{ route('kategori.index') }}"> List Kategori Barang</a>
    </div>
    <div class="breadcrumb-item">Edir Kategori Barang</div>
</div>
</div>

<div class="section-body">
<div class="row">
    <div class="col-8 ">
        <div class="card">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h4>Form Edit Kategori Barang</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Kategori</label>
                        <input type="text"
                            class="form-control @error('nama') is-invalid @else  @if (old('nama')) is-valid @endif  @enderror"
                            id="nama" name="nama" autofocus="on"  value="{{ old('nama', $kategori->nama ?? '') }}"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
