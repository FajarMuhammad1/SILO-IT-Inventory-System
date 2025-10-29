<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpdeskMonitoring extends Model
{
    use HasFactory;

protected $fillable = [
    'tanggal',
    'pengguna',
    'departement_id',
    'deskripsi',
    'status',
    'pic',
    'user_id',
];



    // Relasi ke user (admin atau staff)
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // Relasi ke departemen
   public function departement()
{
    return $this->belongsTo(Departement::class);
}

}
