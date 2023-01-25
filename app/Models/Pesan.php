<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerima_id',
        'pengirim_id',
        'judul',
        'isi',
        'status',
        'tanggal_kirim'

    ];

    public $timestamps = false;

    public function penerima()
    {
        return $this->belongsTo(User::class,);
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class,);
    }
}
