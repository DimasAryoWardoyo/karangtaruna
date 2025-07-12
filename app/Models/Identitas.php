<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;
    protected $table = 'identitas';

    protected $fillable = ['user_id', 'no_whatsapp', 'tanggal_lahir', 'status', 'alasan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
