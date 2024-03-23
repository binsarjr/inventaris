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
                <h1>List & Detail Barang Yang Dapat Dipinjam</h1>
            </div>
            <div class="section-body">
                <div class="row ">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Daftar List Barang Yang Dapat Dipinjam</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">

                                    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#Peminjaman">
                                        Ajukan Peminjaman
                                        </button>
                                        <a href="" class="btn btn-info ml-2">
                                            Export List Barang
                                        </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Nama Barang</th>
                                                <th>Stok Barang</th>
                                                <th>Kategori Barang</th>
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
                                                    <td>{{ $b->kategori->nama }}</td>
                                                    <td>
                                                        <a href="{{ route('detailBarang', $b->id) }}"
                                                            class="btn btn-md btn-primary">Detail</a>
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



    <!-- Modal -->
    <div class="modal fade" id="Peminjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pengajuan Peminjaman Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengajuanPeminjaman') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <label for="">Nama Lengkap</label>
                            <div class="input-group mb-3">
                                <input type="text" value="{{ Auth::user()->nama_lengkap }}" class="form-control"
                                    readonly>
                            </div>

                            <label for="">Tangal Pengajuan</label>
                            <div class="input-group mb-3">
                                <input type="date" value="@php echo date('Y-m-d'); @endphp" class="form-control"
                                    readonly>
                            </div>

                            <label for="barang">Pilih Barang Yang Akan Dipinjam</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect02">
                                    <option selected>Pilih Barang</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <label for="">Jumlah Pengajuan Peminjaman</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control">
                            </div>

                            <label for="">Dokumen Pendukung Untuk Peminjaman</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                                </div>
                            </div>
                            <p class="text-danger">*File yg di terima hanya format pdf dan word</p>


                            {{-- <div class="form-group">
                    <label for="nama">Nama Barang</label>
                    <input type="text"
                        class="form-control @error('nama') is-invalid @else  @if (old('nama')) is-valid @endif  @enderror"
                        id="nama" name="nama" autofocus="on" value="{{ old('nama') }}"
                        required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            <button class="btn btn-warning mr-1" type="reset" id="reset-button">Reset</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
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
