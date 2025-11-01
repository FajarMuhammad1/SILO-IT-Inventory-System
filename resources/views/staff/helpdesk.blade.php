@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tiket Helpdesk Anda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pengguna</th>
                <th>Departemen</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($helpdesks as $index => $ticket)
            <tr>
                <td>{{ $helpdesks->firstItem() + $index }}</td>
                <td>{{ $ticket->tanggal }}</td>
                <td>{{ $ticket->pengguna }}</td>
                <td>{{ $ticket->departement->nama_departement ?? '-' }}</td>
                <td>{{ $ticket->deskripsi }}</td>
                <td>{{ ucfirst($ticket->status) }}</td>
                <td>
                    <!-- Form Update Status -->
                    <form action="{{ route('staff.helpdesk.update', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-control form-control-sm mb-1">
                            <option value="open" {{ $ticket->status=='open'?'selected':'' }}>Open</option>
                            <option value="progress" {{ $ticket->status=='progress'?'selected':'' }}>Progress</option>
                            <option value="done" {{ $ticket->status=='done'?'selected':'' }}>Done</option>
                        </select>
                        <textarea name="deskripsi" class="form-control form-control-sm mb-1" rows="1" placeholder="Update deskripsi (opsional)"></textarea>
                        <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada tiket untuk Anda</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $helpdesks->links() }}
    </div>
</div>
@endsection
