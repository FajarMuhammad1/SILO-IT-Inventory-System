@extends('layouts.sbadmin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Inventaris IT</h1>
  <a href="{{ route('inventories.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Barang
  </a>
</div>

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
    <a href="{{ route('inventories.scan') }}" class="btn btn-success">
      <i class="fas fa-barcode"></i> Scan Barcode
    </a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Barcode</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($inventories as $index => $item)
          <tr>
            <td>{{ $index + $inventories->firstItem() }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->kategori }}</td>
            <td>{{ $item->merk }}</td>
            <td>{{ $item->tipe_barang }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>
              <span class="badge
                @if($item->status == 'OK') badge-success
                @elseif($item->status == 'Rusak') badge-danger
                @else badge-warning @endif">
                {{ $item->status }}
              </span>
            </td>
            <td>
              @if($item->barcode)
                {!! DNS1D::getBarcodeHTML($item->barcode, 'C39', 1.5, 40) !!}
                <div class="small text-center mt-1">{{ $item->barcode }}</div>
              @else
                <span class="text-muted">Belum ada</span>
              @endif
            </td>
            <td>
              <a href="{{ route('inventories.show', $item->id) }}" class="btn btn-sm btn-info">
                  <i class="fas fa-eye"></i>
              </a>

              <a href="{{ route('inventories.edit', $item->id) }}" class="btn btn-sm btn-warning">
                  <i class="fas fa-edit"></i>
              </a>

              <form action="{{ route('inventories.destroy', $item->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">
                  <i class="fas fa-trash"></i>
                  </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="d-flex justify-content-center mt-3">
        {{ $inventories->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
