<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'harga',
    ];

    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_menu', 'id_menu', 'id_pesanan');
    }
}
