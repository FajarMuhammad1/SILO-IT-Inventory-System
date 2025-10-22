@extends('layouts.sbadmin')


@section('title', 'Daftar Barang')

@section('content')
<div class="container mt-4">
    <h3>Daftar Barang</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('inventories.create') }}" class="btn btn-success mb-3">Tambah Barang</a>
    <a href="{{ route('inventories.scan') }}" class="btn btn-info mb-3">Scan Barcode</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Barcode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventories as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->tipe_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->barcode }}</td>
                    <td>
                        <a href="{{ route('inventories.show', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        <a href="{{ route('inventories.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('inventories.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $inventories->links() }}
</div>
@endsection
