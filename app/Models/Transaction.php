<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'user_id',
        'tipe_transaksi',
        'tanggal',
        'jumlah',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
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
