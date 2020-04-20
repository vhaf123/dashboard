<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | @yield('title')</title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    @yield('link')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{asset('css/app2.css')}}">

</head>
{{-- <body class="hold-transition sidebar-mini"> --}}
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
<!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        @include('admin.layout.partials.navbar')

        <!-- Sidebar -->
        @include('admin.layout.partials.sidebar')

        <!-- Contenido principal -->
        <div class="content-wrapper">

            <!-- breadcrumb -->
            <section class="content-header">
                <div class="container-fluid">
                    @yield('breadcrumbs')
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>

        {{-- Footer --}}
        @include('admin.layout.partials.footer')
        
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    
    <script>

        /* Tostadas */
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if (session('info'))
            Toast.fire({
                icon: 'success',
                title: "{{session('info')}}"
            });
        @endif

        


    </script>

    @yield('script')

</body>
</html>
