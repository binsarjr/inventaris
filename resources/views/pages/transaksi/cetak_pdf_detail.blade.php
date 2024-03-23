<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        label {
            font-weight: bold;
        }

        .col-md-4 {
            margin-bottom: 20px;
        }

        .card-body {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            grid-gap: 1rem;
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-text {
            margin-bottom: 0;
        }
    </style>
</head>

</head>

<body>
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




                </div>
            </div>
        </div>
    </div>



</body>

</html>
