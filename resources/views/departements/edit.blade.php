@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Departemen</h1>

    <form action="{{ route('departements.update', $departement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_departement" class="form-label">Nama Departemen</label>
            <input type="text" name="nama_departement" class="form-control" id="nama_departement"
                   value="{{ $departement->nama_departement }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('departements.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
