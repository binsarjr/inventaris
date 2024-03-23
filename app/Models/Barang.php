<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'id_kategori',
        'deskripsi',
        'stok',
        'kondisi',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'barang_transaksi', 'id_barang', 'id_transaksi',)->withPivot('jumlah_transaksi');
    }
}
