@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Departement</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $departement->id }}</td>
        </tr>
        <tr>
            <th>Nama Departement</th>
            <td>{{ $departement->nama_departement }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>{{ $departement->user }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $departement->jabatan }}</td>
        </tr>
        <tr>
            <th>Perusahaan</th>
            <td>{{ $departement->perusahaan }}</td>
        </tr>
    </table>

    <a href="{{ route('departements.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
