<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IT Inventory System</title>

  <!-- SB Admin CSS -->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  @stack('styles')
</head>
<body id="page-top">

  <div id="wrapper">
    @include('layouts.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        @include('layouts.navbar')

        <div class="container-fluid">
          @yield('content')
        </div>
      </div>

      @include('layouts.footer')
    </div>
  </div>

  <!-- SB Admin Scripts -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  @stack('scripts')
</body>
</html>
