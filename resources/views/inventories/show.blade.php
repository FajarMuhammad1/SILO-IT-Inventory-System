@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Inventaris</h5>
            <a href="{{ route('inventories.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 text-center">
                   @if($inventory->gambar)
    <img src="{{ asset('storage/' . $inventory->gambar) }}" 
         alt="Gambar Barang" 
         class="img-fluid rounded shadow-sm"
         style="max-height: 220px;">
@else
    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height: 220px;">
        <span class="text-muted">Tidak ada gambar</span>
    </div>
@endif

                </div>

                <div class="col-md-8">
                    <table class="table table-bordered">
    <tr>
        <th style="width: 30%">Nama Barang</th>
        <td>{{ $inventory->nama_barang }}</td>
    </tr>
    <tr>
        <th>Kategori</th>
        <td>{{ $inventory->kategori ?? '-' }}</td>
    </tr>
    <tr>
        <th>Barcode</th>
        <td>{{ $inventory->barcode }}</td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td>{{ $inventory->jumlah }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
          @if($inventory->status === 'ok')
    <span class="badge bg-success">OK</span>
@elseif($inventory->status === 'rusak')
    <span class="badge bg-danger">Rusak</span>
@elseif($inventory->status === 'hilang')
    <span class="badge bg-secondary">Hilang</span>
@elseif($inventory->status === 'dipakai')
    <span class="badge bg-warning text-dark">Dipakai</span>
@elseif($inventory->status === 'baru')
    <span class="badge bg-info text-dark">Baru</span>
@else
    <span class="badge bg-light text-dark">Tidak diketahui</span>
@endif

        </td>
    </tr>
    <tr>
        <th>Lokasi</th>
        <td>{{ $inventory->lokasi ?? '-' }}</td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{{ $inventory->merk ?? '-' }}</td>
    </tr>
    <tr>
        <th>Tanggal Masuk</th>
        <td>{{ $inventory->tanggal_masuk->format('d M Y') }}</td>
    </tr>
</table>

                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
