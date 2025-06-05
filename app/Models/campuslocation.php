<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_name',
        'floor',
        'room_number',
        'description',
        'location_image'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}