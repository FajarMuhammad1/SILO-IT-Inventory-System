@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Departemen: {{ $departement->nama_departement }}</h4>
    <hr>

    <p>Detail informasi mengenai departemen ini akan ditampilkan di sini.</p>

    {{-- Jika nanti ingin menampilkan staff:
    <ul>
        @foreach($departement->users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
    --}}
</div>
@endsection
