@extends('layouts.app')

@section('title', 'Tambah Jenis Transaksi')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
<section class="section">
<div class="section-header">
<h1>Tambah Jenis Transaksi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"> <a href="{{ route('jenis-transaksi.index') }}"> List Jenis Transaksi</a>
    </div>
    <div class="breadcrumb-item">Tambah Jenis Transaksi</div>
</div>
</div>

<div class="section-body">
<div class="row">
    <div class="col-8 ">
        <div class="card">
            <form action="{{ route('jenis-transaksi.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4>Form Tambah jenis Transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="jenis">Jenis Transaksi</label>
                        <input type="text"
                            class="form-control @error('jenis') is-invalid @else  @if (old('jenis')) is-valid @endif  @enderror"
                            id="jenis" name="jenis" autofocus="on" value="{{ old('jenis') }}"
                            required>
                        @error('jenis')
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
