<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_id',
        'nama_konten',
        'tanggal_konten',
        'deskripsi',
        'gambar1',
        'gambar2',
        'gambar3'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
