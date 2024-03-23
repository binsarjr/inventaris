<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal_transaksi',
        'penerima',
        'tujuan',
        'keterangan',
        'status',
        'lampiran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenisTransaksi()
    {
        return $this->belongsTo(JenisTransaksi::class, 'id_jenis_transaksi');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(PenanggungJawab::class, 'id_penanggung_jawab');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'barang_transaksi', 'id_transaksi', 'id_barang')->withPivot('jumlah_transaksi');
    }
}
