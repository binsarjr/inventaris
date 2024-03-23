@extends('layouts.app')

@section('title', 'Penanggung Jawab')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penanggung Jawab</h1>
            </div>
            <div class="section-body">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Tabel List Penanggung Jawab</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <!-- Tombol Tambah User dengan Icon -->
                                    <a href="{{ route('penanggung-jawab.create') }}" class="btn btn-info ">
                                        <i class="fas fa-user-plus"></i> Tambah Penanggung Jawab
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Nama Lengkap</th>
                                                <th>Nomor Handphone</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penanggungJawab as $p)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        @if ($p->foto != null)
                                                            <img alt="image"
                                                                src="{{ asset('img/penanggung-jawab/' . $p->foto) }}"
                                                                class="rounded-circle" width="35" height="35"
                                                                data-toggle="tooltip" title="{{ $p->nama_lengkap }}">
                                                            {{ $p->nama_lengkap }}
                                                        @else
                                                            <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                                                class="rounded-circle" width="35" data-toggle="tooltip"
                                                                title="{{ $p->nama_lengkap }}">
                                                            {{ $p->nama_lengkap }}
                                                        @endif


                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $p->no_hp }}
                                                    </td>
                                                    <td>

                                                        {{ $p->alamat }}
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('penanggung-jawab.destroy', $p->id) }}"
                                                            method="POST" id="deleteForm-{{ $p->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('penanggung-jawab.edit', $p->id) }}"
                                                                class="btn btn-icon btn-primary"><i
                                                                    class="far fa-edit"></i></a>
                                                            <button type="button" class="btn btn-icon btn-danger"
                                                                id="swal-6"
                                                                onclick="confirmDelete('{{ $p->id }}')"><i
                                                                    class="far fa-trash-alt"></i></button>
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
