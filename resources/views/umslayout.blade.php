<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} - @yield('titlename')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('public/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('public/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet"> 

    <!-- Sweet Alert -->
    <link href="{{ asset('public/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"> 

    <link href="{{ asset('public/css/animate.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet"> 

    <!-- dataTable -->
    <link href="{{ asset('public/css/plugins/dataTable/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet"> 

    <!-- Chosen -->
    <link href="{{ asset('public/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet"> 
    <link rel="icon" type="img/ico" href="{{ asset('public/images/fav.png') }}">

    <!-- Chosen -->
    <link href="{{ asset('public/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"> 



    <!--<link href="{{ asset('public/css/jquery.datetimepicker.css') }}" rel="stylesheet">  -->

</head>

<body class="pace-done fixed-nav fixed-sidebar">
    <div id="wrapper">
        
        <!-- header -->
        @include('navigationleft')
        <!-- /header -->

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <center>
                        <a href="{{ url('dashboard') }}">
                            <img class="sitelogoinnersite" src="{{ asset('public/images/logo.png') }}" alt="Site Logo" />
                            <div class="sitetitleinnersite m-r-sm text-muted welcome-message"></div>
                        </a>
                    </center>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Hi {{ Auth::user()->name }}</span>
                        </li>
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>




            <main>
                @yield('maincontent')
            </main>





            <div class="footer">
                <div class="float-right">
                    <small>© 2020</small>
                </div>
                <div>
                    <a href="{{ url('dashboard') }}">University Management System</a>
                </div>

                <!-- Mainly scripts -->
                <script src="{{ asset('public/js/jquery-3.3.1.js') }}" crossorigin="anonymous"></script>

                <!-- dataTables -->
                <script src="{{ asset('public/js/plugins/dataTable/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/dataTable/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>

                <!-- bootstrap -->
                <script src="{{ asset('public/js/popper.min.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/bootstrap.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/metisMenu/jquery.metisMenu.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/slimscroll/jquery.slimscroll.min.js') }}" crossorigin="anonymous"></script>

                <!-- Custom and plugin javascript -->
                <script src="{{ asset('public/js/inspinia.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/pace/pace.min.js') }}" crossorigin="anonymous"></script>

                <!-- Chosen -->
                <script src="{{ asset('public/js/plugins/chosen/chosen.jquery.js') }}" crossorigin="anonymous"></script>

                <!-- Highchart  -->
                <script src="{{ asset('public/js/plugins/highchart/highcharts.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/highchart/exporting.js') }}" crossorigin="anonymous"></script>

                <!-- Sweet alert -->
                <script src="{{ asset('public/js/plugins/sweetalert/sweetalert.min.js') }}" crossorigin="anonymous"></script>

                <!-- Toastr -->
                <script src="{{ asset('public/js/plugins/toastr/toastr.min.js') }}" crossorigin="anonymous"></script>

                <!-- Data picker -->
                <script src="{{ asset('public/js/plugins/datapicker/bootstrap-datepicker.js') }}" crossorigin="anonymous"></script>
                <!-- Date range picker -->
                <script src="{{ asset('public/js/plugins/daterangepicker/daterangepicker.js') }}" crossorigin="anonymous"></script>

                <!--validation--> 
                <script src="{{ asset('public/js/parsley.min.js') }}" crossorigin="anonymous"></script>

                
                <!--<script src="{{ asset('public/js/jquery.datetimepicker.js') }}" crossorigin="anonymous"></script>--> 
                
                @yield('extralibincludefooter')

            </div>


        </div>
    </div>

    @yield('customjs')

</body>
</html>