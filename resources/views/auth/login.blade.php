<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Login</title>
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

</head>

<body class="pace-done fixed-nav fixed-sidebar">
    <div id="wrapper">

        <div style="margin-top:70px; width: 60%; margin-left: 20%;">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Login') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="footer">

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
            </div>

        </div>
    </div>


</body>
</html>