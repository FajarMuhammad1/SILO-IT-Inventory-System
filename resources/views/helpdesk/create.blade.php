@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Laporan Helpdesk</h2>

    <form action="{{ route('helpdesk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="departement_id" class="form-label">Departemen</label>
            <select name="departement_id" class="form-control" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departements as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Masalah</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('helpdesk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
