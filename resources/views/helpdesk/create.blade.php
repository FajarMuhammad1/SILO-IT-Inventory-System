@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Buat Laporan Helpdesk</h4>

    <form action="{{ route('helpdesk.store') }}" method="POST">
        @csrf

        <!-- Tanggal -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <!-- Pengguna -->
        <div class="mb-3">
            <label for="pengguna" class="form-label">Nama Pengguna / Pelapor</label>
            <input type="text" name="pengguna" class="form-control" placeholder="Masukkan nama pelapor (misal: bambang)" required>
        </div>

        <!-- Departemen -->
        <div class="mb-3">
            <label for="departement_id" class="form-label">Departemen</label>
            <select name="departement_id" class="form-control" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach ($departements as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->nama_departement }}</option>
                @endforeach
            </select>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Aduan</label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan keluhan atau masalah..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
    </form>
</div>
@endsection
