<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
  Schema::create('ppi_requests', function (Blueprint $table) {
    $table->id();
    $table->date('tanggal');
    $table->string('no_ppi')->unique();
    $table->string('pemohon'); // nama pemohon
    $table->foreignId('departement_id')->nullable()->constrained('departements')->onDelete('set null');
    $table->string('perangkat');
    $table->enum('ba_kerusakan', ['Ada','Permintaan Baru'])->default('Permintaan Baru');
    $table->enum('status', ['Open','Reject','Closed'])->default('Open');
    $table->text('keterangan')->nullable();
    $table->string('file_ppi')->nullable();
    $table->timestamps();
});



}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppi_requests');
    }
};
