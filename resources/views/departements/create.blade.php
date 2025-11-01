@extends('layouts.app')

@section('content')
<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h3 class="mb-3">Tambah Departemen</h3>

    <form action="{{ route('departements.store') }}" method="POST">
        @csrf

        <div class="form-group mb-2">
            <label>Nama Departemen</label>
            <input type="text" name="nama_departement" class="form-control" 
                   value="{{ old('nama_departement') }}" required>
            @error('nama_departement') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-2">
            <label>User</label>
            <input type="text" name="user" class="form-control" 
                   value="{{ old('user') }}" required>
            @error('user') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-2">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}">
            @error('jabatan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-2">
            <label>Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control" value="{{ old('perusahaan') }}">
            @error('perusahaan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success mt-2">Simpan</button>
        <a href="{{ route('departements.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
@endsection
