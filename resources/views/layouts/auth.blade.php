<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('vendors//datatables.net-bs4/dataTables.bootstrap4.css') }}">

  <!-- Styles -->
  <link href="{{ asset('vendors/base/vendor.bundle.base.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <style>
  .invalid-feedback {
    display: block;
  }
  </style>
</head>
<body>
  <div id="app">
    <div class="container-scroller">
      @include('layouts.header')
      <div class="container-fluid page-body-wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
          @yield('content')
          @include('layouts.footer')
          @yield('extra_script')
        </div>
      </div>
    </div>
  </div>
</body>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<!-- <script src="/vendors/base/vendor.bundle.base.js"></script> -->
<!-- Plugin js for this page-->
<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('js/theme/off-canvas.js') }}"></script>
<script src="{{ asset('js/theme/hoverable-collapse.js') }}"></script>
<script src="{{ asset('js/theme/template.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('js/theme/dashboard.js') }}"></script>
<script src="{{ asset('js/theme/data-table.js') }}"></script>
<script src="{{ asset('js/theme/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/theme/dataTables.bootstrap4.js') }}"></script>
<!-- End custom js for this page-->
<script src="{{ asset('js/custom.js') }}" defer></script>
</html>
