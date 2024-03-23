@extends('layouts.app')

@section('title', 'Persetujuan Transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Persetujuan Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"> <a href="{{ route('transaksi.index') }}"> Transaksi</a></div>
                    <div class="breadcrumb-item">Persetujuan Transaksi</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4> Persetujuan Transaksi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_transaksi">Tanggal</label>
                                                <p>{{ $transaksi->tanggal_transaksi }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Transaksi</label>
                                                <p>{{ $transaksi->jenisTransaksi->jenis }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="penerima">Penerima</label>
                                                @if ($transaksi->penerima == null)
                                                    <p>-</p>
                                                @else
                                                    <p>{{ $transaksi->penerima }}</p>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tujuan">Tujuan</label>
                                                @if ($transaksi->tujuan == null)
                                                    <p>-</p>
                                                @else
                                                    <p>{{ $transaksi->tujuan }}</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <p>{{ ucfirst($transaksi->status) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="lampiran">Lampiran</label>
                                                @if ($transaksi->lampiran == null)
                                                    <p>-</p>
                                                @else
                                                    <a href="{{ asset('lampiran/' . $transaksi->lampiran) }}"
                                                        class="d-block" target="_blank">{{ $transaksi->lampiran }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="penanggung_jawab">Penanggung Jawab</label>
                                                <select
                                                    class="form-control @error('penanggung_jawab') is-invalid @else @if (old('penanggung_jawab')) is-valid @endif @enderror"
                                                    id="penanggung_jawab" name="penanggung_jawab" required>
                                                    <option value="" selected disabled></option>
                                                    @foreach ($penanggung_jawabs as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama_lengkap }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('penanggung_jawab')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text"
                                                    class="form-control @error('keterangan') is-invalid @else  @if (old('keterangan')) is-valid @endif  @enderror"
                                                    id="keterangan" name="keterangan" value="{{ old('keterangan') }}"
                                                    required>
                                                @error('keterangan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    {{-- <button type="button" class="btn btn-success rounded-pill mb-3" data-toggle="modal"
                                        data-target="#exampleModal">Persetujuan Barang</button> --}}

                                    <div class="table-responsive">
                                        <table class="table-bordered table-md table" id="tabel_barang">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kategori</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Kondisi</th>
                                                    <th>Stok</th>
                                                    <th>Jumlah Transaksi</th>

                                                </tr>
                                            </thead>
                                            <tbody id="cartData">
                                                @foreach ($barangs as $k)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $k->kategori->nama }}</td>
                                                        <td>{{ $k->kode_barang }}</td>
                                                        <td>{{ $k->nama_barang }}</td>
                                                        <td>{{ $k->kondisi }}</td>
                                                        <td>{{ $k->stok }}</td>
                                                        <td>{{ $k->pivot->jumlah_transaksi }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Setujui</button>
                                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    @if (session('success'))
        <script>
            iziToast.success({
                title: 'Berhasil!',
                message: '{{ session('success') }}',
                position: 'topRight'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            iziToast.error({
                title: 'Gagal!',
                message: '{{ session('error') }}',
                position: 'topRight'
            });
        </script>
    @endif
@endpush
