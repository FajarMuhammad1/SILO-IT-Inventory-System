@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Laporan Helpdesk</h2>

    <form action="{{ route('helpdesk.update', $helpdesk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $helpdesk->tanggal }}" disabled>
        </div>

        <div class="mb-3">
            <label for="departement_id" class="form-label">Departemen</label>
            <select name="departement_id" class="form-control" disabled>
                @foreach($departements as $d)
                    <option value="{{ $d->id }}" {{ $helpdesk->departement_id == $d->id ? 'selected' : '' }}>
                        {{ $d->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ $helpdesk->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="open" {{ $helpdesk->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="progress" {{ $helpdesk->status == 'progress' ? 'selected' : '' }}>Progress</option>
                <option value="done" {{ $helpdesk->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pic" class="form-label">PIC</label>
            <input type="text" name="pic" class="form-control" value="{{ $helpdesk->pic }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('helpdesk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
