@extends('layouts.app')

@section('title', 'Transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengajuan Pengembalian</h1>
            </div>
            <div class="section-body">
                <div class="row ">
                    <div class="col-12">
                        @if (Auth()->user()->hasRole('admin') ||
                                Auth()->user()->hasRole('manajemen'))
                            <div class="card">
                                <div class="card-header">
                                    <h4>Laporan Transaksi</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('transaksi.tampilkan') }}" method="GET">
                                        @csrf
                                        <div class="row">
                                            <div class="col-3">
                                                <!-- Input Tanggal Awal -->
                                                <input type="date"
                                                    class="form-control @error('tanggal_awal') is-invalid @else @if (old('tanggal_awal')) is-valid @endif @enderror"
                                                    id="tanggal_awal" name="tanggal_awal"
                                                    value="{{ isset($tanggal_awal) ? $tanggal_awal : old('tanggal_awal') }}"
                                                    required>
                                                @error('tanggal_awal')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <span class="mt-2">-</span>
                                            <div class="col-3">
                                                <!-- Input Tanggal Akhir -->
                                                <input type="date"
                                                    class="form-control @error('tanggal_akhir') is-invalid @else @if (old('tanggal_akhir')) is-valid @endif @enderror"
                                                    id="tanggal_akhir" name="tanggal_akhir"
                                                    value="{{ isset($tanggal_akhir) ? $tanggal_akhir : old('tanggal_akhir') }}"
                                                    required>
                                                @error('tanggal_akhir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 p-0 mt-1">
                                                <button type="submit" class="btn btn-primary mr-2" name="proses"
                                                    value="tampilkan">
                                                    <i class="fas fa-transaksi-plus"></i> Tampilkan
                                                </button>
                                                <button type="submit" class="btn btn-danger mr-2" name="proses"
                                                    value="pdf">
                                                    <i class="fas fa-file-pdf"></i> PDF
                                                </button>
                                                <button type="submit" class="btn btn-success " name="proses"
                                                    value="excel">
                                                    <i class="fas fa-file-excel"></i> Excel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Tabel List Peminjaman Belum Dikembalikan</h4>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <!-- Tombol Tambah Transaksi dengan Icon -->
                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('transaksi.create') }}" class="btn btn-info ">
                                            <i class="fas fa-transaksi-plus"></i> Tambah Transaksi
                                        </a>
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis</th>
                                                <th>Penerima</th>
                                                <th>Tujuan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksi as $k)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $k->tanggal_transaksi }}
                                                    </td>
                                                    <td>
                                                        {{ $k->jenisTransaksi->jenis }}
                                                    </td>
                                                    <td>
                                                        @if ($k->penerima == null)
                                                            -
                                                        @else
                                                            {{ $k->penerima }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($k->tujuan == null)
                                                            -
                                                        @else
                                                            {{ $k->tujuan }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($k->status == 'diterima')
                                                            <div class="badge badge-success">{{ ucfirst($k->status) }}
                                                            </div>
                                                        @elseif ($k->status == 'ditolak')
                                                            <div class="badge badge-danger">{{ ucfirst($k->status) }}</div>
                                                        @elseif ($k->status == 'direview')
                                                            <div class="badge badge-warning">{{ ucfirst($k->status) }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pengembalian.create', $k->id) }}"
                                                            class="btn btn-icon btn-warning">Kembalikan</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
    <script src="{{ asset('js/page/modules-toastr.js') }}"></script>

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
