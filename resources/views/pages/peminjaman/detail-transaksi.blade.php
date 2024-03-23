@extends('layouts.app')

@section('title', 'Detail Riwayat Transaksi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')<div class="main-content">
<section class="section">
<div class="section-header">
<h1>Detail Riwayat Transaksi</h1>
</div>
<div class="section-body">
<div class="row ">
<div class="col-12">
<div class="card shadow">
<div class="card-header text-center">
<h4>Detail Riwayat Transaksi Anda Pada Tanggal {{ $transaksi->tanggal_transaksi }} </h4> 
</div>
<div class="card-header text-left" style="margin-top: -30px;">
    <h6>Note : Pengajuan Peminjaman Kamu Di {{ $transaksi->status }}, {{$transaksi->keterangan}}

<div class="card-body" style="margin-top: -10px">
<div class="mb-3">
</div>
  <div class="row">
    <div class="col-md-8">
        <h4>Informasi Pengajuan Peminjaman</h4>
      <form action="">
            <label for="">Nama Lengkap</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{ Auth::user()->nama_lengkap }}" readonly>
            </div>
            <label for="">Nama Barang</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="@foreach($transaksi->barang as $barang)
            {{ $barang->nama_barang }} @endforeach" readonly>
            </div>
            <label for="">Jumlah Transaksi</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{ $transaksi->jumlah_transaksi }}" readonly>
            </div>
            <label for="">Penanggung Jawab Peminjaman-mu</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{ $transaksi->penanggungJawab->nama_lengkap }}" readonly>
            </div>
            <label for="">Keterangan</label>
            <div class="form-group" style="height="100px">
                <textarea class="form-control" id="exampleFormControlTextarea1" readonly rows="3">{{ $transaksi->keterangan }}</textarea>
            </div>
           

      </form>
    </div>

    <div class="col-md-4">
        @if($transaksi->status === 'terima')
        <h4>Informasi Kontak Penanggung Jawab Dipeminjaman Ini</h4>
        @elseif($transaksi->status === 'review')
            <h4>-</h4>
        @elseif($transaksi->status === 'tolak')
            <h4>-</h4>
        @endif
    </div>
    
  </div>
  <a href="{{ route('dashboardAnggota') }}" class="btn btn-primary float-right mt-2">Kembali</a>
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