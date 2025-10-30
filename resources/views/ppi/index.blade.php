@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">PPI Request</h3>
    <a href="{{ route('ppi.create') }}" class="btn btn-primary mb-3">+ Tambah PPI Request</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>No PPI</th>
            <th>Departemen</th>
            <th>Perangkat</th>
            <th>BA Kerusakan</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
@foreach($ppiRequests as $r)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $r->tanggal }}</td>
    <td>{{ $r->no_ppi }}</td>
    <td>{{ $r->departement->nama_departement ?? '-' }}</td>
    <td>{{ $r->perangkat }}</td>
    <td>{{ $r->ba_kerusakan }}</td>
    <td>{{ $r->status }}</td>
    <td>{{ $r->keterangan }}</td>
    <td>
        @if($r->file_ppi)
            <a href="{{ asset('uploads/ppi/' . $r->file_ppi) }}" target="_blank">Lihat</a>
        @else
            -
        @endif
    </td>
    <td>
        <a href="{{ route('ppi.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('ppi.destroy', $r->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"
                onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
