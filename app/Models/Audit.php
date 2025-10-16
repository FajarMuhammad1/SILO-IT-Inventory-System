<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'user_id',
        'tanggal_audit',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_audit' => 'date',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
