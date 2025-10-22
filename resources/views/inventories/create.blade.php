@extends('layouts.sbadmin')

@section('title', 'Tambah Barang')

@section('content')
<div class="container mt-4">
    <h3>Tambah Barang</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Merk</label>
            <input type="text" name="merk" class="form-control">
        </div>

        <div class="mb-3">
            <label>Serial Number</label>
            <input type="text" name="serial_number" class="form-control">
        </div>

        {{-- ✅ ENUM: Tipe Barang --}}
        <div class="mb-3">
            <label>Tipe Barang</label>
            <select name="tipe_barang" class="form-control" required>
                <option value="" disabled selected>-- Pilih Tipe Barang --</option>
                <option value="consumable">Consumable (Habis Pakai)</option>
                <option value="non-consumable">Non-Consumable (Tidak Habis Pakai)</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>PO Number</label>
            <input type="text" name="po_number" class="form-control">
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control">
        </div>

        {{-- ✅ ENUM: Status Barang --}}
       <div class="mb-3">
    <label>Status</label>
 <select name="status" class="form-select" required>
    <option value="">-- Pilih Status --</option>
    <option value="ok" {{ old('status', $inventory->status ?? '') == 'ok' ? 'selected' : '' }}>OK</option>
    <option value="rusak" {{ old('status', $inventory->status ?? '') == 'rusak' ? 'selected' : '' }}>Rusak</option>
    <option value="hilang" {{ old('status', $inventory->status ?? '') == 'hilang' ? 'selected' : '' }}>Hilang</option>
    <option value="dipakai" {{ old('status', $inventory->status ?? '') == 'dipakai' ? 'selected' : '' }}>Dipakai</option>
    <option value="baru" {{ old('status', $inventory->status ?? '') == 'baru' ? 'selected' : '' }}>Baru</option>
</select>


        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
