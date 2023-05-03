<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CCS Assets Management') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            <!-- Bootstrap -->
        <link href="{{asset('asset/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{asset('asset/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{asset('asset/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{asset('asset/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
        
        <!-- bootstrap-progressbar -->
        <link href="{{asset('asset/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{asset('asset/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="{{asset('asset/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{asset('asset/build/css/custom.min.css')}}" rel="stylesheet">

        <link href="{{asset('asset/DataTables/datatables.min.css')}}" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
               @include('layouts.shared.sidebar')
               @include('layouts.shared.navbar')
                //main content
                <div class="right_col" role="main">
                <main>
                    {{ $slot }}
                </main>
                </div>
                @include('layouts.shared.footer')
            </div>
        </div>

         <!-- jQuery -->
        <script src="{{URL::asset('asset/vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{URL::asset('asset/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{URL::asset('asset/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <!-- NProgress -->
        <script src="{{URL::asset('asset/vendors/nprogress/nprogress.js')}}"></script>
        <!-- Chart.js -->
        <script src="{{URL::asset('asset/vendors/Chart.js/dist/Chart.min.js')}}"></script>
        <!-- gauge.js -->
        <script src="{{URL::asset('asset/vendors/gauge.js/dist/gauge.min.js')}}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{URL::asset('asset/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{URL::asset('asset/vendors/iCheck/icheck.min.js')}}"></script>
        <!-- Skycons -->
        <script src="{{URL::asset('asset/vendors/skycons/skycons.js')}}"></script>
        <!-- Flot -->
        <script src="{{URL::asset('asset/vendors/Flot/jquery.flot.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/Flot/jquery.flot.pie.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/Flot/jquery.flot.time.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/Flot/jquery.flot.stack.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/Flot/jquery.flot.resize.js')}}"></script>
        <!-- Flot plugins -->
        <script src="{{URL::asset('asset/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/flot.curvedlines/curvedLines.js')}}"></script>
        <!-- DateJS -->
        <script src="{{URL::asset('asset/vendors/DateJS/build/date.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{URL::asset('asset/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{URL::asset('asset/vendors/moment/min/moment.min.js')}}"></script>
        <script src="{{URL::asset('asset/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{URL::asset('asset/build/js/custom.min.js')}}"></script>
        <script src="{{URL::asset('asset/DataTables/datatables.min.js')}}"></script>
    </body>
</html>
