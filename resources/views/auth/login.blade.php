@extends('user.layouts.master')

@section('content')
    <div class="accountbg"
         style="background: url({{asset('user/assets/images/banner2000x1333.jpg')}});background-size: cover;background-position: center;z-index: -1;left: 370px;position: fixed;"></div>

    <div class="wrapper-page account-page-full">

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="card shadow-none">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="{{ route('user.index') }}">
                                        <img style="max-width: 50%;object-fit: contain;"
                                                                             src="{{ env('APP_URL') . \App\Models\Helper::logoImagePath() }}"
                                                                             height="150"
                                                                             alt="logo"></a>
                                </div>

                                <h4 class="font-size-18 mt-5 text-center">Welcome To {{env('APP_NAME')}}</h4>
                                {{--                                <p class="text-muted text-center">Đăng nhập để tiếp tục với {{ config('app.name', 'Laravel') }}.</p>--}}

                                <form class="mt-4" action="#">

                                    <div class="mb-3">
                                        <label for="email"
                                               class="col-form-label text-md-end">Email</label>

                                        <div>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                                   autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password"
                                               class="col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn text-white button-register"
                                                    style="background-color: #D3AB56;">
                                                Đăng nhập
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    <strong class="text-dark">Bạn đã quên mật khẩu?</strong>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </form>

                                <div class="mb-0 row">
                                    <div class="col-12 mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="flexCheckDefault" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <p class=" text-muted mb-0">Bằng cách đăng nhập, bạn đồng ý với <a
                                                        href="">Điều khoản thanh toán</a> của chúng tôi</p>
                                            </label>
                                        </div>

                                    </div>
                                </div>


                                <div class="mt-5" style="text-align: center;">
                                    <a href="https://discord.com/api/oauth2/authorize?client_id=1163762400701468784&redirect_uri=https%3A%2F%2Fvip.maubuifinance.com%2Fprocess-login-with-discord&response_type=code&scope=identify%20guilds%20email">
                                        <img style="height: 30px;" src="{{asset('/assets/images/906361.png')}}"> Login
                                        with discord
                                    </a>
                                </div>

                                <div class="mt-3 pt-4 text-center position-relative">

                                    @guest
                                        @if (Route::has('register'))
                                            <div>Bạn chưa có tài khoản ?</div>
                                            <a href="{{ route('register') }}"
                                               class=" mt-2 mb-2 btn fw-medium text-white"
                                               style="background-color: #D3AB56;"> Đăng ký ngay </a>
                                        @endif

                                    @endguest
                                    <p>
                                        <script>document.write(new Date().getFullYear())</script>
                                        © {{ config('app.name', 'Laravel') }}.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

<script src="{{asset('administrator/assets/libs/jquery/jquery.min.js')}}"></script>

<script>


    $(document).ready(function () {
        $('#flexCheckDefault').change(function () {
            if (this.checked) {
                $('.button-register').prop('disabled', false);
            } else {
                $('.button-register').prop('disabled', true);
            }
        });
    });

</script>
