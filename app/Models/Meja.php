<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    /** @use HasFactory<\Database\Factories\MejaFactory> */
    use HasFactory;

    protected $fillable = [
        'nomor_meja',
        'kapasitas',
        'status',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_meja');
    }
}
