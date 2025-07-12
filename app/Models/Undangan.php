<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_almarhum', 'umur', 'hari_wafat', 'jam_wafat', 'lokasi_wafat', 'hari_pemakaman', 'jam_pemakaman', 'tempat_pemakaman'];

    public function keluargas()
    {
        return $this->hasMany(Keluarga::class);
    }
}
