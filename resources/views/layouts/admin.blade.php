<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user_id" content="{{ Auth()->id() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/admin/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('css/admin/theme.css') }}" rel="stylesheet" media="all">


</head>
<body class="animsition">
    <div class="page-wrapper">
        @include('includes.admin.header_mobile')
        @include('includes.admin.menu_sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
        @include('includes.admin.header_desktop')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        @yield('content')

                        @include('includes.admin.footer')
                    </div>
                </div>
            </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('js/admin/main.js') }}"></script>

</body>
</html>
