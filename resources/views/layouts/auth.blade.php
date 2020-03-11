<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/datepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sweet-alert.css') }}" rel="stylesheet">
  <link href="{{ asset('css/data-table.min.css') }}" rel="stylesheet">
  <style>
  .invalid-feedback {
    display: block;
  }
  .dropdown-menu {
    background-color: #f3f3f3 !important;
  }
  .time.dropdown-menu {
    height: 50px !important;
  }
  </style>
  <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
<body>
  <div id="app">
    <div class="container-scroller">
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
      <div class="container-fluid page-body-wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
          @yield('content')
          @include('layouts.footer')
          @yield('extra_script')
        </div>
      </div>
    </div>
    @if(Session::has('error'))
      <script>
      const text = "{{ Session::get('error') }}";
      swal({
        title: "Something Went Wrong",
        text: text,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      });
      </script>
    @endif
    @if(Session::has('success'))
      <script>
      const text = "{{ Session::get('success') }}";
      swal({
        title: "Good job!",
        text: text,
        icon: "success",
      });
      </script>
    @endif
  </div>
</body>

<script src="{{ asset('js/bootstrap-bundle.min.js')}}"></script>
<script src="{{ asset('js/jquery-data-table.min.js')}} "></script>
<script src="{{ asset('js/data-table-bootstrap.min.js')}} "></script>
<script src="{{ asset('js/SimpleTableCellEditor.js')}}"></script>
<script src="{{ asset('js/select.min.js')}}"></script>
<script src="{{ asset('js/moment.min.js')}}"></script>
<script src="{{ asset('js/datepicker.min.js')}}"></script>

<script src="{{ asset('js/theme/template.js') }}"></script>

<script src="{{ asset('js/summernote.min.js') }}" defer></script>
<script src="{{ asset('js/summernote.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}" defer></script>
</html>
