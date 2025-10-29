@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Departemen</h1>
    <div class="card mt-3">
        <div class="card-body">
            <h4>{{ $departement->nama_departement }}</h4>
            <p>Dibuat pada: {{ $departement->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>
    <a href="{{ route('departements.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
