@extends('layouts.app')

@section('title', 'Detail Barang')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Barang {{ $barang->nama_barang }}</h1>
            </div>
            <div class="section-body">
                <div class="row ">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header text-center">
                                <h4>Detail Barang {{ $barang->nama_barang }}</h4>
                            </div>
                            <div class="card-header text-left" style="margin-top: -40px">
                                <h4 style="width:75%">Deskripsi : {{ $barang->deskripsi }}</h4>
                            </div>
                            <div class="card-body" style="margin-top: -25px">
                                <div class="mb-3">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h6>Nama Barang</h6>
                                                </th>
                                                <td>
                                                    <h6>:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $barang->nama_barang }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h6>Kode Barang</h6>
                                                </th>
                                                <td>
                                                    <h6>:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $barang->kode_barang }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h6>Kategori Barang</h6>
                                                </th>
                                                <td>
                                                    <h6>:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $barang->kategori->nama }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h6>Stok Barang</h6>
                                                </th>
                                                <td>
                                                    <h6>:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $barang->stok }}</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h6>Kondisi Barang</h6>
                                                </th>
                                                <td>
                                                    <h6>:</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $barang->kondisi }}</h6>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <td>
                                                @if ($barang->foto != null)
                                                    <img alt="image" style="margin-top: -50px"
                                                        src="{{ asset('img/barang/' . $barang->foto) }}" width="350"
                                                        data-toggle="tooltip" title="{{ $barang->nama_barang }}">
                                                @else
                                                    <img alt="image" style="margin-top: -20px"
                                                        src="{{ asset('img/avatar/avatar-1.png') }}" width="180"
                                                        data-toggle="tooltip" title="{{ $barang->nama_barang }}">
                                                @endif


                                            </td>
                                        </table>
                                    </div>
                                </div>

                                <a href="{{ route('peminjaman') }}" class="btn btn-primary float-right mt-2">Kembali</a>

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
