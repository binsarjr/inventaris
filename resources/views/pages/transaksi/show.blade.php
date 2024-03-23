@extends('layouts.app')

@section('title', 'Detail Transaksi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Transaksi</h1>
                @if (Auth()->user()->hasRole('admin') ||
                        Auth()->user()->hasRole('manajemen'))
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"> <a href="{{ route('transaksi.index') }}"> Transaksi</a></div>
                        <div class="breadcrumb-item">Detail Transaksi</div>
                    </div>
                @endif
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4> Detail Transaksi</h4>

                            </div>
                            <div class="card-body">

                                <div class="row mt-3">
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
                                                <a href="{{ asset('lampiran/' . $transaksi->lampiran) }}" class="d-block"
                                                    target="_blank">{{ $transaksi->lampiran }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if ($transaksi->status == 'diterima')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Penanggung Jawab</label>
                                                @if ($transaksi->penanggungJawab == null)
                                                    <p>-</p>
                                                @else
                                                    <p>{{ $transaksi->penanggungJawab->nama_lengkap }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                @if ($transaksi->keterangan == null)
                                                    <p>-</p>
                                                @else
                                                    <p>{{ $transaksi->keterangan }}</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor Telepon</label>
                                                @if ($transaksi->penanggungJawab == null)
                                                    <p>-</p>
                                                @else
                                                    <p>{{ $transaksi->penanggungJawab->no_hp }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- <button type="button" class="btn btn-success rounded-pill mb-3" data-toggle="modal"
                                        data-target="#exampleModal">Detail Barang</button> --}}

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

                                <a href="{{ route('transaksi.cetak_pdf_detail', $transaksi->id) }}"
                                    class="btn btn-danger mr-2" name="proses" value="pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                                {{-- <a href="" class="btn btn-success mr-2 " target="_blank">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a> --}}
                                @if (Auth()->user()->hasRole('admin') ||
                                        Auth()->user()->hasRole('manajemen'))
                                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                                @elseif (Auth()->user()->hasRole('anggota'))
                                    <a href="{{ route('anggota.riwayat') }}" class="btn btn-secondary">Kembali</a>
                                @endif

                            </div>
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
@endpush
