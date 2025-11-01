@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Helpdesk Monitoring</h4>
        <a href="{{ route('helpdesk.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Laporan
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER DAN SEARCH --}}
    <form method="GET" action="{{ route('helpdesk.index') }}" class="row g-3 mb-3">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama pengguna / deskripsi"
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="departement_id" class="form-select">
                <option value="">Semua Departemen</option>
                @foreach($departements as $dept)
                    <option value="{{ $dept->id }}" {{ request('departement_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->nama_departement }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>Progress</option>
                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">
                <i class="fas fa-search"></i> Filter
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('helpdesk.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-sync"></i> Reset
            </a>
        </div>
    </form>

    {{-- TABEL LAPORAN --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Departemen</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>PIC</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($helpdesks as $index => $helpdesk)
                            <tr>
                                <td>{{ $index + $helpdesks->firstItem() }}</td>
                                <td>{{ $helpdesk->tanggal }}</td>

                                {{-- Nama pengguna manual --}}
                                <td>{{ $helpdesk->pengguna ?? '-' }}</td>

                                {{-- Departemen --}}
                                <td>{{ $helpdesk->departement->nama_departement ?? '-' }}</td>

                                {{-- Deskripsi --}}
                                <td>{{ $helpdesk->deskripsi }}</td>

                                {{-- Status --}}
                                <td>
                                    @if ($helpdesk->status == 'open')
                                        <span class="badge bg-warning text-dark">Open</span>
                                    @elseif ($helpdesk->status == 'progress')
                                        <span class="badge bg-info text-dark">Progress</span>
                                    @else
                                        <span class="badge bg-success">Done</span>
                                    @endif
                                </td>

                                {{-- PIC --}}
                                <td>{{ $helpdesk->pic ?? '-' }}</td>

                                {{-- Dibuat oleh siapa (nama admin login) --}}
                                <td>
                                    {{ optional($helpdesk->user)->name ?? 'Admin' }}
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <a href="{{ route('helpdesk.edit', $helpdesk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('helpdesk.destroy', $helpdesk->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus laporan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Belum ada laporan yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $helpdesks->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
