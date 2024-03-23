<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    use HasFactory;

    protected $table = 'jenis_transaksi';
    protected $fillable = [
        'jenis',
    ];

    public $timestamps = false;

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_jenis_transaksi');
    }
}
