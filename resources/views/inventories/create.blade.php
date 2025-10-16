@extends('layouts.sbadmin')

@section('content')
<div class="container">
  <h1 class="h3 mb-4 text-gray-800">Tambah Barang Baru</h1>

  <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label>Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <input type="text" name="kategori" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Merk</label>
      <input type="text" name="merk" class="form-control">
    </div>

    <div class="form-group">
      <label>Serial Number</label>
      <input type="text" name="serial_number" class="form-control">
    </div>

    <div class="form-group">
      <label>Tipe Barang</label>
      <select name="tipe_barang" class="form-control" required>
        <option value="Consumable">Consumable</option>
        <option value="Non-Consumable">Non-Consumable</option>
      </select>
    </div>

    <div class="form-group">
      <label>Jumlah</label>
      <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Tanggal Masuk</label>
      <input type="date" name="tanggal_masuk" class="form-control" required>
    </div>

    <div class="form-group">
      <label>PO Number</label>
      <input type="text" name="po_number" class="form-control">
    </div>

    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" name="lokasi" class="form-control">
    </div>

    <div class="form-group">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="OK">OK</option>
        <option value="Rusak">Rusak</option>
        <option value="Hilang">Hilang</option>
      </select>
    </div>

    {{-- ✅ Upload + Preview Gambar --}}
    <div class="form-group">
      <label>Upload Gambar (opsional)</label>
      <input type="file" name="gambar" class="form-control-file" id="previewImage">
      <img id="imagePreview" src="#" alt="Preview" class="mt-2" width="120" style="display:none;">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>

{{-- ✅ Script preview gambar --}}
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
