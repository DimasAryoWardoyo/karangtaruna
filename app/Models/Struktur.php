<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    protected $fillable = ['jabatan', 'user_id'];

    // app/Models/Struktur.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
