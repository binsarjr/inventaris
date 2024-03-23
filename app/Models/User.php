<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user';

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    protected $fillable = [
        'nama_lengkap',
        'username',
        'foto',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [];
}
