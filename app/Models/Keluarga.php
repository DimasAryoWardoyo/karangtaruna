<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $fillable = ['undangan_id', 'nama', 'hubungan'];

    public function undangan()
    {
        return $this->belongsTo(Undangan::class);
    }
}
