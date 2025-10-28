@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4"><i class="bi bi-plus-circle"></i> Tambah Departemen</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('departements.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_departement" class="form-label">Nama Departemen</label>
                    <input type="text" name="nama_departement" id="nama_departement"
                           class="form-control @error('nama_departement') is-invalid @enderror"
                           value="{{ old('nama_departement') }}" required>
                    @error('nama_departement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('departements.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
