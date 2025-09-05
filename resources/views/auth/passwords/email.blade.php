<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Infinity Ltd" name="description">
    <meta content="Pham Son" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ env('APP_URL') . \App\Models\Helper::logoImagePath() }}">


    <link rel="stylesheet" href="{{asset('user/assets/plugins/bootstrap/css/bootstrap.min.css')}}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('user/assets/light/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/light/assets/css/color_skins.css')}}">

    <style>
        @media (max-width: 768px){
            .content-center{
                padding-top: 0 !important;
            }
        }
    </style>
    @yield('css')

</head>

<body class="theme-purple">
<div class="authentication">
    <div class="container">
        <div class="col-md-12 content-center" style="padding-top: 70px;">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="company_detail">
                        <h4 class="logo" style="margin-bottom: 0px; !important;"><img class="mr-1" style="width: 300px !important;;    margin-left: -40px !important;" src="{{ \App\Models\Helper::logoImagePath() }}" alt="Logo"></h4>
                        <h3>Maxvalue</h3>
                        <p>Innovative Solutions to Maximize Earnings and Simplify Monetization</p>
                        <div class="footer">
                            <ul  class="social_link list-unstyled">
                                <li><a href="#" title="ThemeMakker"><i class="zmdi zmdi-globe"></i></a></li>
                                <li><a href="#" title="Themeforest"><i class="zmdi zmdi-shield-check"></i></a></li>
                                <li><a href="#" title="LinkedIn"><i class="zmdi zmdi-linkedin"></i></a></li>
                                <li><a href="#" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#" title="Google plus"><i class="zmdi zmdi-google-plus"></i></a></li>
                                <li><a href="#" title="Behance"><i class="zmdi zmdi-behance"></i></a></li>
                            </ul>
                            <hr>
                            <ul class="list-unstyled">
                                <li><a href="#" target="_blank">Contact Us</a></li>
                                <li><a href="#" target="_blank">About Us</a></li>
                                <li><a href="#" target="_blank">Services</a></li>
                                <li><a href="javascript:void(0);">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 offset-lg-1">
                    <div class="card-plain">
                        <div class="header">
                            <h5>Forgot Password?</h5>
                            <span>Enter your e-mail address below to reset your password.</span>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @else
                            <form method="POST" action="{{ route('password.email') }}" class="form">
                                @csrf
                                <div class="input-group">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email"
                                           autofocus>
                                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror

                                </div>

                                <button type="submit" class="btn btn-primary btn-round btn-block">SUBMIT</button>

                            </form>
                        @endif


                        <a href="{{route('login')}}" class="link">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>

</body>


</html>

