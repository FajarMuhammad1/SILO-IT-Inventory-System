<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
    ];

    public function helpdesks()
    {
        return $this->hasMany(HelpdeskMonitoring::class);
    }
}
