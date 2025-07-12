<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_id',
        'pembicara',
        'poin_pembahasan',
        'notulen',
    ];


    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}

