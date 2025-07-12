<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'nama_agenda',
        'kategori',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'foto',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    // Menghitung status agenda secara dinamis
    public function getStatusAttribute()
    {
        $now = Carbon::now();
        if ($now->lt($this->waktu_mulai)) {
            return 'Akan Datang';
        } elseif ($now->between($this->waktu_mulai, $this->waktu_selesai)) {
            return 'Sedang Berlangsung';
        } else {
            return 'Selesai';
        }
    }

    // Relasi ke presensi (satu agenda memiliki banyak presensi)
    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }

    // Relasi ke notulen (satu agenda memiliki satu notulen)
    public function notulen()
    {
        return $this->hasOne(Notulen::class);
    }

    // Fungsi untuk generate token unik yang berubah tiap menit
    public function generateToken()
    {
        return hash('sha256', $this->id . now()->format('YmdHi') . config('app.key'));
    }
}
