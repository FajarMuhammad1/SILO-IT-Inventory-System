@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        <i class="bi bi-building"></i> Daftar Departemen
    </h2>

    {{-- Tombol Tambah Departemen --}}
    <div class="mb-3">
        <a href="{{ route('departements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Departemen
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Departemen --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Departemen</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departements as $index => $dept)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dept->nama_departement }}</td>
                            <td>
                                <a href="{{ route('departements.show', $dept) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('departements.edit', $dept) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('departements.destroy', $dept) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus departemen ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada departemen yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
