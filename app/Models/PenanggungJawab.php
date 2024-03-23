<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanggungJawab extends Model
{
    use HasFactory;

    protected $table = 'penanggung_jawab';
    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'alamat',
        'foto',
    ];

    public $timestamps = false;
}
