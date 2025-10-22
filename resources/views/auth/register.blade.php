@extends('layouts.sbadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center">
                    <div class="text-center mb-3">
                       <img src="{{ asset('assets/img/images.png') }}" alt="Logo IT" width="150">
                    </div>
                    <h4 class="text-gray-900 font-weight-bold">Daftar Akun IT Support</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required autofocus>
                        </div>

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-success btn-block">Daftar</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
