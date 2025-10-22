@extends('layouts.sbadmin')

@section('title', 'Dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('inventories.scan') }}" class="text-decoration-none">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Scan Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Gunakan Barcode</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-barcode fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
