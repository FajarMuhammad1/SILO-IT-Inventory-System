@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Buat Laporan Helpdesk</h4>

    <form action="{{ route('helpdesk.store') }}" method="POST">
    @csrf

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

       <div class="form-group mb-2">
    <label>Tanggal</label>
    <input type="date"
           name="tanggal"
           class="form-control"
           value="{{ old('tanggal', date('Y-m-d')) }}"   {{-- default hari ini --}}
           required>
    @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
</div>


        <!-- Pengguna -->
        <div class="mb-3">
    <label for="pengguna" class="form-label">Nama User / Pelapor</label>
    <select name="pengguna" id="pengguna" class="form-control" required>
        <option value="">-- Pilih Pengguna --</option>
        @foreach ($departements as $dept)
            @if ($dept->user) {{-- pastiin kolom user gak kosong --}}
                <option value="{{ $dept->user }}">{{ $dept->user }}</option>
            @endif
        @endforeach
    </select>
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
        
        <div class="mb-3">
    <label for="pic" class="form-label">PIC</label>
    <input type="text" name="pic" class="form-control" value="{{ old('pic') }}" required>
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
