@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Departemen</h1>

    <form action="{{ route('departements.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_departement" class="form-label">Nama Departemen</label>
            <input type="text" name="nama_departement" class="form-control" id="nama_departement" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('departements.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
