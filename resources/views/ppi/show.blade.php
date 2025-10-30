@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detail PPI Request</h4>

    <table class="table table-bordered">
        <tr>
            <th>Tanggal</th>
            <td>{{ $ppi->tanggal }}</td>
        </tr>
        <tr>
            <th>No PPI</th>
            <td>{{ $ppi->no_ppi }}</td>
        </tr>
        <tr>
            <th>Pemohon / Departemen</th>
            <td>
                {{ $ppi->departement->nama_departement }}
                - {{ $ppi->departement->jabatan }}
                ({{ $ppi->departement->perusahaan }})
            </td>
        </tr>
        <tr>
            <th>BA Kerusakan</th>
            <td>{{ $ppi->ba_kerusakan }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $ppi->status }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $ppi->keterangan }}</td>
        </tr>
        <tr>
            <th>File PPI</th>
            <td>
                @if($ppi->file_ppi)
                    <a href="{{ asset('storage/'.$ppi->file_ppi) }}" target="_blank">Lihat File</a>
                @else
                    Tidak ada file
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('ppi.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
