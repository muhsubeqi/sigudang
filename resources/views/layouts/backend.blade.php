<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <title>SIGUDANG - Sistem Informasi Persediaan Barang Gudang</title>

  <meta name="description" content="SIGUDANG - Sistem Informasi Persediaan Barang Gudang">
  <meta name="author" content="muhsubeqi">
  <meta name="robots" content="index, follow">
  <meta name="base-url" content="{{ url('/') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
  <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">

  <!-- jQuery (required for OneUI plugin) -->
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
  <!-- Page JS Plugins -->
  <script src="{{ asset('js/plugins/datatables/dataTables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  <!-- Modules -->
  @yield('css')
  @vite(['resources/sass/main.scss', 'resources/js/oneui/app.js', 'resources/js/app.js',
  'resources/js/pages/datatables.js'])

  <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
  {{-- @vite(['resources/sass/main.scss', 'resources/sass/oneui/themes/amethyst.scss', 'resources/js/oneui/app.js'])
  --}}
  @yield('js')
</head>

<body>

  <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed">
    @include('layouts.sidebar')
    <!-- END Sidebar -->

    <!-- Header -->
    @include('layouts.header')
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    @include('layouts.footer')
    <!-- END Footer -->
  </div>
  <!-- END Page Container -->
</body>

</html>