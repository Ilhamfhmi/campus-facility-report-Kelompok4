<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficerResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'damage_report_id',
        'response_content',
        'officer_name',
        'status_update',
    ];

    /**
     * Get the damage report that owns the officer response.
     */
    public function damageReport()
    {
        return $this->belongsTo(DamageReport::class);
    }
}