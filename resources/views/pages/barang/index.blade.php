@extends('layouts.app')

@section('title', 'List Barang')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>List Barang</h1>
            </div>
            <div class="section-body">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Tabel List Barang</h4>
                            </div>
                            <div class="card-body">
                                @if (Auth()->user()->hasRole('admin') ||
                                        Auth()->user()->hasRole('manajemen'))
                                    <div class="mb-3">
                                        <!-- Tombol Tambah User dengan Icon -->
                                        <a href="{{ route('barang.create') }}" class="btn btn-info ">
                                            <i class="fas fa-plus"></i> Tambah Barang
                                        </a>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                @if (Auth()->user()->hasRole('admin') ||
                                                        Auth()->user()->hasRole('manajemen'))
                                                    <th>Kondisi</th>
                                                @elseif (Auth()->user()->hasRole('anggota'))
                                                    <th>Kategori</th>
                                                @endif

                                                {{-- <th>Foto</th> --}}
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barang as $b)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>{{ $b->nama_barang }}</td>
                                                    <td>{{ $b->stok }}</td>
                                                    @if (Auth()->user()->hasRole('admin') ||
                                                            Auth()->user()->hasRole('manajemen'))
                                                        <td>{{ $b->kondisi }}</td>
                                                    @elseif (Auth()->user()->hasRole('anggota'))
                                                        <td>{{ $b->kategori->nama }}</td>
                                                    @endif

                                                    <td>
                                                        @if (Auth()->user()->hasRole('admin') ||
                                                                Auth()->user()->hasRole('manajemen'))
                                                            <form action="{{ route('barang.destroy', $b->id) }}"
                                                                method="POST" class="mt-1"
                                                                id="deleteForm-{{ $b->id }}">
                                                                <a href="{{ route('barang.edit', $b->id) }}"
                                                                    class="btn btn-icon btn-warning"><i
                                                                        class="far fa-edit"></i></a>
                                                                <a href="{{ route('barang.show', $b->id) }}"
                                                                    class="btn btn-icon btn-primary"><i
                                                                        class="far fa-eye"></i></a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-icon btn-danger"
                                                                    id="swal-6"
                                                                    onclick="confirmDelete('{{ $b->id }}')"><i
                                                                        class="far fa-trash-alt"></i></button>
                                                            </form>
                                                        @elseif (Auth()->user()->hasRole('anggota'))
                                                            <a href="{{ route('barang.show', $b->id) }}"
                                                                class="btn btn-icon btn-primary">Detail</a>
                                                        @endif

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
