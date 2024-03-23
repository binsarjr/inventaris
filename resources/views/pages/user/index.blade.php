@extends('layouts.app')

@section('title', 'User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
            </div>
            <div class="section-body">
                {{-- <h2 class="section-title">Daftar pengguna aplikasi Pro-X</h2> --}}
                {{-- <p class="section-lead">
                    Daftar pengguna aplikasi Pro-X
                </p> --}}
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Tabel List User</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <!-- Tombol Tambah User dengan Icon -->
                                    <a href="{{ route('user.create') }}" class="btn btn-info ">
                                        <i class="fas fa-user-plus"></i> Tambah User
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
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        @if ($user->foto != null)
                                                            <img alt="image" src="{{ asset('img/user/' . $user->foto) }}"
                                                                class="rounded-circle" width="35" height="35"
                                                                data-toggle="tooltip" title="{{ $user->nama_lengkap }}">
                                                            {{ $user->nama_lengkap }}
                                                        @else
                                                            <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                                                class="rounded-circle" width="35" data-toggle="tooltip"
                                                                title="{{ $user->nama_lengkap }}">
                                                            {{ $user->nama_lengkap }}
                                                        @endif


                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $user->username }}
                                                    </td>
                                                    <td>
                                                        @if ($user->role == 'admin')
                                                            <div class="badge badge-success">Admin</div>
                                                        @elseif ($user->role == 'manajemen')
                                                            <div class="badge badge-info">Manajemen</div>
                                                        @elseif ($user->role == 'anggota')
                                                            <div class="badge badge-warning">Anggota</div>
                                                        @endif

                                                    </td>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST" id="deleteForm-{{ $user->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('user.edit', $user->id) }}"
                                                                class="btn btn-icon btn-primary"><i
                                                                    class="far fa-edit"></i></a>
                                                            <button type="button" class="btn btn-icon btn-danger"
                                                                id="swal-6"
                                                                onclick="confirmDelete('{{ $user->id }}')"><i
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
