@extends('layouts.app')

@section('title', 'Dashboard User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class=" col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Barang Tersedia</h4>
                            </div>
                            <div class="card-body">
                                {{ count($barang) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Transaksi Saya</h4>
                            </div>
                            <div class="card-body">
                                {{ count($transaksi) }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kategori Barang</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2" height="180"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengajuan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart3" height="180"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="section-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <form action="{{ route('anggotaUpdate', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Data Diri Saya</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('nama_lengkap') is-invalid @enderror"
                                            name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap ?? '') }}"
                                            id="nama_lengkap" required>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username"
                                            value="{{ old('username', $user->username ?? '') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password"
                                                class="form-control pwstrength @error('password') is-invalid @enderror"
                                                data-indicator="pwindicator" id="password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        @if ($user->foto)
                                            <div class="row">
                                                <img src="{{ asset('img/user/' . $user->foto) }}"
                                                    class="img-preview mb-3 col-sm-3 d-block"
                                                    data-src="{{ asset('img/user/' . $user->foto) }}">
                                            </div>
                                        @else
                                            <div class="row">
                                                <img class="img-preview mb-3 col-sm-3 d-block">
                                            </div>
                                        @endif
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="foto">Choose File</label>
                                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                                id="foto" name="foto" accept="image/*" id="foto"
                                                onchange="previewImage()">
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
            </div> --}}
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
    <script src="{{ asset('js/page/modules-toastr.js') }}"></script>

    <script>
        @php
            $countKategori = [];
            $backgroundColor = [];
            foreach ($kategori as $d) {
                $countKategori[] = count($barang->where('id_kategori', $d->id));
                $backgroundColor[] = 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ',.8)';
            }
        @endphp
        var ctx = document.getElementById("myChart2").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [
                    @foreach ($kategori as $d)
                        "{{ $d->nama }}",
                    @endforeach
                ],
                datasets: [{
                        label: "Statistics",

                        data: [
                            @foreach ($countKategori as $c)
                                "{{ $c }}",
                            @endforeach
                        ],
                        borderWidth: 2,
                        backgroundColor: [
                            @foreach ($backgroundColor as $b)
                                "{{ $b }}",
                            @endforeach
                        ],
                        borderColor: "transparent",
                        borderWidth: 0,
                        pointBackgroundColor: "#999",
                        pointRadius: 4,
                    },

                ],
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            display: false,
                        },
                    }, ],
                },
            },
        });
        @php
            $status = ['diterima', 'ditolak', 'direview'];
            $countStatus = [];
            foreach ($status as $s) {
                $countStatus[] = count($transaksi->where('status', $s));
            }
        @endphp
        var ctx = document.getElementById("myChart3").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: [
                    @foreach ($status as $s)
                        "{{ ucfirst($s) }}",
                    @endforeach
                ],
                datasets: [{
                        label: "Statistics",
                        data: [
                            @foreach ($countStatus as $c)
                                "{{ $c }}",
                            @endforeach
                        ],
                        borderWidth: 2,
                        backgroundColor: [
                            'rgb(71,195,99)',
                            'rgb(252,84,75)',
                            'rgb(255,193,7)'
                        ],
                        hoverOffset: 4,
                    },

                ],
            },

        });
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
