@extends('layouts.app')

@section('title', 'Jenis Transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jenis Transaksi</h1>
            </div>
            <div class="section-body">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Tabel List Jenis Transaksi</h4>
                            </div>
                            <div class="card-body">
                                @if (Auth()->user()->role == 'admin')
                                    <div class="mb-3">
                                        <!-- Tombol Tambah User dengan Icon -->
                                        <a href="{{ route('jenis-transaksi.create') }}" class="btn btn-info ">
                                            <i class="fas fa-plus"></i> Tambah Jenis Transaksi
                                        </a>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Jenis Transaksi</th>
                                                @if (Auth()->user()->role == 'admin')
                                                    <th>Aksi</th>
                                                @endif

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jenis as $j)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $j->jenis }}
                                                    </td>
                                                    @if (Auth()->user()->role == 'admin')
                                                        <td>
                                                            <form action="{{ route('jenis-transaksi.destroy', $j->id) }}"
                                                                method="POST" id="deleteForm-{{ $j->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="{{ route('jenis-transaksi.edit', $j->id) }}"
                                                                    class="btn btn-icon btn-primary"><i
                                                                        class="far fa-edit"></i></a>
                                                                <button type="button" class="btn btn-icon btn-danger"
                                                                    id="swal-6"
                                                                    onclick="confirmDelete('{{ $j->id }}')"><i
                                                                        class="far fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    @endif
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
