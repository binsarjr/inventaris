


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>

    <h4 class="text-center my-3">Laporan Seluruh Transaksi</h4>
    <h5 class="text-center mb-3">{{ $tanggal_awal }} sampai {{ $tanggal_akhir }}</h5>
    <table class="table table-bordered table-striped table-info">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jenis</th>
                <th scope="col">Penerima</th>
                <th scope="col">Tujuan</th>
                <th scope="col">Status</th>
                <th scope="col">Penanggung Jawab</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $k)
                <tr class="table-warning">
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
                        {{ $k->penerima }}
                    </td>
                    <td>
                        {{ $k->tujuan }}
                    </td>
                    <td>
                        {{ ucfirst($k->status) }}
                    </td>
                    <td>
                        @if ($k->penanggungJawab == null)
                            -
                        @else
                            {{ $k->penanggungJawab->nama_lengkap }}
                        @endif
                    </td>
                    <td>
                        @if ($k->keterangan == null)
                            -
                        @else
                            {{ $k->keterangan }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
