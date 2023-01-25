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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode',
        'nis',
        'fullname',
        'username',
        'password',
        'kelas',
        'alamat',
        'verif',
        'role',
        'join_date',
        'terakhir_login',
        'foto'

    ];

    public $timestamps = false;

    public function pengirim()
    {
        return $this->hasOne(Pesan::class, 'pengirim_id');
    }

    public function penerima()
    {
        return $this->hasMany(Pesan::class, 'penerima_id');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
