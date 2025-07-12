<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = [
        'agenda_id',
        'user_id',
        'waktu_presensi',
        'token_yang_dipakai'
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
