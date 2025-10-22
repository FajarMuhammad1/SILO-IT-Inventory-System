@extends('layouts.auth')

@section('title', 'Login - Sistem Inventaris IT')

@section('content')
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center">
                    <div class="text-center mb-3">
                        <img src="{{ asset('assets/img/images.png') }}" alt="Logo IT" width="150">
                    </div>
                    <h4 class="text-gray-900 font-weight-bold">Login Sistem Inventaris IT</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required autofocus>
                        </div>

                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('register') }}">Belum punya akun? Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
