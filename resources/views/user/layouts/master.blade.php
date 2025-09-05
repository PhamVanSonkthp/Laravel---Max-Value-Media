<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>{{env('APP_NAME')}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="Maxvalue.media" name="description">
    <meta content="Pham Son" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ \App\Models\Helper::logoImagePath() }}">
    <link rel="icon" href="{{ \App\Models\Helper::logoImagePath() }}" type="image/x-icon">

    @yield('title')

    <link rel="stylesheet" href="{{asset('user/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('user/assets/plugins/morrisjs/morris.min.css')}}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('user/assets/light/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/light/assets/css/color_skins.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/jquery-ui.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('vendor/datetimepicker/daterangepicker.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="{{asset('/assets/administrator/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/jquery.ui.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
    <script src="{{asset('/vendor/masknumber/jquery.masknumber.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @include('administrator.components.helper')
    @include('administrator.components.loading_overlay')

    <style>
        .modal-backdrop {
            background: #000 !important;
        }

        /* Fix Flatpickr month/year header in Bootstrap */
        .flatpickr-current-month {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem; /* Adjust to Bootstrap font */
        }

        .flatpickr-current-month .numInputWrapper input,
        .flatpickr-current-month .flatpickr-monthDropdown-months {
            height: auto !important;
            line-height: normal !important;
            padding: 2px 5px !important;
            font-size: 0.9rem;
            border: 1px solid #ced4da; /* Bootstrap border color */
            border-radius: .25rem;
            background: #fff;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            -webkit-appearance: menulist !important;
            -moz-appearance: menulist !important;
            appearance: menulist !important;
        }

        .navbar-nav .profile img {
            border: 2px solid #fff;
            width: 35px;
            height: 35px;
        }

    </style>
    @yield('css')

    <style>
        {!! optional(\App\Models\Setting::first())->custom_css !!}
    </style>

</head>

<body class="theme-purple">

{{--<!-- Page Loader -->--}}
{{--<div class="page-loader-wrapper">--}}
{{--    <div class="loader">--}}
{{--        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ \App\Models\Helper::logoImagePath() }}" width="48" height="48" alt="InfiniO"></div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- Overlay For Sidebars -->--}}
{{--<div class="overlay"></div>--}}

@include('user.components.header')

@include('user.components.slidebars')

@yield('content')

@include('user.components.footer')

<!-- Jquery Core Js -->
<script src="{{asset('user/assets/light/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
<script src="{{asset('user/assets/light/assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

{{--<script src="{{asset('user/assets/light/assets/bundles/mainscripts.bundle.js')}}"></script>--}}

<script src="{{asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('vendor/sweet-alert-2/sweetalert2@11.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/datetimepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datetimepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/helper/main_helper.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/administrator/js/master.js')}}"></script>
<script src="{{asset('/assets/administrator/NobleUI/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

@yield('js')

@auth
    @include('user.components.freshchat')
@endauth

<script>
    $(document).ready(function () {
        $('.page-loader-wrapper').fadeOut(200);
    });
</script>
</body>


</html>
