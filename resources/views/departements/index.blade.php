@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Daftar Departemen</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('departements.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Departemen
    </a>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nama Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($departements as $dept)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dept->nama_departement }}</td>
                    <td>
                        <a href="{{ route('departements.show', $dept->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('departements.edit', $dept->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('departements.destroy', $dept->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus departemen ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data departemen</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
