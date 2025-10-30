@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah PPI Request</h4>

    {{-- Tampilkan error validasi kalau ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
        </div>

        <div class="form-group">
            <label>No PPI</label>
            <input type="text" name="no_ppi" class="form-control" placeholder="Masukkan nomor PPI" value="{{ old('no_ppi') }}" required>
        </div>

        <div class="form-group">
            <label>Pemohon</label>
            <input type="text" name="pemohon" class="form-control" value="{{ old('pemohon') }}" placeholder="Nama Pemohon" required>
        </div>

        <div class="form-group">
            <label>Departemen (opsional, untuk detail jabatan & perusahaan)</label>
            <select name="departement_id" class="form-control">
                <option value="">-- Pilih Departemen --</option>
                @foreach($departements as $d)
                    <option value="{{ $d->id }}" {{ old('departement_id') == $d->id ? 'selected' : '' }}>
                        {{ $d->nama_departement }} - {{ $d->jabatan }} ({{ $d->perusahaan }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Field perangkat yang sebelumnya hilang --}}
        <div class="form-group">
            <label>Perangkat yang Diminta</label>
            <input type="text" name="perangkat" class="form-control" placeholder="Contoh: Laptop, Printer, Monitor" value="{{ old('perangkat') }}" required>
        </div>

        <div class="form-group">
            <label>BA Kerusakan</label>
            <select name="ba_kerusakan" class="form-control" required>
                <option value="Ada" {{ old('ba_kerusakan') == 'Ada' ? 'selected' : '' }}>Ada</option>
                <option value="Permintaan Baru" {{ old('ba_kerusakan') == 'Permintaan Baru' ? 'selected' : '' }}>Permintaan Baru</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="Reject" {{ old('status') == 'Reject' ? 'selected' : '' }}>Reject</option>
                <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan tambahan">{{ old('keterangan') }}</textarea>
        </div>

        <div class="form-group">
            <label>File PPI (opsional)</label>
            <input type="file" name="file_ppi" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
