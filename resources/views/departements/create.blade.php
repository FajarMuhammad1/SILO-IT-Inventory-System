@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Tambah Departemen</h3>

    <form action="{{ route('departements.store') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label>Nama Departemen</label>
            <input type="text" name="nama_departement" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control">
        </div>
        <div class="form-group mb-2">
            <label>Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control">
        </div>
        <button type="submit" class="btn btn-success mt-2">Simpan</button>
        <a href="{{ route('departements.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
@endsection
