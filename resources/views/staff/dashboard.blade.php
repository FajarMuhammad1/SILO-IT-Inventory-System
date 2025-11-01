@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Staff</h2>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tiket Tugas Anda</h5>
                    <p class="card-text">
                        {{ \App\Models\HelpdeskMonitoring::where('pic', Auth::user()->name)->count() }}
                    </p>
                    <a href="{{ route('staff.helpdesk') }}" class="btn btn-light btn-sm">Lihat Tiket</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
