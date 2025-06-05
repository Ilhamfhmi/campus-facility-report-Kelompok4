<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'user_id',
        'location',
        'description',
        'photo_proof',
        'status',
    ];

    // Relasi ke user yang membuat laporan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
