@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengajuan Peminjaman</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('anggota.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Form Pengajuan Peminjaman</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_transaksi">Tanggal</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_transaksi') is-invalid @else @if (old('tanggal_transaksi')) is-valid @endif @enderror"
                                                    id="tanggal_transaksi" name="tanggal_transaksi"
                                                    value="@php echo date('Y-m-d'); @endphp" required readonly>
                                                @error('tanggal_transaksi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="lampiran">Lampiran</label>
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="lampiran">Choose File</label>
                                                    <input type="file"
                                                        class="form-control @error('lampiran') is-invalid  @elseif(request()->has('lampiran')) is-valid 
                                                @enderror"
                                                        id="lampiran" name="lampiran" accept=".doc, .docx, .pdf"
                                                        onchange="previewImage()">
                                                    @error('lampiran')
                                                        <div class="invalid-feedback">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <select class="form-control select2" id="nama_barang" name="nama_barang">
                                                    <option value="" selected disabled>
                                                    </option>
                                                    @foreach ($barang as $b)
                                                        <option value="{{ $b->id }}"
                                                            data-nama="{{ $b->nama_barang }}"
                                                            data-kategori="{{ $b->kategori->nama }}"
                                                            data-kode="{{ $b->kode_barang }}"
                                                            data-kondisi="{{ $b->kondisi }}"
                                                            data-stok="{{ $b->stok }}">
                                                            {{ $b->nama_barang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="jenis_transaksi" name="jenis_transaksi" value="3">
                                        <input type="hidden" id="id_user" name="id_user"
                                            value="{{ Auth()->user()->id }}">
                                    </div>
                                    <button type="button" class="btn btn-success rounded-pill mb-3"
                                        onclick="tambahItem()">Tambah Barang</button>

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
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cartData">

                                            </tbody>

                                        </table>
                                        @error('id_barang')
                                            <p class="text-center text-danger">{{ $message }}</p>
                                        @enderror
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
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <script>
        var nomorUrut = 1;
        var barangSudahAda = [];

        function tambahItem() {
            // Mendapatkan nilai dari select box
            var selectedOption = $('#nama_barang option:selected');

            // Mendapatkan nilai dari data atribut
            var namaBarang = selectedOption.data('nama');
            var kategori = selectedOption.data('kategori');
            var kodeBarang = selectedOption.data('kode');
            var kondisi = selectedOption.data('kondisi');
            var stok = selectedOption.data('stok');

            // Validasi apakah barang sudah dipilih
            if (!selectedOption.val()) {
                alert('Pilih barang terlebih dahulu.');
                return;
            }

            if (barangSudahAda.includes(selectedOption.val())) {
                alert('Barang ini sudah ada di dalam daftar, silahkan pilih barang yang lain!');
                return;
            }

            // Implementasikan penambahan data ke dalam tabel
            var newRow = '<tr>' +
                '<td>' + nomorUrut + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td>' + kodeBarang + '</td>' +
                '<td>' + namaBarang + '</td>' +
                '<td>' + kondisi + '</td>' +
                '<td>' + stok + '</td>' +
                '<td><input type="number" class="form-control" name="jumlah_transaksi[]" value="0" min="1" max="100"></td>' +
                '<td><button type="button" class="btn btn-icon btn-danger" onclick="removeRow(this)"><i class="far fa-trash-alt"></i></button></td>' +
                '<td><input type="hidden" name="id_barang[]" value="' + selectedOption.val() + '"></td>' +
                '</tr>';

            // Tambahkan baris baru ke dalam tabel
            $('#tabel_barang tbody').append(newRow);
            barangSudahAda.push(selectedOption.val());

            nomorUrut++;
        }

        // Menambahkan barang yang sudah ada ke dalam array
        function tambahBarangSudahAda(idBarang) {
            barangSudahAda.push(idBarang);
        }

        // Fungsi untuk menghapus baris tabel
        function removeRow(button) {
            // Menghapus baris saat tombol hapus diklik
            var tr = $(button).closest('tr');
            var idBarang = tr.find('input[name="id_barang[]"]').val();

            // Hapus barang dari array barangSudahAda
            barangSudahAda.splice(barangSudahAda.indexOf(idBarang), 1);

            tr.remove();
        }
    </script>

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
