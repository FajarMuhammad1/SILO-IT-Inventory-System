@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Surat Jalan</h4>
    <form action="{{ route('suratjalan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-2">
            <label>No SJ</label>
            <input type="text" name="no_sj" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>No PPI</label>
            <select name="no_ppi" class="form-control">
                <option value="">-- Pilih No PPI --</option>
                @foreach($ppiRequests as $p)
                    <option value="{{ $p->no_ppi }}">{{ $p->no_ppi }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-2">
            <label>No PO</label>
            <input type="text" name="no_po" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Merk</label>
            <input type="text" name="merk" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Model</label>
            <input type="text" name="model" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Spesifikasi</label>
            <textarea name="spesifikasi" class="form-control"></textarea>
        </div>

        <div class="form-group mb-2">
            <label>Serial Number</label>
            <input type="text" name="serial_number" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>QTY</label>
            <input type="number" name="qty" class="form-control" min="1">
        </div>

        <div class="form-group mb-2">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <div class="form-group mb-2">
            <label>File</label>
            <input type="file" name="file" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Jenis Surat Jalan</label>
            <input type="text" name="jenis_surat_jalan" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Tanggal Input</label>
            <input type="date" name="tanggal_input" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Kode Asset</label>
            <input type="text" name="kode_asset" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>BAST</label>
            <input type="text" name="bast" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
