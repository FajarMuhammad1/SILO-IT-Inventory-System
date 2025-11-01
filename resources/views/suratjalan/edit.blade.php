@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Surat Jalan</h2>
   <form action="{{ route('suratjalan.update', $suratJalan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('suratjalan.form')
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
