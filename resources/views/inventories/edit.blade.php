@extends('layouts.sbadmin')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Edit Barang</h1>

  <form action="{{ route('inventories.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" value="{{ $inventory->nama_barang }}" required>
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <input type="text" name="kategori" class="form-control" value="{{ $inventory->kategori }}" required>
    </div>

    <div class="form-group">
      <label>Merk</label>
      <input type="text" name="merk" class="form-control" value="{{ $inventory->merk }}">
    </div>

    <div class="form-group">
      <label>Serial Number</label>
      <input type="text" name="serial_number" class="form-control" value="{{ $inventory->serial_number }}">
    </div>

    <div class="form-group">
      <label>Tipe Barang</label>
      <select name="tipe_barang" class="form-control" required>
        <option value="Consumable" @if($inventory->tipe_barang == 'Consumable') selected @endif>Consumable</option>
        <option value="Non-Consumable" @if($inventory->tipe_barang == 'Non-Consumable') selected @endif>Non-Consumable</option>
      </select>
    </div>

    <div class="form-group">
      <label>Jumlah</label>
      <input type="number" name="jumlah" class="form-control" value="{{ $inventory->jumlah }}" required>
    </div>

    <div class="form-group">
      <label>Tanggal Masuk</label>
      <input type="date" name="tanggal_masuk" class="form-control" value="{{ $inventory->tanggal_masuk->format('Y-m-d') }}" required>
    </div>

    <div class="form-group">
      <label>PO Number</label>
      <input type="text" name="po_number" class="form-control" value="{{ $inventory->po_number }}">
    </div>

    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" name="lokasi" class="form-control" value="{{ $inventory->lokasi }}">
    </div>

    <div class="form-group">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="OK" @if($inventory->status == 'OK') selected @endif>OK</option>
        <option value="Rusak" @if($inventory->status == 'Rusak') selected @endif>Rusak</option>
        <option value="Hilang" @if($inventory->status == 'Hilang') selected @endif>Hilang</option>
      </select>
    </div>

    {{-- ✅ Bagian Upload Gambar dengan Preview --}}
    <div class="form-group">
      <label>Upload Gambar (opsional)</label>
      @if($inventory->gambar)
      <div class="mb-2">
        <img src="{{ asset('storage/'.$inventory->gambar) }}" width="100" alt="Gambar Lama">
      </div>
      @endif
      <input type="file" name="gambar" class="form-control-file" id="previewImage">
      <img id="imagePreview" src="#" alt="Preview Gambar Baru" class="mt-2" width="120" style="display:none;">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>

{{-- ✅ Script Preview --}}
<script>
document.getElementById('previewImage').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(){
        const preview = document.getElementById('imagePreview');
        preview.src = reader.result;
        preview.style.display = 'block';
    }
    reader.readAsDataURL(e.target.files[0]);
});
</script>

@endsection
