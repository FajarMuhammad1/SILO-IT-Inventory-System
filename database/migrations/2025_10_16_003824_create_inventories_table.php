<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->string('merk')->nullable();
            $table->string('serial_number')->unique()->nullable();
            $table->enum('tipe_barang', ['consumable', 'non-consumable']);
            $table->integer('jumlah')->default(1);
            $table->date('tanggal_masuk')->nullable();
            $table->string('po_number')->nullable();
            $table->string('lokasi')->nullable();
            $table->enum('status', ['ok', 'rusak', 'hilang', 'dipakai','baru'])->default('ok');
            $table->string('barcode')->unique();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
