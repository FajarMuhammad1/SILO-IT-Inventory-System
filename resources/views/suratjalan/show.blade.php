@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Surat Jalan</h1>

    <table class="table table-bordered">
        <tr><th>No.Surat Jalan</th><td>{{ $suratJalan->no_sj }}</td></tr>
        <tr><th>No.PPI</th><td>{{ $suratJalan->no_ppi }}</td></tr>
        <tr><th>No.PO</th><td>{{ $suratJalan->no_po }}</td></tr>
        <tr><th>Kategori</th><td>{{ $suratJalan->kategori }}</td></tr>
        <tr><th>Merk</th><td>{{ $suratJalan->merk }}</td></tr>
        <tr><th>Model</th><td>{{ $suratJalan->model }}</td></tr>
        <tr><th>Spesifikasi</th><td>{{ $suratJalan->spesifikasi }}</td></tr>
        <tr><th>Serial Number</th><td>{{ $suratJalan->serial_number }}</td></tr>
        <tr><th>QTY</th><td>{{ $suratJalan->qty }}</td></tr>
        <tr><th>Kode Asset</th><td>{{ $suratJalan->kode_asset }}</td></tr>
        <tr><th>BAST</th><td>{{ $suratJalan->bast }}</td></tr>
        <tr><th>Jenis Surat Jalan</th><td>{{ $suratJalan->jenis_surat_jalan }}</td></tr>
        <tr><th>Tanggal Input</th><td>{{ $suratJalan->tanggal_input }}</td></tr>
        <tr><th>Keterangan</th><td>{{ $suratJalan->keterangan }}</td></tr>
        <tr>
            <th>File</th>
            <td>
                @if ($suratJalan->file)
                    <a href="{{ asset('storage/' . $suratJalan->file) }}" target="_blank">Lihat File</a>
                @else
                    <span class="text-muted">Tidak ada file</span>
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('suratjalan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
