<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIRequest extends Model
{
    use HasFactory;

    protected $table = 'ppi_requests';

    protected $fillable = [
        'tanggal',
        'no_ppi',
        'pemohon', // tetap nama user / string
        'departement_id', // relasi ke departemen
        'perangkat',
        'ba_kerusakan',
        'status',
        'keterangan',
        'file_ppi',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}


