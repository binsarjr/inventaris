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
                <h1>Transaksi</h1>
            </div>
            <div class="section-body">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Tabel List Persetujuan Transaksi</h4>
                            </div>
                            <div class="card-body">
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
                                                        <form action="{{ route('transaksi.tolakTransaksi', $k->id) }}"
                                                            method="POST" id="tolakTransaksi-{{ $k->id }}">
                                                            @csrf
                                                            <a href="{{ route('transaksi.edit', $k->id) }}"
                                                                class="btn btn-icon btn-success"><i
                                                                    class="fa-solid fa-check"></i></a>
                                                            <button type="button" class="btn btn-icon btn-danger"
                                                                id="swal-6"
                                                                onclick="tolakTransaksi('{{ $k->id }}')"><i
                                                                    class="fa-solid fa-xmark"></i></button>
                                                        </form>
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
