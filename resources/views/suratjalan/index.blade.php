@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Informasi Surat Jalan</h4>

    <a href="{{ route('suratjalan.create') }}" class="btn btn-primary mb-3">+ Tambah Surat Jalan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>No SJ</th>
                <th>No PPI</th>
                <th>No PO</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Qty</th>
                <th>Tanggal Input</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratJalan as $index => $sj)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sj->no_sj }}</td>
                    <td>{{ $sj->no_ppi }}</td>
                    <td>{{ $sj->no_po }}</td>
                    <td>{{ $sj->kategori }}</td>
                    <td>{{ $sj->merk }}</td>
                    <td>{{ $sj->model }}</td>
                    <td>{{ $sj->qty }}</td>
                    <td>{{ $sj->tanggal_input }}</td>
                    <td>
                        @if($sj->file)
                            <a href="{{ asset('storage/' . $sj->file) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('suratjalan.edit', $sj->id_sj) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('suratjalan.destroy', $sj->id_sj) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center text-muted">Belum ada data Surat Jalan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
