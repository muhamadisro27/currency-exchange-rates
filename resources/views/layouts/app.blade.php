<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.min.css') }}">
      <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/datatables-bs4/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables-responsive/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables-buttons/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if (isset($header))
                <section class="content-header">
                    <div class="container-fluid">
                        {{ $header }}
                    </div>
                </section>
            @endif
            {{ $slot }}
        </div>
        <!-- /.content-wrapper -->

        @include('includes.footer')
    </div>
    <!-- ./wrapper -->

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    {{-- <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables-bs4/dataTables.bootstrap4.min.js') }}"></script> --}}
    
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    {{-- <script src="{{ asset('js/datatables-responsive/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/datatables-responsive/responsive.bootstrap4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/datatables-buttons/dataTables.buttons.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/datatables-buttons/buttons.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ asset('js/jszip/jszip.min.js') }}"></script>
    {{-- <script src="{{ asset('js/datatables-buttons/buttons.html5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/datatables-buttons/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/datatables-buttons/buttons.colVis.min.js') }}"></script> --}}
    
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    @stack('dashboard')
</body>

</html>
