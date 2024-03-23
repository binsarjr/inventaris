@extends('layouts.app')

@section('title', 'Tambah Barang')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Barang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"> <a href="{{ route('barang.index') }}">List Barang</a></div>
                    <div class="breadcrumb-item">Tambah Barang</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="card">
                            <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Form Tambah Barang</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="barang">Nama Barang</label>
                                        <input type="text"
                                            class="form-control @error('nama_barang') is-invalid @else  @if (old('nama_barang')) is-valid @endif  @enderror"
                                            autocomplete="off" id="nama_barang" name="nama_barang" autofocus
                                            value="{{ old('nama_barang') }}" value="{{ old('nama_barang') }}" required>
                                        @error('nama_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <label for="kategori">Kategori Barang</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"></div>
                                        <select class="custom-select" name="id_kategori" id="inputGroupSelect01">
                                            @foreach ($kategori as $k)
                                                <option name="id_kategori" value="{{ $k->id }}">{{ $k->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="validationTextarea">Deskripsi Barang</label>
                                        <textarea name="deskripsi" autocomplete="off" style="height: 100px;" class="form-control" id="validationTextarea"
                                            value="{{ old('deskripsi') }}" placeholder="" required></textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="barang">Stok Barang</label>
                                                <input type="number" autocomplete="off"
                                                    class="form-control @error('stok') is-invalid @else  @if (old('stok')) is-valid @endif  @enderror"
                                                    id="stok" name="stok" autofocus value="{{ old('stok') }}"
                                                    required>
                                                @error('stok')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="kategori">Kondisi Barang</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                </div>
                                                <select class="custom-select" name="kondisi" id="inputGroupSelect01">
                                                    <option name="kondisi" value="Baik">Baik</option>
                                                    <option name="kondisi" value="Rusak">Rusak</option>
                                                </select>
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
