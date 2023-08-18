<!DOCTYPE html>
<html lang="en">
<head>
    <title>PAKAR HIS | Reset</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has a huge amount of ready-made features, UI components, pages which completely fulfills any dashboard needs.">
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib">
    <link rel="icon" href="{{ asset('files/assets/images/pakar.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min-1.css') }}">
    <link rel="stylesheet" href="{{ asset('files/assets/pages/waves/css/waves.min-1.css') }}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/font-awesome-n.min-1.css') }}">
    <link rel="stylesheet" href="{{ asset('files/bower_components/chartist/css/chartist-1.css') }}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/widget-1.css') }}">
</head>

<body>

<div class="loader-bg">
    <div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded h-100">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                <div>
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-body">

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <img src="{{ asset('files/assets/images/loginImg.png') }}" class="mt-sm-5 mx-auto d-block w-75 w-sm-100">
                                        </div>

                                        <div class="col-12 col-sm-6 mt-sm-4">
                                            <div class="col-12 px-4 d-flex justify-content-start mt-sm-5">
                                                <img src="{{ asset('files/assets/images/pakar.png') }}" style="margin-left: 19%; width: 160px; height: 160px;" alt="">
                                            </div>

                                            <div class="col-12 d-flex justify-content-start">

                                                <div class="login-box ml-4 mt-lg-2">
                                                    
                                                    <div class="row">
                                                        <a style="font-size:30px; margin-left: 19%; width: 300px">{{ __('Reset Password') }}</a>
                                                        <div style="margin-left: 70px"></div>
                                                    </div>
                                                    <!-- /.login-logo -->
                                                    <form method="POST" action="{{ route('password.email') }}">
                                                        @csrf
                                                        <div class="module-head">
                                                            <a href="/"><b></b></a>
                                                        </div>
                                                        <!-- <span class="text-center" style="color:red;">Invalid Username or Password</span> -->
                                                        
                                                        @if(session('status'))
                                                            <div class="alert alert-danger mt-2">{{ session('status') }}</div>
                                                        @endif

                                                        <div class="input-group my-4">
                                                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autocomplete="email" autofocus>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-user"></span>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                        </div>

                                                        <div class="row">
                                                            <!-- /.col -->
                                                            <div class="col-12 my-3">
                                                                <button type="submit" class="btn btn-primary btn-block" name="submit">{{ __('Send Password Reset Link') }}</button>
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                    
                                                        <p class="mb-1">
                                                            <a class="btn btn-link" href="{{ route('login') }}">
                                                                {{ __('Back to login') }}
                                                            </a>
                                                            
                                                        </p>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="styleSelector">
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min-1.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min-1.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min-1.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min-1.js') }}"></script>
<script src="{{ asset('files/assets/pages/waves/js/waves.min-1.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js') }}"></script>
<script src="{{ asset('files/assets/pages/widget/amchart/amcharts-1.js') }}"></script>
<script src="{{ asset('files/assets/pages/widget/amchart/serial-1.js') }}"></script>
<script src="{{ asset('files/assets/pages/widget/amchart/light-1.js') }}"></script>
<script src="{{ asset('files/assets/js/pcoded.min-1.js') }}"></script>
<script src="{{ asset('files/assets/js/vertical/vertical-layout.min-1.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/script.min-1.js') }}"></script>
</body>

</html>

