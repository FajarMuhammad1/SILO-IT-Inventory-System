<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'kategori',
        'merk',
        'serial_number',
        'tipe_barang',
        'jumlah',
        'tanggal_masuk',
        'po_number',
        'lokasi',
        'status',
        'barcode',
        'gambar',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    // relations
    public function audits()
    {
        return $this->hasMany(Audit::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
