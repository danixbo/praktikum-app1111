<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    /** @use HasFactory<\Database\Factories\PesananFactory> */
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_meja',
        'tanggal',
    ];

    public function items()
    {
        return $this->belongsToMany(Menu::class, 'pesanan_menu', 'id_pesanan', 'id_menu');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id_pesanan');
    }
}
