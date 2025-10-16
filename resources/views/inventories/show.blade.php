@extends('layouts.sbadmin')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Detail Barang</h1>

  <div class="card shadow p-4">
    <div class="row">
      <div class="col-md-4 text-center">
        @if($inventory->gambar)
          <img src="{{ asset('storage/'.$inventory->gambar) }}" class="img-fluid mb-3 rounded" alt="Gambar Barang">
        @else
          <img src="https://via.placeholder.com/200" class="img-fluid mb-3 rounded" alt="No Image">
        @endif

        {{-- ✅ Tampilkan Barcode --}}
        @if($inventory->barcode)
          <div class="mt-3">
            {!! DNS1D::getBarcodeHTML($inventory->barcode, 'C39', 1.5, 50) !!}
            <div class="small text-muted mt-1">{{ $inventory->barcode }}</div>
          </div>
        @endif
      </div>

      <div class="col-md-8">
        <table class="table table-borderless">
          <tr><th>Nama Barang</th><td>{{ $inventory->nama_barang }}</td></tr>
          <tr><th>Kategori</th><td>{{ $inventory->kategori }}</td></tr>
          <tr><th>Merk</th><td>{{ $inventory->merk ?? '-' }}</td></tr>
          <tr><th>Serial Number</th><td>{{ $inventory->serial_number ?? '-' }}</td></tr>
          <tr><th>Tipe Barang</th><td>{{ $inventory->tipe_barang }}</td></tr>
          <tr><th>Jumlah</th><td>{{ $inventory->jumlah }}</td></tr>
          <tr><th>Status</th><td>{{ $inventory->status }}</td></tr>
          <tr><th>Lokasi</th><td>{{ $inventory->lokasi ?? '-' }}</td></tr>
          <tr><th>Tanggal Masuk</th><td>{{ $inventory->tanggal_masuk->format('d M Y') }}</td></tr>
        </table>

        <a href="{{ route('inventories.index') }}" class="btn btn-secondary mt-3">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
