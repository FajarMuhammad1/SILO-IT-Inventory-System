@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit PPI Request</h3>
    <form action="{{ route('ppi.update', $ppi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $ppi->tanggal }}" required>
        </div>

        <div class="form-group">
            <label>No PPI</label>
            <input type="text" name="no_ppi" class="form-control" value="{{ $ppi->no_ppi }}" required>
        </div>

        <div class="form-group">
            <label>Departemen / Pemohon</label>
            <select name="departement_id" class="form-control" required>
                @foreach($departements as $d)
                    <option value="{{ $d->id }}" {{ $ppi->departement_id == $d->id ? 'selected' : '' }}>
                        {{ $d->nama_departement }} - {{ $d->jabatan }} ({{ $d->perusahaan }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Perangkat</label>
            <input type="text" name="perangkat" class="form-control" value="{{ $ppi->perangkat }}" required>
        </div>

        <div class="form-group">
            <label>BA Kerusakan</label>
            <select name="ba_kerusakan" class="form-control" required>
                <option value="Ada" {{ $ppi->ba_kerusakan == 'Ada' ? 'selected' : '' }}>Ada</option>
                <option value="Permintaan Baru" {{ $ppi->ba_kerusakan == 'Permintaan Baru' ? 'selected' : '' }}>Permintaan Baru</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Open" {{ $ppi->status == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="Reject" {{ $ppi->status == 'Reject' ? 'selected' : '' }}>Reject</option>
                <option value="Closed" {{ $ppi->status == 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $ppi->keterangan }}</textarea>
        </div>

        <div class="form-group">
            <label>File PPI</label><br>
            @if($ppi->file_ppi)
                <a href="{{ asset('uploads/ppi/' . $ppi->file_ppi) }}" target="_blank">Lihat File</a><br>
            @endif
            <input type="file" name="file_ppi" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="{{ route('ppi.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
@endsection
