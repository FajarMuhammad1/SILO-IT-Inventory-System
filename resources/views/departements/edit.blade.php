@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Edit Departemen</h3>

    <form action="{{ route('departements.update', $departement->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label>Nama Departemen</label>
            <input type="text" name="nama_departement" class="form-control" value="{{ $departement->nama_departement }}" required>
        </div>
        <div class="form-group mb-2">
            <label>User</label>
            <input type="text" name="user" class="form-control" value="{{ $departement->user }}" >
        </div>
        <div class="form-group mb-2">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $departement->jabatan }}">
        </div>
        <div class="form-group mb-2">
            <label>Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control" value="{{ $departement->perusahaan }}">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="{{ route('departements.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
@endsection
