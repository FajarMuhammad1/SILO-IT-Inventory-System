@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Helpdesk Monitoring</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(Auth::user()->role === 'staff')
        <a href="{{ route('helpdesk.create') }}" class="btn btn-primary mb-3">+ Tambah Laporan</a>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Departemen</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>PIC</th>
                <th>Dibuat oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($helpdesks as $key => $h)
            <tr>
                <td>{{ $key + $helpdesks->firstItem() }}</td>
                <td>{{ $h->tanggal }}</td>
                <td>{{ $h->departement->nama ?? '-' }}</td>
                <td>{{ $h->deskripsi }}</td>
                <td>
                    <span class="badge 
                        @if($h->status == 'open') bg-warning 
                        @elseif($h->status == 'progress') bg-info 
                        @else bg-success @endif">
                        {{ ucfirst($h->status) }}
                    </span>
                </td>
                <td>{{ $h->pic ?? '-' }}</td>
                <td>{{ $h->user->name ?? '-' }}</td>
                <td>
                    @if(Auth::user()->role === 'admin' || Auth::id() === $h->user_id)
                        <a href="{{ route('helpdesk.edit', $h->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('helpdesk.destroy', $h->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada laporan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $helpdesks->links() }}
</div>
@endsection
