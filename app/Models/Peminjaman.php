<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'perlengkapan_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'tanggapan_admin',
    ];
    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];
    public function perlengkapan()
    {
        return $this->belongsTo(Perlengkapan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function isSelesai()
    {
        return now()->gt($this->tanggal_kembali);
    }

}
