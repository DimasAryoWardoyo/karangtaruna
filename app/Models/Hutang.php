<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jumlah',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
