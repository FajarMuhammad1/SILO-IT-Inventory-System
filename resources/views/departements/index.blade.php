@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Daftar Departemen</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('departements.create') }}" class="btn btn-primary mb-3">+ Tambah Departemen</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Departemen</th>
                <th>Jabatan</th>
                <th>Perusahaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departements as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_departement }}</td>
                    <td>{{ $d->jabatan ?? '-' }}</td>
                    <td>{{ $d->perusahaan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('departements.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('departements.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
