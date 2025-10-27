<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpdeskMonitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'user_id',
        'departement_id',
        'deskripsi',
        'status',
        'pic',
    ];

    // Relasi ke user (admin atau staff)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke departemen
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}
